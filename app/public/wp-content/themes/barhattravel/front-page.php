<?php
/**
 * Front page — лендинг по складкам.
 */
get_header();
?>

<!-- ============ HERO ============ -->
<section class="bt-hero" id="hero">
	<div class="bt-hero__bg"></div>
	<div class="bt-hero__image" style="background-image:url('<?php echo esc_url( BT_THEME_URI ); ?>/assets/img/hero.jpg')" aria-hidden="true"></div>
	<div class="bt-container bt-hero__inner">
		<div class="bt-hero__main">
			<div class="bt-hero__copy">
				<h1 class="bt-hero__title">ООО «БархатТрэвел»<br><em>Ваше лучшее путешествие начинается здесь</em></h1>
				<p class="bt-hero__sub">Автобусные туры, экскурсии, пляжный отдых, школьные поездки и аренда комфортабельного транспорта. Для Вас с 2020 года!</p>
			</div>
			<div class="bt-hero__actions bt-hero__actions--stack">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'bt_tour' ) ); ?>" class="bt-btn bt-btn--primary bt-btn--lg"><?php echo bt_icon( 'compass', 'bt-icon bt-icon--sm' ); ?> Выбрать тур</a>
				<a href="#" class="bt-btn bt-btn--ghost bt-btn--lg bt-js-open" data-form="callback"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> Заказать звонок</a>
			</div>
		</div>
		<div class="bt-hero__badges">
			<span class="bt-hero__badge"><strong>★</strong> Открытие года 2025</span>
			<span class="bt-hero__badge"><strong>РАТА</strong> · член ассоциации</span>
			<span class="bt-hero__badge"><strong>100+</strong> туров в каталоге</span>
			<span class="bt-hero__badge"><strong>2 офиса</strong> в Полоцке и Новополоцке</span>
		</div>
	</div>
</section>

<!-- ============ ABOUT + ADVANTAGES ============ -->
<section class="bt-section bt-worldmap" id="about">
	<div class="bt-container">
		<div class="bt-feature-row">
			<div class="bt-feature-row__content">
				<p class="bt-eyebrow">О нас</p>
				<h2 class="bt-h2">Туристическая фирма <span class="bt-nowrap">«БархатТрэвел»</span></h2>
				<p>Для вас мы оказываем весь спектр туристических услуг — от автобусных туров по Беларуси до пляжного отдыха на берегу океана.</p>
				<ul class="bt-services bt-services--single bt-mt-3">
					<li><strong>Перевозки</strong> — все виды пассажирских перевозок</li>
					<li><strong>Сборные туры</strong> по Беларуси, России и странам зарубежья</li>
					<li><strong>Корпоративные туры</strong>, тимбилдинг, мероприятия</li>
					<li><strong>Индивидуальные туры</strong> с отдыхом на море</li>
					<li><strong>Экскурсионные туры</strong> и тематические поездки</li>
					<li><strong>Бронирование</strong> отелей, билетов, мест проведения</li>
					<li><strong>Страхование</strong> жизни и здоровья туристов</li>
				</ul>
			</div>
			<div class="bt-feature-row__media">
				<div class="bt-circle bt-circle--xl">
					<img src="<?php echo esc_url( BT_THEME_URI ); ?>/assets/img/hero.jpg" alt="Беларусь — путешествуйте с БархатТрэвел" loading="lazy">
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ============ ADVANTAGES ============ -->
<section class="bt-section bt-section--soft bt-worldmap" id="advantages">
	<div class="bt-container">
		<div class="bt-section__head">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Наши преимущества</p>
				<h2 class="bt-h2">Почему туристы выбирают БархатТрэвел</h2>
			</div>
		</div>

		<div class="bt-advantages">
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'shield' ); ?></div>
				<h3>Безопасность</h3>
				<p>Официальное оформление, страхование туристов, регулярные техосмотры собственного транспорта.</p>
			</div>
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'compass' ); ?></div>
				<h3>Разнообразие маршрутов</h3>
				<p>100+ маршрутов — от ночного Полоцка до пляжей Шри-Ланки и замков Литвы.</p>
			</div>
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'tag' ); ?></div>
				<h3>Конкурентные цены</h3>
				<p>Гибкая система скидок для постоянных клиентов, групп и школьников.</p>
			</div>
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'heart' ); ?></div>
				<h3>Индивидуальный подход</h3>
				<p>Подбираем тур под ваши пожелания: бюджет, состав группы, особенности маршрута.</p>
			</div>
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'star' ); ?></div>
				<h3>Открытие года 2025</h3>
				<p>Победитель конкурса субъектов тур. деятельности. Член РАТА, сертификация — лето 2026.</p>
			</div>
		</div>

		<h3 class="bt-h3 bt-mt-4">Как мы работаем</h3>
		<div class="bt-steps bt-mt-2">
			<div class="bt-step">
				<h4>Заявка</h4>
				<p>Оставляете заявку на сайте, в мессенджере или по телефону.</p>
			</div>
			<div class="bt-step">
				<h4>Подбор маршрута</h4>
				<p>Подбираем подходящий тур или собираем индивидуальную программу.</p>
			</div>
			<div class="bt-step">
				<h4>Договор и оплата</h4>
				<p>Заключаем договор, оформляем страховку, выбираем удобный способ оплаты.</p>
			</div>
			<div class="bt-step">
				<h4>Поездка</h4>
				<p>Встречаем у автобуса, сопровождаем по программе, на связи 24/7.</p>
			</div>
		</div>

		<div class="bt-trust">
			<div class="bt-trust__badge"><?php echo bt_icon( 'check' ); ?> <span>Член <strong>РАТА</strong> — Республиканский Альянс Туриндустрии</span></div>
			<div class="bt-trust__badge"><?php echo bt_icon( 'star' ); ?> <span><strong>«Открытие года 2025»</strong> — победитель конкурса субъектов тур.деятельности</span></div>
			<div class="bt-trust__badge"><?php echo bt_icon( 'shield' ); ?> <span>Плановая <strong>сертификация — лето 2026</strong></span></div>
		</div>
	</div>
