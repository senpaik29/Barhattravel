<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Office contacts shown in header / footer.
 */
function bt_offices() {
	return [
		[
			'city'    => 'Полоцк',
			'address' => 'ул. Октябрьская, д. 54, пом. 408',
			'phone'   => '+375 29 604-12-34',
			'tel'     => '+375296041234',
		],
		[
			'city'    => 'Новополоцк',
			'address' => 'ул. Якуба Коласа, д. 48, офис 108',
			'phone'   => '+375 29 214-20-06',
			'tel'     => '+375292142006',
		],
	];
}

function bt_email() {
	return 'ooobarhattravel@gmail.com';
}

/**
 * Google Maps search URL for an office address.
 */
function bt_office_map_url( $office ) {
	$query = $office['address'] . ', ' . $office['city'] . ', Беларусь';
	return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $query );
}

function bt_social() {
	return [
		'telegram'  => 'https://t.me/barhat_travel_belarus',
		'viber'     => 'viber://chat?number=%2B375296041234',
		'whatsapp'  => 'https://wa.me/375296041234',
		'instagram' => 'https://www.instagram.com/barhattravel.by',
		'facebook'  => 'https://www.facebook.com/share/14pRMQsct3/?mibextid=LQQI4d',
		'tiktok'    => '#', // TODO: заменить на реальную ссылку
	];
}

/**
 * Pretty-print a phone number for tel:.
 */
