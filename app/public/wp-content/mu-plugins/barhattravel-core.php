<?php
/**
 * Plugin Name: BarhatTravel Core
 * Description: Регистрация типов записей (Туры, Перевозки, Отзывы), метабоксы, формы лидогенерации, отправка писем на ooobarhattravel@gmail.com.
 * Version: 1.0.0
 * Author: BarhatTravel
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class BT_Core {

	const NONCE   = 'bt_form';
	const TO_MAIL = 'ooobarhattravel@gmail.com';

	public function __construct() {
		add_action( 'init', [ $this, 'register_cpts' ] );
		add_action( 'init', [ $this, 'register_taxes' ] );

		add_action( 'add_meta_boxes', [ $this, 'add_metaboxes' ] );
		add_action( 'save_post', [ $this, 'save_metaboxes' ], 10, 2 );

		add_action( 'manage_bt_tour_posts_columns', [ $this, 'tour_columns' ] );
		add_action( 'manage_bt_tour_posts_custom_column', [ $this, 'tour_columns_render' ], 10, 2 );
		add_action( 'manage_bt_transport_posts_columns', [ $this, 'transport_columns' ] );
		add_action( 'manage_bt_transport_posts_custom_column', [ $this, 'transport_columns_render' ], 10, 2 );

		// Forms (logged-in and anonymous).
		foreach ( [ 'callback', 'application', 'review_submit', 'subscribe' ] as $a ) {
			add_action( 'admin_post_bt_' . $a, [ $this, 'handle_' . $a ] );
			add_action( 'admin_post_nopriv_bt_' . $a, [ $this, 'handle_' . $a ] );
		}

		// Shortcodes.
		add_shortcode( 'bt_tours',         [ $this, 'sc_tours' ] );
		add_shortcode( 'bt_transport',     [ $this, 'sc_transport' ] );
		add_shortcode( 'bt_reviews',       [ $this, 'sc_reviews' ] );
		add_shortcode( 'bt_review_form',   [ $this, 'sc_review_form' ] );

		// Allow font icons in reviews — keep raw HTML simple.
		add_filter( 'wp_mail_content_type', function () { return 'text/html'; } );

		// Register a meta query var for filter pages.
		add_action( 'pre_get_posts', [ $this, 'archive_filters' ] );

		// Auto-create pages on first activation.
		register_activation_hook( __FILE__, [ __CLASS__, 'install' ] );
		add_action( 'after_switch_theme', [ __CLASS__, 'install' ] );
	}

	/* ---------------------------------------------------------------------
	 * CPTs
	 * ------------------------------------------------------------------- */
	public function register_cpts() {
		register_post_type( 'bt_tour', [
			'labels' => [
				'name'               => 'Туры',
				'singular_name'      => 'Тур',
				'add_new'            => 'Добавить тур',
				'add_new_item'       => 'Добавить новый тур',
				'edit_item'          => 'Редактировать тур',
				'new_item'           => 'Новый тур',
				'view_item'          => 'Просмотреть тур',
				'search_items'       => 'Искать туры',
				'not_found'          => 'Туры не найдены',
				'menu_name'          => 'Туры',
			],
			'public'        => true,
			'has_archive'   => 'tours',
			'rewrite'       => [ 'slug' => 'tour', 'with_front' => false ],
			'menu_position' => 4,
			'menu_icon'     => 'dashicons-palmtree',
			'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
			'show_in_rest'  => true,
			'taxonomies'    => [ 'tour_category', 'tour_destination' ],
		] );

		register_post_type( 'bt_transport', [
			'labels' => [
				'name'          => 'Перевозки',
				'singular_name' => 'Рейс',
				'add_new'       => 'Добавить рейс',
				'add_new_item'  => 'Добавить новый рейс',
				'edit_item'     => 'Редактировать рейс',
				'menu_name'     => 'Перевозки',
			],
			'public'        => true,
			'has_archive'   => 'transport',
			'rewrite'       => [ 'slug' => 'ride', 'with_front' => false ],
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-car',
			'supports'      => [ 'title', 'editor', 'thumbnail' ],
			'show_in_rest'  => true,
		] );

		register_post_type( 'bt_review', [
			'labels' => [
				'name'          => 'Отзывы',
				'singular_name' => 'Отзыв',
				'add_new'       => 'Добавить отзыв',
				'menu_name'     => 'Отзывы',
			],
			'public'        => false,
			'show_ui'       => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-format-quote',
			'supports'      => [ 'title', 'editor' ],
		] );
	}

	public function register_taxes() {
		register_taxonomy( 'tour_category', 'bt_tour', [
			'labels' => [
				'name'          => 'Категории туров',
				'singular_name' => 'Категория',
				'menu_name'     => 'Категории',
			],
			'hierarchical' => true,
			'public'       => true,
			'show_in_rest' => true,
			'rewrite'      => [ 'slug' => 'tour-category' ],
		] );

		register_taxonomy( 'tour_destination', 'bt_tour', [
			'labels' => [
				'name'          => 'Направления',
				'singular_name' => 'Направление',
			],
			'hierarchical' => true,
			'public'       => true,
			'show_in_rest' => true,
			'rewrite'      => [ 'slug' => 'destination' ],
		] );
	}

	/* ---------------------------------------------------------------------
	 * Install — create default taxonomy terms and skeleton pages
	 * ------------------------------------------------------------------- */
	public static function install() {
		// Ensure CPTs are registered before adding terms.
		( new self() )->register_cpts();
		( new self() )->register_taxes();

		$cats = [
			'popular'    => 'Популярные маршруты',
			'excursions' => 'Экскурсии',
			'abroad'     => 'Туры в РФ и зарубежье',
			'beach'      => 'Пляжный отдых',
			'school'     => 'Школьные поездки',
		];
		foreach ( $cats as $slug => $name ) {
			if ( ! term_exists( $slug, 'tour_category' ) ) {
				wp_insert_term( $name, 'tour_category', [ 'slug' => $slug ] );
			}
		}

		$pages = [
			'privacy' => [ 'Политика конфиденциальности', self::default_privacy() ],
			'offer'   => [ 'Публичная оферта', 'Текст оферты публикуется в кабинете БархатТрэвел.' ],
			'about'   => [ 'О компании', 'ООО «БархатТрэвел» — туристическая компания из Полоцка.' ],
		];
		foreach ( $pages as $slug => $p ) {
			$page = get_page_by_path( $slug );
			if ( ! $page ) {
				wp_insert_post( [
					'post_title'   => $p[0],
					'post_name'    => $slug,
					'post_content' => $p[1],
					'post_status'  => 'publish',
					'post_type'    => 'page',
				] );
			}
		}

		flush_rewrite_rules();
	}

	private static function default_privacy() {
		return "<h2>Согласие на обработку персональных данных</h2>\n<p>Настоящая политика разработана в соответствии с законодательством Республики Беларусь (Закон №99-З «О защите персональных данных») и Российской Федерации (152-ФЗ). Оператор данных: ООО «БархатТрэвел», УНП 391956930.</p>\n<p>Данные собираются исключительно для обработки заявок на туры, перевозки и обратной связи. Подробные сведения предоставляются по запросу на ooobarhattravel@gmail.com.</p>";
	}

	/* ---------------------------------------------------------------------
	 * Metaboxes
	 * ------------------------------------------------------------------- */
	public function add_metaboxes() {
		add_meta_box( 'bt_tour_fields', 'Параметры тура', [ $this, 'mb_tour' ], 'bt_tour', 'normal', 'high' );
		add_meta_box( 'bt_tour_program', 'Программа по дням', [ $this, 'mb_tour_program' ], 'bt_tour', 'normal', 'default' );
		add_meta_box( 'bt_tour_lists', 'Что включено / не включено', [ $this, 'mb_tour_lists' ], 'bt_tour', 'normal', 'default' );
		add_meta_box( 'bt_tour_gallery', 'Галерея и карта', [ $this, 'mb_tour_gallery' ], 'bt_tour', 'normal', 'default' );

		add_meta_box( 'bt_transport_fields', 'Параметры рейса', [ $this, 'mb_transport' ], 'bt_transport', 'normal', 'high' );

		add_meta_box( 'bt_review_fields', 'Данные отзыва', [ $this, 'mb_review' ], 'bt_review', 'normal', 'high' );
	}

	public function mb_tour( $post ) {
		wp_nonce_field( 'bt_meta', 'bt_meta_nonce' );
		$subtitle = get_post_meta( $post->ID, '_bt_subtitle', true );
		$region   = get_post_meta( $post->ID, '_bt_region', true );
		$duration = get_post_meta( $post->ID, '_bt_duration', true );
		$price    = get_post_meta( $post->ID, '_bt_price', true );
		$dates    = get_post_meta( $post->ID, '_bt_dates', true );
		$featured = get_post_meta( $post->ID, '_bt_featured', true );
		?>
		<p><label>Подзаголовок (отображается в карточке)<br>
			<input type="text" name="bt_subtitle" value="<?php echo esc_attr( $subtitle ); ?>" style="width:100%"></label></p>
		<p style="display:flex;gap:16px;flex-wrap:wrap">
			<label style="flex:1 1 220px">Регион / маршрут<br>
				<input type="text" name="bt_region" value="<?php echo esc_attr( $region ); ?>" placeholder="напр. Брест" style="width:100%"></label>
			<label style="flex:1 1 220px">Длительность<br>
				<input type="text" name="bt_duration" value="<?php echo esc_attr( $duration ); ?>" placeholder="напр. 2 дня / 1 ночь" style="width:100%"></label>
			<label style="flex:1 1 160px">Цена (BYN, число)<br>
				<input type="number" name="bt_price" value="<?php echo esc_attr( $price ); ?>" step="0.01" style="width:100%"></label>
		</p>
		<p><label>Даты выездов (одна на строку, например: 11.02.2026 — 01.03.2026)<br>
			<textarea name="bt_dates" rows="4" style="width:100%"><?php echo esc_textarea( $dates ); ?></textarea></label></p>
		<p><label><input type="checkbox" name="bt_featured" value="1" <?php checked( $featured, '1' ); ?>> Показать в популярных на главной</label></p>
		<?php
	}

	public function mb_tour_program( $post ) {
		$program = get_post_meta( $post->ID, '_bt_program', true );
		$rows = json_decode( $program ?: '[]', true );
		if ( ! is_array( $rows ) ) $rows = [];
		?>
		<div id="bt-program-rows" data-rows='<?php echo esc_attr( wp_json_encode( $rows ) ); ?>'>
			<noscript><p><em>Включите JavaScript для редактирования программы.</em></p></noscript>
		</div>
		<input type="hidden" name="bt_program" id="bt-program-input" value="<?php echo esc_attr( $program ); ?>">
		<p><button type="button" class="button" id="bt-program-add">+ Добавить день</button></p>
		<script>
		(function(){
			var box = document.getElementById('bt-program-rows');
			var input = document.getElementById('bt-program-input');
			var rows = JSON.parse(box.dataset.rows || '[]');
			function render(){
				box.innerHTML = '';
				rows.forEach(function(row,i){
					var w = document.createElement('div');
					w.style.cssText = 'border:1px solid #dcdcde;padding:12px;border-radius:6px;margin-bottom:8px;background:#fff';
					w.innerHTML = '<p style="margin:0 0 6px"><strong>День ' + (i+1) + '</strong> <button type="button" class="button-link delete" style="float:right;color:#b32d2e">Удалить</button></p>'
						+ '<p style="margin:0 0 8px"><input type="text" data-k="title" placeholder="Заголовок дня (напр. «Брест и форт №5»)" style="width:100%" value="' + (row.title||'').replace(/"/g,'&quot;') + '"></p>'
						+ '<p style="margin:0"><textarea data-k="body" rows="3" style="width:100%" placeholder="Описание программы дня">' + (row.body||'').replace(/</g,'&lt;') + '</textarea></p>';
					w.querySelectorAll('[data-k]').forEach(function(el){
						el.addEventListener('input', function(){ row[el.dataset.k] = el.value; sync(); });
					});
					w.querySelector('.delete').addEventListener('click', function(){
						rows.splice(i,1); render();
					});
					box.appendChild(w);
				});
				sync();
			}
			function sync(){ input.value = JSON.stringify(rows); }
			document.getElementById('bt-program-add').addEventListener('click', function(){
				rows.push({title:'', body:''}); render();
			});
			render();
		})();
		</script>
		<?php
	}

	public function mb_tour_lists( $post ) {
		$inc = get_post_meta( $post->ID, '_bt_includes', true );
		$exc = get_post_meta( $post->ID, '_bt_excludes', true );
		?>
		<p style="display:flex;gap:16px;flex-wrap:wrap">
			<label style="flex:1 1 320px">Что включено в стоимость (одно на строку)<br>
				<textarea name="bt_includes" rows="8" style="width:100%"><?php echo esc_textarea( $inc ); ?></textarea></label>
			<label style="flex:1 1 320px">Что не включено (одно на строку)<br>
				<textarea name="bt_excludes" rows="8" style="width:100%"><?php echo esc_textarea( $exc ); ?></textarea></label>
		</p>
		<?php
	}

	public function mb_tour_gallery( $post ) {
		$gal = get_post_meta( $post->ID, '_bt_gallery', true );
		$map = get_post_meta( $post->ID, '_bt_map', true );
		?>
		<p><label>ID вложений галереи через запятую (загрузите изображения в Медиабиблиотеку и впишите их ID)<br>
			<input type="text" name="bt_gallery" value="<?php echo esc_attr( $gal ); ?>" style="width:100%" placeholder="напр. 12,15,17,20"></label></p>
		<p><label>HTML/URL для встраивания карты (Google Maps / Яндекс — iframe или ссылка)<br>
			<textarea name="bt_map" rows="3" style="width:100%"><?php echo esc_textarea( $map ); ?></textarea></label></p>
		<?php
	}

	public function mb_transport( $post ) {
		wp_nonce_field( 'bt_meta', 'bt_meta_nonce' );
		$date  = get_post_meta( $post->ID, '_bt_t_date', true );
		$time  = get_post_meta( $post->ID, '_bt_t_time', true );
		$from  = get_post_meta( $post->ID, '_bt_t_from', true );
		$to    = get_post_meta( $post->ID, '_bt_t_to', true );
		$bus   = get_post_meta( $post->ID, '_bt_t_bus', true );
		$price = get_post_meta( $post->ID, '_bt_t_price', true );
		$seats = get_post_meta( $post->ID, '_bt_t_seats', true );
		?>
		<p style="display:flex;gap:12px;flex-wrap:wrap">
			<label style="flex:1 1 160px">Дата выезда<br>
				<input type="date" name="bt_t_date" value="<?php echo esc_attr( $date ); ?>" style="width:100%"></label>
			<label style="flex:1 1 100px">Время<br>
				<input type="time" name="bt_t_time" value="<?php echo esc_attr( $time ); ?>" style="width:100%"></label>
			<label style="flex:1 1 160px">Откуда<br>
				<input type="text" name="bt_t_from" value="<?php echo esc_attr( $from ); ?>" placeholder="Полоцк / Новополоцк" style="width:100%"></label>
			<label style="flex:1 1 220px">Куда<br>
				<input type="text" name="bt_t_to" value="<?php echo esc_attr( $to ); ?>" placeholder="напр. Минск" style="width:100%"></label>
		</p>
		<p style="display:flex;gap:12px;flex-wrap:wrap">
			<label style="flex:1 1 220px">Тип транспорта<br>
				<input type="text" name="bt_t_bus" value="<?php echo esc_attr( $bus ); ?>" placeholder="напр. Mercedes Sprinter (19 мест)" style="width:100%"></label>
			<label style="flex:1 1 160px">Цена (BYN)<br>
				<input type="number" name="bt_t_price" value="<?php echo esc_attr( $price ); ?>" step="0.01" style="width:100%"></label>
			<label style="flex:1 1 120px">Свободных мест<br>
				<input type="number" name="bt_t_seats" value="<?php echo esc_attr( $seats ); ?>" style="width:100%"></label>
		</p>
		<?php
	}

	public function mb_review( $post ) {
		wp_nonce_field( 'bt_meta', 'bt_meta_nonce' );
		$rating = (int) get_post_meta( $post->ID, '_bt_r_rating', true ) ?: 5;
		$city   = get_post_meta( $post->ID, '_bt_r_city', true );
		$tour   = get_post_meta( $post->ID, '_bt_r_tour', true );
		?>
		<p style="display:flex;gap:12px;flex-wrap:wrap">
			<label style="flex:1 1 120px">Оценка (1-5)<br>
				<input type="number" name="bt_r_rating" value="<?php echo esc_attr( $rating ); ?>" min="1" max="5" style="width:100%"></label>
			<label style="flex:1 1 200px">Город автора<br>
				<input type="text" name="bt_r_city" value="<?php echo esc_attr( $city ); ?>" style="width:100%"></label>
			<label style="flex:1 1 240px">Тур / поездка<br>
				<input type="text" name="bt_r_tour" value="<?php echo esc_attr( $tour ); ?>" style="width:100%"></label>
		</p>
		<p><strong>Заголовок</strong> — имя автора. <strong>Содержимое</strong> — текст отзыва.<br>
		Чтобы опубликовать отзыв, переведите статус записи в «Опубликовано».</p>
		<?php
	}

	public function save_metaboxes( $post_id, $post ) {
		if ( ! isset( $_POST['bt_meta_nonce'] ) || ! wp_verify_nonce( $_POST['bt_meta_nonce'], 'bt_meta' ) ) return;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;

		$map = [
			'bt_tour' => [
				'bt_subtitle' => '_bt_subtitle',
				'bt_region'   => '_bt_region',
				'bt_duration' => '_bt_duration',
				'bt_price'    => '_bt_price',
				'bt_dates'    => '_bt_dates',
				'bt_program'  => '_bt_program',
				'bt_includes' => '_bt_includes',
				'bt_excludes' => '_bt_excludes',
				'bt_gallery'  => '_bt_gallery',
				'bt_map'      => '_bt_map',
				'bt_featured' => '_bt_featured',
			],
			'bt_transport' => [
				'bt_t_date'  => '_bt_t_date',
				'bt_t_time'  => '_bt_t_time',
				'bt_t_from'  => '_bt_t_from',
				'bt_t_to'    => '_bt_t_to',
				'bt_t_bus'   => '_bt_t_bus',
				'bt_t_price' => '_bt_t_price',
				'bt_t_seats' => '_bt_t_seats',
			],
			'bt_review' => [
				'bt_r_rating' => '_bt_r_rating',
				'bt_r_city'   => '_bt_r_city',
				'bt_r_tour'   => '_bt_r_tour',
			],
		];

		if ( empty( $map[ $post->post_type ] ) ) return;

		foreach ( $map[ $post->post_type ] as $field => $key ) {
			if ( $field === 'bt_featured' ) {
				update_post_meta( $post_id, $key, isset( $_POST[ $field ] ) ? '1' : '' );
				continue;
			}
			if ( ! isset( $_POST[ $field ] ) ) {
				delete_post_meta( $post_id, $key );
				continue;
			}
			$val = wp_unslash( $_POST[ $field ] );
			if ( $field === 'bt_map' || $field === 'bt_program' ) {
				$val = wp_kses_post( $val );
			} elseif ( strpos( $field, 'price' ) !== false || strpos( $field, 'rating' ) !== false || strpos( $field, 'seats' ) !== false ) {
				$val = (string) (float) $val;
			} else {
				$val = sanitize_textarea_field( $val );
			}
			update_post_meta( $post_id, $key, $val );
		}
	}

	/* ---------------------------------------------------------------------
	 * Admin columns
	 * ------------------------------------------------------------------- */
	public function tour_columns( $cols ) {
		$new = [];
		foreach ( $cols as $k => $v ) {
			$new[ $k ] = $v;
			if ( $k === 'title' ) {
				$new['bt_region']   = 'Маршрут';
				$new['bt_price']    = 'Цена, BYN';
				$new['bt_duration'] = 'Длительность';
				$new['bt_featured'] = '★ Популярный';
			}
		}
		return $new;
	}
	public function tour_columns_render( $col, $id ) {
		switch ( $col ) {
			case 'bt_region':   echo esc_html( get_post_meta( $id, '_bt_region', true ) ); break;
			case 'bt_price':    echo esc_html( get_post_meta( $id, '_bt_price', true ) ); break;
			case 'bt_duration': echo esc_html( get_post_meta( $id, '_bt_duration', true ) ); break;
			case 'bt_featured': echo get_post_meta( $id, '_bt_featured', true ) ? '★' : '—'; break;
		}
	}

	public function transport_columns( $cols ) {
		$new = [ 'cb' => $cols['cb'], 'title' => $cols['title'] ];
		$new['bt_t_date']  = 'Дата';
		$new['bt_t_route'] = 'Маршрут';
		$new['bt_t_price'] = 'Цена';
		$new['bt_t_seats'] = 'Мест';
		$new['date']       = $cols['date'];
		return $new;
	}
	public function transport_columns_render( $col, $id ) {
		switch ( $col ) {
			case 'bt_t_date':  echo esc_html( get_post_meta( $id, '_bt_t_date', true ) . ' ' . get_post_meta( $id, '_bt_t_time', true ) ); break;
			case 'bt_t_route': echo esc_html( get_post_meta( $id, '_bt_t_from', true ) . ' → ' . get_post_meta( $id, '_bt_t_to', true ) ); break;
			case 'bt_t_price': echo esc_html( get_post_meta( $id, '_bt_t_price', true ) ); break;
			case 'bt_t_seats': echo esc_html( get_post_meta( $id, '_bt_t_seats', true ) ); break;
		}
	}

	/* ---------------------------------------------------------------------
	 * Archive filters
	 * ------------------------------------------------------------------- */
	public function archive_filters( $q ) {
		if ( is_admin() || ! $q->is_main_query() ) return;

		// Transport archive — only upcoming, sorted by date asc.
		if ( $q->is_post_type_archive( 'bt_transport' ) ) {
			$q->set( 'meta_key', '_bt_t_date' );
			$q->set( 'orderby', 'meta_value' );
			$q->set( 'order', 'ASC' );
			$q->set( 'meta_query', [
				[
					'key'     => '_bt_t_date',
					'value'   => current_time( 'Y-m-d' ),
					'compare' => '>=',
					'type'    => 'DATE',
				],
			] );
		}
	}

	/* ---------------------------------------------------------------------
	 * Form handlers
	 * ------------------------------------------------------------------- */
	private function check_nonce_and_hp() {
		$nonce = $_POST['bt_nonce'] ?? '';
		if ( ! wp_verify_nonce( $nonce, self::NONCE ) ) {
			$this->json( false, 'Сессия истекла. Обновите страницу и попробуйте снова.' );
		}
		if ( ! empty( $_POST['bt_hp'] ) ) {
			// Honeypot triggered — pretend success but ignore.
			$this->json( true, 'Спасибо!' );
		}
	}

	private function json( $ok, $msg ) {
		wp_send_json( [ 'ok' => (bool) $ok, 'msg' => $msg ] );
	}

	private function send_mail( $subject, $body ) {
		$headers = [
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . get_bloginfo( 'name' ) . ' <wordpress@' . parse_url( home_url(), PHP_URL_HOST ) . '>',
			'Reply-To: ' . self::TO_MAIL,
		];
		return wp_mail( self::TO_MAIL, $subject, $body, $headers );
	}

	public function handle_callback() {
		$this->check_nonce_and_hp();
		$name  = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
		$phone = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
		if ( ! $name || ! $phone ) $this->json( false, 'Укажите имя и телефон.' );
		$body = '<h3>Заказ обратного звонка</h3>'
			. '<p><strong>Имя:</strong> ' . esc_html( $name ) . '</p>'
			. '<p><strong>Телефон:</strong> ' . esc_html( $phone ) . '</p>'
			. '<p><small>Источник: ' . esc_html( $_SERVER['HTTP_REFERER'] ?? home_url() ) . '</small></p>';
		$this->send_mail( '[Сайт] Заказ звонка — ' . $name, $body );
		$this->save_lead( 'callback', compact( 'name', 'phone' ) );
		$this->json( true, 'Спасибо! Перезвоним в ближайшее время.' );
	}

	public function handle_application() {
		$this->check_nonce_and_hp();
		$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
		$phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
		$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
		$tour    = sanitize_text_field( wp_unslash( $_POST['tour'] ?? '' ) );
		$people  = (int) ( $_POST['people'] ?? 0 );
		$msg     = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
		if ( ! $name || ! $phone ) $this->json( false, 'Укажите имя и телефон.' );

		$body = '<h3>Заявка на тур</h3>'
			. '<p><strong>Имя:</strong> ' . esc_html( $name ) . '</p>'
			. '<p><strong>Телефон:</strong> ' . esc_html( $phone ) . '</p>'
			. ( $email ? '<p><strong>Email:</strong> ' . esc_html( $email ) . '</p>' : '' )
			. ( $tour ? '<p><strong>Тур:</strong> ' . esc_html( $tour ) . '</p>' : '' )
			. ( $people ? '<p><strong>Кол-во человек:</strong> ' . esc_html( $people ) . '</p>' : '' )
			. ( $msg ? '<p><strong>Комментарий:</strong><br>' . nl2br( esc_html( $msg ) ) . '</p>' : '' )
			. '<p><small>Источник: ' . esc_html( $_SERVER['HTTP_REFERER'] ?? home_url() ) . '</small></p>';
		$this->send_mail( '[Сайт] Заявка на тур — ' . ( $tour ?: $name ), $body );
		$this->save_lead( 'application', compact( 'name', 'phone', 'email', 'tour', 'people', 'msg' ) );
		$this->json( true, 'Спасибо! Менеджер свяжется с вами в ближайшее время.' );
	}

	public function handle_review_submit() {
		$this->check_nonce_and_hp();
		$name   = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
		$city   = sanitize_text_field( wp_unslash( $_POST['city'] ?? '' ) );
		$tour   = sanitize_text_field( wp_unslash( $_POST['tour'] ?? '' ) );
		$rating = max( 1, min( 5, (int) ( $_POST['rating'] ?? 5 ) ) );
		$text   = sanitize_textarea_field( wp_unslash( $_POST['text'] ?? '' ) );
		if ( ! $name || ! $text ) $this->json( false, 'Укажите имя и текст отзыва.' );

		$post_id = wp_insert_post( [
			'post_title'   => $name,
			'post_content' => $text,
			'post_status'  => 'pending',
			'post_type'    => 'bt_review',
			'meta_input'   => [
				'_bt_r_rating' => $rating,
				'_bt_r_city'   => $city,
				'_bt_r_tour'   => $tour,
			],
		] );
		if ( is_wp_error( $post_id ) ) $this->json( false, 'Не удалось сохранить отзыв.' );

		$edit = admin_url( 'post.php?post=' . $post_id . '&action=edit' );
		$body = '<h3>Новый отзыв (требует модерации)</h3>'
			. '<p><strong>Автор:</strong> ' . esc_html( $name ) . ( $city ? ' (' . esc_html( $city ) . ')' : '' ) . '</p>'
			. ( $tour ? '<p><strong>Тур:</strong> ' . esc_html( $tour ) . '</p>' : '' )
			. '<p><strong>Оценка:</strong> ' . str_repeat( '★', $rating ) . str_repeat( '☆', 5 - $rating ) . '</p>'
			. '<p><strong>Отзыв:</strong><br>' . nl2br( esc_html( $text ) ) . '</p>'
			. '<p><a href="' . esc_url( $edit ) . '">Открыть в админке для модерации</a></p>';
		$this->send_mail( '[Сайт] Новый отзыв от ' . $name, $body );
		$this->json( true, 'Спасибо! Ваш отзыв отправлен на модерацию и появится после проверки.' );
	}

	public function handle_subscribe() {
		$this->check_nonce_and_hp();
		$email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
		if ( ! is_email( $email ) ) $this->json( false, 'Укажите корректный e-mail.' );
		$this->send_mail( '[Сайт] Новая подписка на рассылку', '<p>Подписался: <strong>' . esc_html( $email ) . '</strong></p>' );
		$this->save_lead( 'subscribe', compact( 'email' ) );
		$this->json( true, 'Спасибо! Вы подписаны на рассылку.' );
	}

	private function save_lead( $type, $data ) {
		$leads = get_option( 'bt_leads', [] );
		if ( ! is_array( $leads ) ) $leads = [];
		$leads[] = [
			'type' => $type,
			'data' => $data,
			'ts'   => current_time( 'mysql' ),
			'ip'   => $_SERVER['REMOTE_ADDR'] ?? '',
		];
		// keep last 500
		if ( count( $leads ) > 500 ) {
			$leads = array_slice( $leads, -500 );
		}
		update_option( 'bt_leads', $leads, false );
	}

	/* ---------------------------------------------------------------------
	 * Shortcodes
	 * ------------------------------------------------------------------- */
	public function sc_tours( $atts ) {
		$atts = shortcode_atts( [
			'category' => '',
			'limit'    => 6,
			'featured' => '',
		], $atts );

		$args = [
			'post_type'      => 'bt_tour',
			'posts_per_page' => (int) $atts['limit'],
			'no_found_rows'  => true,
		];
		if ( $atts['category'] ) {
			$args['tax_query'] = [
				[ 'taxonomy' => 'tour_category', 'field' => 'slug', 'terms' => array_map( 'trim', explode( ',', $atts['category'] ) ) ],
			];
		}
		if ( $atts['featured'] === '1' ) {
			$args['meta_key'] = '_bt_featured';
			$args['meta_value'] = '1';
		}
		$q = new WP_Query( $args );
		ob_start();
		if ( $q->have_posts() ) {
			echo '<div class="bt-grid bt-grid--3">';
			$i = 0;
			while ( $q->have_posts() ) { $q->the_post(); $this->render_tour_card( get_post(), $i++ ); }
			echo '</div>';
			wp_reset_postdata();
		} else {
			echo '<p class="bt-muted">Скоро здесь появятся туры в этой категории.</p>';
		}
		return ob_get_clean();
	}

	public function render_tour_card( $post, $i = 0 ) {
		$id = $post->ID;
		$subtitle = get_post_meta( $id, '_bt_subtitle', true );
		$duration = get_post_meta( $id, '_bt_duration', true );
		$region   = get_post_meta( $id, '_bt_region', true );
		$price    = (float) get_post_meta( $id, '_bt_price', true );
		?>
		<article class="bt-card">
			<a class="bt-card__media <?php echo has_post_thumbnail( $id ) ? '' : 'bt-card__media--fallback'; ?>" href="<?php echo esc_url( get_permalink( $id ) ); ?>"
			   style="--bt-card-grad: <?php echo esc_attr( bt_card_gradient( $i ) ); ?>">
				<?php
				if ( has_post_thumbnail( $id ) ) {
					echo get_the_post_thumbnail( $id, 'bt-tour-card', [ 'loading' => 'lazy' ] );
				} else {
					echo bt_icon( 'plane', 'bt-icon' );
				}
				$term = get_the_terms( $id, 'tour_category' );
				if ( $term && ! is_wp_error( $term ) ) {
					echo '<span class="bt-card__tag">' . esc_html( $term[0]->name ) . '</span>';
				}
				if ( $price > 0 ) {
					echo '<span class="bt-card__price">от ' . esc_html( bt_price( $price ) ) . '</span>';
				}
				?>
			</a>
			<div class="bt-card__body">
				<div class="bt-card__meta">
					<?php if ( $region ) : ?><span><?php echo bt_icon( 'map', 'bt-icon bt-icon--xs' ); ?> <?php echo esc_html( $region ); ?></span><?php endif; ?>
					<?php if ( $duration ) : ?><span><?php echo bt_icon( 'clock', 'bt-icon bt-icon--xs' ); ?> <?php echo esc_html( $duration ); ?></span><?php endif; ?>
				</div>
				<h3 class="bt-card__title"><a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></a></h3>
				<?php if ( $subtitle ) : ?><p class="bt-card__excerpt"><?php echo esc_html( $subtitle ); ?></p>
				<?php else : ?><p class="bt-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $post ), 18 ) ); ?></p><?php endif; ?>
				<div class="bt-card__footer">
					<a class="bt-link" href="<?php echo esc_url( get_permalink( $id ) ); ?>">Подробнее →</a>
					<button class="bt-btn bt-btn--primary bt-js-open" data-form="application" data-tour="<?php echo esc_attr( get_the_title( $id ) ); ?>">Заявка</button>
				</div>
			</div>
		</article>
		<?php
	}

	public function sc_transport( $atts ) {
		$atts = shortcode_atts( [ 'limit' => 6 ], $atts );
		$q = new WP_Query( [
			'post_type'      => 'bt_transport',
			'posts_per_page' => (int) $atts['limit'],
			'meta_key'       => '_bt_t_date',
			'orderby'        => 'meta_value',
			'order'          => 'ASC',
			'meta_query'     => [
				[ 'key' => '_bt_t_date', 'value' => current_time( 'Y-m-d' ), 'compare' => '>=', 'type' => 'DATE' ],
			],
		] );
		ob_start();
		if ( ! $q->have_posts() ) {
			echo '<p class="bt-muted">Расписание скоро будет обновлено. Позвоните нам, чтобы узнать ближайшие выезды.</p>';
			return ob_get_clean();
		}
		echo '<div class="bt-rides">';
		$months = [ '01' => 'янв', '02' => 'фев', '03' => 'мар', '04' => 'апр', '05' => 'мая', '06' => 'июн',
			'07' => 'июл', '08' => 'авг', '09' => 'сен', '10' => 'окт', '11' => 'ноя', '12' => 'дек' ];
		while ( $q->have_posts() ) { $q->the_post();
			$id = get_the_ID();
			$d  = get_post_meta( $id, '_bt_t_date', true );
			$t  = get_post_meta( $id, '_bt_t_time', true );
			$from = get_post_meta( $id, '_bt_t_from', true );
			$to   = get_post_meta( $id, '_bt_t_to', true );
			$bus  = get_post_meta( $id, '_bt_t_bus', true );
			$price = (float) get_post_meta( $id, '_bt_t_price', true );
			$seats = (int) get_post_meta( $id, '_bt_t_seats', true );
			$day   = substr( $d, 8, 2 );
			$mon   = $months[ substr( $d, 5, 2 ) ] ?? '';
			?>
			<div class="bt-ride">
				<div class="bt-ride__date">
					<span class="day"><?php echo esc_html( $day ); ?></span>
					<span class="mon"><?php echo esc_html( $mon ); ?></span>
				</div>
				<div class="bt-ride__info">
					<h4><?php echo esc_html( get_the_title() ); ?></h4>
					<p>
						<?php if ( $from || $to ) : ?><span><?php echo bt_icon( 'map', 'bt-icon bt-icon--xs' ); ?> <?php echo esc_html( $from ); ?> → <?php echo esc_html( $to ); ?></span><?php endif; ?>
						<?php if ( $t ) : ?><span><?php echo bt_icon( 'clock', 'bt-icon bt-icon--xs' ); ?> <?php echo esc_html( substr( $t, 0, 5 ) ); ?></span><?php endif; ?>
						<?php if ( $bus ) : ?><span><?php echo bt_icon( 'bus', 'bt-icon bt-icon--xs' ); ?> <?php echo esc_html( $bus ); ?></span><?php endif; ?>
						<?php if ( $seats > 0 ) : ?><span class="bt-ride__seats">Свободно мест: <?php echo (int) $seats; ?></span><?php endif; ?>
					</p>
				</div>
				<div class="bt-ride__price"><?php echo $price > 0 ? esc_html( bt_price( $price ) ) : 'По запросу'; ?></div>
				<button class="bt-btn bt-btn--primary bt-js-open" data-form="application"
					data-tour="<?php echo esc_attr( get_the_title() . ' (' . $d . ')' ); ?>">Забронировать</button>
			</div>
		<?php }
		echo '</div>';
		wp_reset_postdata();
		return ob_get_clean();
	}

	public function sc_reviews( $atts ) {
		$atts = shortcode_atts( [ 'limit' => 6 ], $atts );
		$q = new WP_Query( [
			'post_type'      => 'bt_review',
			'posts_per_page' => (int) $atts['limit'],
			'post_status'    => 'publish',
		] );
		ob_start();
		echo '<div class="bt-reviews"><div class="bt-reviews__track">';
		if ( $q->have_posts() ) {
			while ( $q->have_posts() ) { $q->the_post();
				$id = get_the_ID();
				$r = (int) get_post_meta( $id, '_bt_r_rating', true ) ?: 5;
				$city = get_post_meta( $id, '_bt_r_city', true );
				$tour = get_post_meta( $id, '_bt_r_tour', true );
				$name = get_the_title();
				$initial = mb_substr( $name, 0, 1, 'UTF-8' );
				?>
				<article class="bt-review">
					<div class="bt-review__stars"><?php for($s=0;$s<$r;$s++) echo bt_icon( 'star', 'bt-icon bt-icon--sm' ); ?></div>
					<div class="bt-review__body"><?php echo wp_kses_post( wpautop( get_the_content() ) ); ?></div>
					<div class="bt-review__author">
						<div class="bt-review__avatar"><?php echo esc_html( mb_strtoupper( $initial ) ); ?></div>
						<div>
							<div class="bt-review__name"><?php echo esc_html( $name ); ?></div>
							<div class="bt-review__meta"><?php echo esc_html( trim( $city . ( $tour ? ' · ' . $tour : '' ), ' ·' ) ); ?></div>
						</div>
					</div>
				</article>
			<?php }
			wp_reset_postdata();
		} else {
			?>
			<article class="bt-review">
				<div class="bt-review__stars"><?php for($s=0;$s<5;$s++) echo bt_icon( 'star', 'bt-icon bt-icon--sm' ); ?></div>
				<div class="bt-review__body">Ездили большой компанией в Брест — всё было отлично организовано, водитель внимательный, отель чистый, экскурсия живая. Спасибо БархатТрэвел!</div>
				<div class="bt-review__author"><div class="bt-review__avatar">М</div><div><div class="bt-review__name">Мария</div><div class="bt-review__meta">Полоцк · Великий и непокорённый Брест</div></div></div>
			</article>
			<article class="bt-review">
				<div class="bt-review__stars"><?php for($s=0;$s<5;$s++) echo bt_icon( 'star', 'bt-icon bt-icon--sm' ); ?></div>
				<div class="bt-review__body">Возили школу в «Линию Сталина» — детям понравилось, всё прошло чётко по программе. Очень удобно работать с этим агентством.</div>
				<div class="bt-review__author"><div class="bt-review__avatar">Е</div><div><div class="bt-review__name">Елена</div><div class="bt-review__meta">Новополоцк · Школьная поездка</div></div></div>
			</article>
			<article class="bt-review">
				<div class="bt-review__stars"><?php for($s=0;$s<5;$s++) echo bt_icon( 'star', 'bt-icon bt-icon--sm' ); ?></div>
				<div class="bt-review__body">Спасибо за «Шчодрую Масленіцу ў Суле»! Программа насыщенная, блины — объедение, дети в восторге.</div>
				<div class="bt-review__author"><div class="bt-review__avatar">А</div><div><div class="bt-review__name">Алексей</div><div class="bt-review__meta">Витебск · Сула</div></div></div>
			</article>
			<?php
		}
		echo '</div></div>';
		return ob_get_clean();
	}

	public function sc_review_form() {
		ob_start(); ?>
		<form class="bt-form bt-js-form" data-form="review" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<input type="hidden" name="action" value="bt_review_submit">
			<?php wp_nonce_field( self::NONCE, 'bt_nonce' ); ?>
			<input type="text" name="bt_hp" tabindex="-1" autocomplete="off" class="bt-hp" aria-hidden="true">
			<label>Ваше имя*
				<input type="text" name="name" required>
			</label>
			<label>Город
				<input type="text" name="city">
			</label>
			<label>Тур / поездка
				<input type="text" name="tour">
			</label>
			<label>Оценка
				<select name="rating">
					<option value="5">★★★★★ — отлично</option>
					<option value="4">★★★★☆ — хорошо</option>
					<option value="3">★★★☆☆ — нормально</option>
					<option value="2">★★☆☆☆ — могло быть лучше</option>
					<option value="1">★☆☆☆☆ — плохо</option>
				</select>
			</label>
			<label>Текст отзыва*
				<textarea name="text" required rows="5"></textarea>
			</label>
			<label class="bt-consent">
				<input type="checkbox" required>
				<span>Согласен на <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">обработку персональных данных</a></span>
			</label>
			<button type="submit" class="bt-btn bt-btn--primary">Отправить отзыв</button>
			<div class="bt-form__msg" role="status" aria-live="polite"></div>
		</form>
		<?php return ob_get_clean();
	}
}

new BT_Core();