</section>

<!-- ============ TRANSPORT RENTAL ============ -->
<section class="bt-section bt-section--dark" id="transport">
	<div class="bt-container">
		<div class="bt-transport-rental">
			<div>
				<p class="bt-eyebrow">Аренда транспорта</p>
				<h2 class="bt-h2">Собственный комфортабельный автопарк</h2>
				<p>Мы выполняем пассажирские перевозки по Беларуси и за рубежом — для туристических групп, корпоративных мероприятий, школьных поездок и индивидуальных заказов.</p>
				<div class="bt-transport-rental__list">
					<div><strong>Mercedes Sprinter</strong>До 19 мест, кондиционер, ТВ</div>
					<div><strong>Туристические автобусы</strong>40-50 мест, багажный отсек, микрофон</div>
					<div><strong>Минивэны</strong>Семейные и групповые поездки до 8 человек</div>
					<div><strong>Техосмотры</strong>Регулярные, опытные водители категории D</div>
				</div>
				<p class="bt-mt-3">
					<a class="bt-btn bt-btn--primary bt-js-open" data-form="application" data-subject="Аренда транспорта"><?php echo bt_icon( 'bus', 'bt-icon bt-icon--sm' ); ?> Заказать транспорт</a>
				</p>
			</div>
			<div class="bt-transport-rental__media">
				<?php
				$bus_img = BT_THEME_URI . '/assets/img/bus.jpg';
				// fall back to icon if image is absent
				if ( file_exists( BT_THEME_DIR . '/assets/img/bus.jpg' ) ) {
					echo '<img src="' . esc_url( $bus_img ) . '" alt="Автопарк БархатТрэвел" loading="lazy">';
				} else {
					echo bt_icon( 'bus', 'bt-icon' );
				}
				?>
			</div>
		</div>
	</div>
</section>

<!-- ============ EACH CATEGORY — SEPARATE SECTION ============ -->
<?php
$cat_pages = [
	'tours-catalog' => '/tours-catalog/',
	'excursions'    => '/excursions/',
	'abroad'        => '/abroad/',
	'beach'         => '/beach/',
	'school-tours'  => '/school-tours/',
];
$idx = 0;
foreach ( bt_tour_categories() as $slug => $cat ) :
	$url       = $cat_pages[ $slug ] ?? '#';
	$reverse   = ( $idx % 2 === 1 ) ? ' bt-feature-row--reverse' : '';
	$soft      = ( $idx % 2 === 1 ) ? ' bt-section--soft' : '';
	// Per-category circle overrides (image only — size is unified)
	$circle_size = 'bt-circle--xl';
	$circle_img  = $cat['banner'];
	if ( $slug === 'tours-catalog' ) {
		$circle_img = 'bus-tour.jpg';
	}
	$idx++;
?>
<section class="bt-section bt-worldmap<?php echo $soft; ?>" id="cat-<?php echo esc_attr( $slug ); ?>">
	<div class="bt-container">
		<div class="bt-feature-row<?php echo $reverse; ?>">
			<div class="bt-feature-row__media">
				<a href="<?php echo esc_url( home_url( $url ) ); ?>" class="bt-circle <?php echo esc_attr( $circle_size ); ?>" aria-label="<?php echo esc_attr( $cat['title'] ); ?>">
					<img src="<?php echo esc_url( BT_THEME_URI . '/assets/img/' . $circle_img ); ?>" alt="<?php echo esc_attr( $cat['title'] ); ?>" loading="lazy">
				</a>
			</div>
			<div class="bt-feature-row__content">
				<p class="bt-eyebrow"><?php echo esc_html( $cat['eyebrow'] ); ?></p>
				<h2 class="bt-h2"><?php echo esc_html( $cat['title'] ); ?></h2>
				<p><?php echo esc_html( $cat['short'] ); ?></p>
				<ul class="bt-services bt-services--single bt-mt-2">
					<?php foreach ( array_slice( $cat['destinations'], 0, 4 ) as $d ) : ?>
						<li><strong><?php echo esc_html( $d['name'] ); ?></strong><?php if ( ! empty( $d['sub'] ) ) echo ' — ' . esc_html( $d['sub'] ); ?></li>
					<?php endforeach; ?>
					<?php if ( count( $cat['destinations'] ) > 4 ) : ?>
						<li><em>… и ещё <?php echo count( $cat['destinations'] ) - 4; ?> направлен<?php echo ( count( $cat['destinations'] ) - 4 ) === 1 ? 'ие' : 'ий'; ?></em></li>
					<?php endif; ?>
				</ul>
				<p class="bt-mt-3">
					<a class="bt-btn bt-btn--primary bt-btn--lg" href="<?php echo esc_url( home_url( $url ) ); ?>">
						<?php echo bt_icon( $cat['icon'], 'bt-icon bt-icon--sm' ); ?>
						Все направления
					</a>
				</p>
			</div>
		</div>
	</div>