function bt_tel( $phone ) {
	return preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * SVG icon — keeps markup tidy and avoids extra HTTP requests.
 */
function bt_icon( $name, $class = 'bt-icon' ) {
	$icons = [
		'phone'     => '<path d="M4 5c0-1 1-2 2-2h2l2 4-2 1c.5 2 2 3.5 4 4l1-2 4 2v2c0 1-1 2-2 2C9 16 4 11 4 5z"/>',
		'mail'     => '<path d="M3 5h18v14H3z"/><path d="M3 5l9 7 9-7"/>',
		'map'      => '<path d="M12 2a7 7 0 00-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 00-7-7z"/><circle cx="12" cy="9" r="2.5"/>',
		'bus'      => '<rect x="3" y="5" width="18" height="12" rx="2"/><circle cx="8" cy="18" r="2"/><circle cx="16" cy="18" r="2"/><path d="M3 11h18M8 5v6M16 5v6"/>',
		'shield'   => '<path d="M12 2l8 3v6c0 5-4 9-8 11-4-2-8-6-8-11V5l8-3z"/><path d="M9 12l2 2 4-4"/>',
		'compass'  => '<circle cx="12" cy="12" r="9"/><path d="M15 9l-2 6-6 2 2-6 6-2z"/>',
		'tag'      => '<path d="M3 12V3h9l9 9-9 9-9-9z"/><circle cx="8" cy="8" r="1.5"/>',
		'steps'    => '<path d="M4 19h4v-4M10 15h4v-4M16 11h4V7"/>',
		'heart'    => '<path d="M12 21s-7-4.5-9.5-9A5 5 0 0112 6a5 5 0 019.5 6C19 16.5 12 21 12 21z"/>',
		'check'    => '<path d="M4 12l5 5 11-11"/>',
		'x'        => '<path d="M6 6l12 12M18 6L6 18"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'star'     => '<path d="M12 3l2.9 5.9 6.5.9-4.7 4.6 1.1 6.5L12 17.8 6.2 21l1.1-6.5L2.6 9.8l6.5-.9L12 3z"/>',
		'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'users'    => '<circle cx="9" cy="8" r="3"/><path d="M3 20c0-3 3-5 6-5s6 2 6 5"/><circle cx="17" cy="9" r="2.5"/><path d="M15 20c0-2 2-3.5 4-3.5s2 1 2 3.5"/>',
		'globe'    => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c3 4 3 14 0 18M12 3c-3 4-3 14 0 18"/>',
		'plane'    => '<path d="M10 2l2 8 9 3-9 3-2 8-1-8-7-3 7-3 1-8z"/>',
		'beach'    => '<circle cx="6" cy="6" r="3"/><path d="M6 9v12M2 21h20M10 9c2 0 5 1 8 4"/>',
		'castle'   => '<path d="M3 21V9l3 2V7l3 2V5l3 2V5l3 2v4l3-2v12H3z"/>',
		'school'   => '<path d="M2 9l10-5 10 5-10 5L2 9z"/><path d="M6 11v6l6 3 6-3v-6"/>',
		'tg'       => '<path d="M21 4L3 11l5 2 2 6 3-4 5 4 3-15z"/>',
		'ig'       => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/>',
		'fb'       => '<path d="M14 9V7a1 1 0 011-1h2V3h-3a4 4 0 00-4 4v2H8v3h3v8h3v-8h2.5l.5-3H14z"/>',
		'tt'       => '<path d="M16 3a4 4 0 004 4v3a7 7 0 01-4-1v6a5 5 0 11-5-5v3a2 2 0 102 2V3z"/>',
		'wa'       => '<path d="M3 21l1.5-5A8 8 0 1112 20a8 8 0 01-4-1L3 21z"/>',
		'menu'     => '<path d="M4 6h16M4 12h16M4 18h16"/>',
	];
	$d = $icons[ $name ] ?? '';
	return sprintf(
		'<svg class="%s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%s</svg>',
		esc_attr( $class ),
		$d
	);
}

/**
 * Format a price number with currency.
 */
function bt_price( $value ) {
	$value = (float) $value;
	if ( $value <= 0 ) {
		return __( 'По запросу', 'barhattravel' );
	}
	return number_format( $value, 0, ',', ' ' ) . ' BYN';
}

/**
 * Render a branded page hero (light-blue gradient + map watermark).
 * Used at the top of inner pages for consistent design.
 *
 * $args = [ 'eyebrow' => '', 'title' => '', 'subtitle' => '', 'slogan' => '', 'crumbs' => [['url','label']] ]
 */
function bt_page_hero( $args = [] ) {
	$args = wp_parse_args( $args, [
		'eyebrow'  => '',
		'title'    => '',
		'subtitle' => '',
		'slogan'   => '',
		'crumbs'   => [],
	] );
	?>
	<section class="bt-page-hero">
		<div class="bt-container">
			<div class="bt-page-hero__inner">
				<?php if ( $args['crumbs'] ) : ?>
					<nav class="bt-page-hero__breadcrumbs" aria-label="Хлебные крошки">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<?php foreach ( $args['crumbs'] as $i => $c ) : ?>
							<span>›</span>
							<?php if ( $i < count( $args['crumbs'] ) - 1 && ! empty( $c['url'] ) ) : ?>
								<a href="<?php echo esc_url( $c['url'] ); ?>"><?php echo esc_html( $c['label'] ); ?></a>
							<?php else : ?>
								<?php echo esc_html( $c['label'] ); ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>
				<?php if ( $args['eyebrow'] ) : ?>
					<span class="bt-page-hero__eyebrow"><?php echo bt_icon( 'compass', 'bt-icon bt-icon--xs' ); ?> <?php echo esc_html( $args['eyebrow'] ); ?></span>
				<?php endif; ?>
				<h1 class="bt-page-hero__title"><?php echo wp_kses_post( $args['title'] ); ?></h1>
				<?php if ( $args['subtitle'] ) : ?>
					<p class="bt-page-hero__sub"><?php echo esc_html( $args['subtitle'] ); ?></p>
				<?php endif; ?>
				<?php if ( $args['slogan'] ) : ?>
					<p class="bt-page-hero__slogan"><?php echo esc_html( $args['slogan'] ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Tour category catalog data — used by category page templates and homepage promo.
 */
function bt_tour_categories() {
	return [
		'tours-catalog' => [
			'slug'    => 'tours-catalog',
			'icon'    => 'bus',
			'banner'  => 'bus-tour.jpg',
			'title'   => 'Автобусные туры по Беларуси',
			'eyebrow' => 'Двухдневные туры',
			'desc'    => 'Насыщенная программа, выезд с пятницы или субботы.',
			'short'   => 'Гродно, Брест, Бобруйск-Гомель и однодневное «Вокруг Минска» — короткие выходные с насыщенной программой.',
			'destinations' => [
				[ 'name' => 'Гродно',           'icon' => 'castle', 'sub' => 'Старый город · 2 дня',         'image' => 'dest-grodno.jpg' ],
				[ 'name' => 'Брест',            'icon' => 'castle', 'sub' => 'Крепость, форт №5 · 2 дня',    'image' => 'dest-brest.jpg' ],
				[ 'name' => 'Бобруйск – Гомель','icon' => 'map',    'sub' => 'Восток Беларуси · 2 дня',      'image' => 'dest-bobruysk-gomel.jpg' ],
				[ 'name' => 'Вокруг Минска',    'icon' => 'castle', 'sub' => 'Мир, Несвиж, усадьбы · 2 дня', 'image' => 'dest-mir-nesvizh.jpg' ],
			],
		],
		'excursions' => [
			'slug'    => 'excursions',
			'icon'    => 'compass',
			'banner'  => 'cat-excursions.jpg',
			'title'   => 'Экскурсии',
			'eyebrow' => 'Однодневные и тематические',
			'desc'    => 'Однодневные и тематические экскурсии — от ночного Полоцка до парк-музея «Сула» и БелАЗа.',
			'short'   => 'От ночного Полоцка до парк-музея «Сула», карьерных самосвалов БелАЗ и средневековых замков.',
			'destinations' => [
				[ 'name' => 'Полоцк Ночной',         'icon' => 'castle',  'sub' => 'Вечерняя экскурсия',     'image' => 'dest-polotsk.jpg' ],
				[ 'name' => 'Промышленный Слоним',   'icon' => 'compass', 'sub' => 'Город и заводы',         'image' => 'dest-slonim.jpg' ],
				[ 'name' => 'Замки Коссово, Ружаны', 'icon' => 'castle',  'sub' => '+ усадьба Литовка',      'image' => 'dest-kossovo-ruzhany.jpg' ],
				[ 'name' => 'Парк улиток',           'icon' => 'heart',   'sub' => 'Семейный выезд',         'image' => 'dest-snail-park.jpg' ],
				[ 'name' => 'БелАЗ',                 'icon' => 'bus',     'sub' => 'Гигантские самосвалы',   'image' => 'dest-belaz.jpg' ],
				[ 'name' => 'Сула',                  'icon' => 'castle',  'sub' => 'Великое Княжество',      'image' => 'dest-sula.jpg' ],
				[ 'name' => 'Наносы',                'icon' => 'map',     'sub' => 'Этно-комплекс',          'image' => 'dest-nanosy.jpg' ],
				[ 'name' => 'Новогрудок',            'icon' => 'castle',  'sub' => 'Первая столица ВКЛ',     'image' => 'dest-novogrudok.jpg' ],
			],
		],
		'abroad' => [
			'slug'    => 'abroad',
			'icon'    => 'globe',
			'banner'  => 'cat-abroad.jpg',
			'title'   => 'Туры в РФ и зарубежье',
			'eyebrow' => 'Многодневные поездки',
			'desc'    => 'Многодневные поездки в Россию и страны ближнего зарубежья. Сборные группы и индивидуальные программы.',
			'short'   => 'Многодневные сборные туры и индивидуальные программы по России и ближнему зарубежью.',
			'destinations' => [
				[ 'name' => 'Санкт-Петербург', 'icon' => 'castle',  'flag' => '🇷🇺', 'sub' => '4-5 дней',           'image' => 'dest-spb.jpg' ],
				[ 'name' => 'Москва',          'icon' => 'castle',  'flag' => '🇷🇺', 'sub' => 'Кремль и центр',     'image' => 'dest-moscow.jpg' ],
				[ 'name' => 'Псков',           'icon' => 'castle',  'flag' => '🇷🇺', 'sub' => 'Кремль и монастыри', 'image' => 'dest-pskov.jpg' ],
				[ 'name' => 'Пушкинские Горы', 'icon' => 'compass', 'flag' => '🇷🇺', 'sub' => 'Михайловское',       'image' => 'dest-pushkin-mountains.jpg' ],
			],
		],
		'beach' => [
			'slug'    => 'beach',
			'icon'    => 'beach',
			'banner'  => 'cat-beach.jpg',
			'title'   => 'Пляжный отдых',
			'eyebrow' => 'Тёплое море круглый год',
			'desc'    => 'Чартеры и регулярные рейсы. Тёплое море круглый год — на любой бюджет.',
			'short'   => 'Чартеры и регулярные рейсы. Тёплое море на любой бюджет — от Египта до Шри-Ланки.',
			'destinations' => [
				[ 'name' => 'Египет',    'icon' => 'beach', 'flag' => '🇪🇬', 'image' => 'dest-egypt.jpg' ],
				[ 'name' => 'Турция',    'icon' => 'beach', 'flag' => '🇹🇷', 'image' => 'dest-turkey.jpg' ],
				[ 'name' => 'Шри-Ланка', 'icon' => 'beach', 'flag' => '🇱🇰', 'image' => 'dest-sri-lanka.jpg' ],
				[ 'name' => 'ОАЭ',       'icon' => 'beach', 'flag' => '🇦🇪', 'image' => 'dest-uae.jpg' ],
				[ 'name' => 'Таиланд',   'icon' => 'beach', 'flag' => '🇹🇭', 'image' => 'dest-thailand.jpg' ],
				[ 'name' => 'Вьетнам',   'icon' => 'beach', 'flag' => '🇻🇳', 'image' => 'dest-vietnam.jpg' ],
				[ 'name' => 'Китай',     'icon' => 'globe', 'flag' => '🇨🇳', 'image' => 'dest-china.jpg' ],
				[ 'name' => 'Испания',   'icon' => 'beach', 'flag' => '🇪🇸', 'image' => 'dest-spain.jpg' ],
				[ 'name' => 'Италия',    'icon' => 'castle','flag' => '🇮🇹', 'image' => 'dest-italy.jpg' ],
				[ 'name' => 'Греция',    'icon' => 'beach', 'flag' => '🇬🇷', 'image' => 'dest-greece.jpg' ],
			],
		],
		'school-tours' => [
			'slug'    => 'school-tours',
			'icon'    => 'school',
			'banner'  => 'cat-school.jpg',
			'title'   => 'Школьные поездки',
			'eyebrow' => 'Образовательный туризм',
			'desc'    => 'Историко-патриотические программы, интерактивные музеи, безопасные группы со страховкой каждого ребёнка.',
			'short'   => 'Историко-патриотические программы и интерактивные музеи, страховка каждого ребёнка в стоимости.',
			'destinations' => [
				[ 'name' => 'Линия Сталина',        'icon' => 'shield',  'sub' => 'Историко-культурный комплекс', 'image' => 'dest-stalin-line.jpg' ],
				[ 'name' => 'Альбатрос',            'icon' => 'compass', 'sub' => 'Конно-исторический комплекс',  'image' => 'dest-albatros.jpg' ],
				[ 'name' => 'Парк «Страна мини»',   'icon' => 'castle',  'sub' => 'Беларусь в макетах',           'image' => 'dest-mini-country.jpg' ],
				[ 'name' => 'Хатынь',               'icon' => 'heart',   'sub' => 'Мемориал',                     'image' => 'dest-khatyn.jpg' ],
				[ 'name' => 'Ржев + Музей Авиации', 'icon' => 'plane',   'flag' => '🇷🇺', 'sub' => 'Многодневный', 'image' => 'dest-rzhev.jpg' ],
			],
		],
	];
}

/**
 * Look up a bt_tour post whose title contains the given destination name.
 * Returns permalink, or null if no match.
 */
function bt_find_tour_link( $destination_name ) {
	static $cache = null;
	if ( $cache === null ) {
		$cache = [];
		$tours = get_posts( [
			'post_type'      => 'bt_tour',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		] );
		foreach ( $tours as $t ) {
			$cache[] = [ 'title' => $t->post_title, 'url' => get_permalink( $t ) ];
		}
	}
	$needle = mb_strtolower( trim( $destination_name ) );
	// Strip decorative parts like "«...»" quotes and " – ... " suffixes for better matching
	$needle_clean = trim( preg_replace( '/[«»"]/u', '', $needle ) );
	foreach ( $cache as $t ) {
		$title = mb_strtolower( $t['title'] );
		// Exact substring match
		if ( mb_strpos( $title, $needle_clean ) !== false ) {
			return $t['url'];
		}
		// Morphological match — drop last 1-2 chars to catch case endings (Сула/Суле, Полоцк/Полоцка etc)
		if ( mb_strlen( $needle_clean ) >= 4 ) {
			$stem = mb_substr( $needle_clean, 0, -1 );
			if ( mb_strpos( $title, $stem ) !== false ) {
				return $t['url'];
			}
			if ( mb_strlen( $needle_clean ) >= 5 ) {
				$stem2 = mb_substr( $needle_clean, 0, -2 );
				if ( mb_strpos( $title, $stem2 ) !== false ) {
					return $t['url'];
				}
			}
		}
	}
	return null;
}

/**
 * Render a category page section (banner + destination grid).
 */
function bt_render_category_block( $slug ) {
	$cats = bt_tour_categories();
	if ( ! isset( $cats[ $slug ] ) ) return;
	$cat = $cats[ $slug ];
	$grads = [
		'linear-gradient(135deg,#3525cd,#712ae2)',
		'linear-gradient(135deg,#4f46e5,#8a4cfc)',
		'linear-gradient(135deg,#004d70,#006693)',
		'linear-gradient(135deg,#712ae2,#3525cd)',
		'linear-gradient(135deg,#3525cd,#004d70)',
		'linear-gradient(135deg,#8a4cfc,#4f46e5)',
	];
	?>
	<div class="bt-cat" id="cat-<?php echo esc_attr( $cat['slug'] ); ?>">
		<div class="bt-cat__head">
			<img src="<?php echo esc_url( BT_THEME_URI . '/assets/img/' . $cat['banner'] ); ?>" alt="<?php echo esc_attr( $cat['title'] ); ?>" loading="lazy">
			<div class="bt-cat__head-inner">
				<div class="bt-cat__icon"><?php echo bt_icon( $cat['icon'] ); ?></div>
				<div>
					<h2><?php echo esc_html( $cat['title'] ); ?></h2>
					<p><?php echo esc_html( $cat['desc'] ); ?></p>
				</div>
			</div>
		</div>

		<div class="bt-destinations">
			<?php foreach ( $cat['destinations'] as $i => $d ) :
				$tour_url = bt_find_tour_link( $d['name'] );
				if ( $tour_url ) {
					$link_attrs = 'href="' . esc_url( $tour_url ) . '"';
					$link_extra = '';
				} else {
					// Нет отдельной страницы тура — клик открывает форму заявки, помеченную названием направления.
					$link_attrs = 'href="#application"';
					$link_extra = ' bt-js-open" data-form="application" data-tour="' . esc_attr( $d['name'] );
				}
			?>
				<a class="bt-destination<?php echo $link_extra; ?>" <?php echo $link_attrs; ?>>
					<div class="bt-destination__pic <?php echo ! empty( $d['image'] ) ? 'bt-destination__pic--photo' : ''; ?>" style="--bt-d-grad: <?php echo esc_attr( $grads[ $i % count( $grads ) ] ); ?>">
						<?php if ( ! empty( $d['image'] ) ) : ?>
							<img src="<?php echo esc_url( BT_THEME_URI . '/assets/img/' . $d['image'] ); ?>" alt="<?php echo esc_attr( $d['name'] ); ?>" loading="lazy">
						<?php else : ?>
							<?php echo bt_icon( $d['icon'] ); ?>
						<?php endif; ?>
						<?php if ( ! empty( $d['flag'] ) ) : ?>
							<span class="bt-destination__flag" aria-hidden="true"><?php echo esc_html( $d['flag'] ); ?></span>
						<?php endif; ?>
					</div>
					<div class="bt-destination__body">
						<div>
							<div class="bt-destination__name"><?php echo esc_html( $d['name'] ); ?></div>
							<?php if ( ! empty( $d['sub'] ) ) : ?>
								<div class="bt-destination__sub"><?php echo esc_html( $d['sub'] ); ?></div>
							<?php endif; ?>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

/**
 * Cool gradient picker per index — keeps tour cards visually varied.
 */
function bt_card_gradient( $i ) {
	$g = [
		'linear-gradient(135deg,#1E4FB8,#0E2A5E)',
		'linear-gradient(135deg,#0EA5E9,#0E2A5E)',
		'linear-gradient(135deg,#F59E0B,#E63946)',
		'linear-gradient(135deg,#10B981,#0E2A5E)',
		'linear-gradient(135deg,#8B5CF6,#1E4FB8)',
		'linear-gradient(135deg,#FFC93C,#F59E0B)',
	];
	return $g[ $i % count( $g ) ];
}