</section>
<?php endforeach; ?>

<!-- ============ REVIEWS ============ -->
<section class="bt-section bt-worldmap" id="reviews">
	<div class="bt-container">
		<div class="bt-section__head">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Отзывы</p>
				<h2 class="bt-h2">Наши счастливые и благодарные туристы</h2>
				<p>Мы работаем для вас, и ваши отзывы очень важны для нас — чтобы мы становились ещё лучше день за днём!</p>
			</div>
			<div class="bt-section__cta">
				<a class="bt-btn bt-btn--primary bt-js-open" data-form="review">Оставить отзыв</a>
			</div>
		</div>
		<?php echo do_shortcode( '[bt_reviews limit="9"]' ); ?>
	</div>
</section>

<!-- ============ NEWS ============ -->
<section class="bt-section bt-section--soft bt-worldmap" id="news">
	<div class="bt-container">
		<div class="bt-section__head">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Новости</p>
				<h2 class="bt-h2">Свежие объявления и расписание</h2>
				<p>Актуальные объявления о поездках, расписание выездов и полезные статьи о путешествиях.</p>
			</div>
			<div class="bt-section__cta">
				<a class="bt-btn bt-btn--dark" href="<?php echo esc_url( home_url( '/?post_type=post' ) ); ?>">Все новости →</a>
			</div>
		</div>
		<?php
		$news = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 3 ] );
		if ( $news->have_posts() ) {
			echo '<div class="bt-grid bt-grid--3 bt-news">';
			while ( $news->have_posts() ) { $news->the_post(); ?>
				<article class="bt-card">
					<a class="bt-card__media <?php echo has_post_thumbnail() ? '' : 'bt-card__media--fallback'; ?>" href="<?php the_permalink(); ?>" style="--bt-card-grad: <?php echo esc_attr( bt_card_gradient( $news->current_post ) ); ?>">
						<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'bt-tour-card', [ 'loading' => 'lazy' ] ); else echo bt_icon( 'calendar' ); ?>
					</a>
					<div class="bt-card__body">
						<p class="bt-eyebrow"><?php echo esc_html( get_the_date() ); ?></p>
						<h3 class="bt-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="bt-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
						<div class="bt-card__footer"><a class="bt-link" href="<?php the_permalink(); ?>">Читать →</a></div>
					</div>
				</article>
			<?php }
			echo '</div>';
			wp_reset_postdata();
		} else { ?>
			<div class="bt-grid bt-grid--3 bt-news">
				<article class="bt-card">
					<div class="bt-card__media bt-card__media--fallback" style="--bt-card-grad: linear-gradient(135deg,#1E4FB8,#0E2A5E)"><?php echo bt_icon( 'calendar' ); ?></div>
					<div class="bt-card__body">
						<p class="bt-eyebrow">Скоро</p>
						<h3 class="bt-card__title">Раздел новостей наполняется</h3>
						<p class="bt-card__excerpt">Здесь будут появляться объявления о ближайших выездах, новые маршруты и полезные статьи.</p>
					</div>
				</article>
			</div>
		<?php } ?>
	</div>
</section>

<!-- ============ CONTACT CTA ============ -->
<section class="bt-section bt-section--dark">
	<div class="bt-container bt-center">
		<p class="bt-eyebrow">Готовы поехать?</p>
		<h2 class="bt-h2">Свяжитесь с нами — подберём тур за 15 минут</h2>
		<p class="bt-mt-2" style="opacity:.9">Два офиса · мессенджеры · телефон. Отвечаем в течение рабочего дня.</p>
		<div class="bt-hero__actions" style="justify-content:center; margin-top:24px">
			<a class="bt-btn bt-btn--primary bt-btn--lg bt-js-open" data-form="application"><?php echo bt_icon( 'plane', 'bt-icon bt-icon--sm' ); ?> Оставить заявку</a>
			<a class="bt-btn bt-btn--ghost bt-btn--lg" href="tel:+375296041234"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> +375 29 604-12-34</a>
		</div>
	</div>
</section>

<?php get_footer();
