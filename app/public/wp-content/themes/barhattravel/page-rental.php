<?php
/**
 * Template Name: Аренда транспорта
 */
get_header();
while ( have_posts() ) : the_post();
	bt_page_hero( [
		'title'    => 'Собственный <em>комфортабельный</em> автопарк',
		'subtitle' => 'Все виды пассажирских перевозок по Беларуси, России и странам ближнего зарубежья. Автобусы и микроавтобусы от 17 до 55 мест.',
		'slogan'   => 'Гарантия качества на каждом километре',
		'crumbs'   => [ [ 'label' => 'Аренда транспорта' ] ],
	] );
?>

<section class="bt-section bt-worldmap">
	<div class="bt-container">
		<div class="bt-feature-row">
			<div class="bt-feature-row__media">
				<div class="bt-circle bt-circle--xl">
					<img src="<?php echo esc_url( BT_THEME_URI ); ?>/assets/img/bus.jpg" alt="Автопарк БархатТрэвел">
				</div>
			</div>
			<div class="bt-feature-row__content">
				<p class="bt-eyebrow">Автопарк</p>
				<h2 class="bt-h2">Современный, обслуженный, безопасный</h2>
				<p>Мы не привлекаем сторонних перевозчиков — весь транспорт принадлежит компании, обслуживается у наших механиков и проходит регулярные техосмотры. На дальние маршруты — два водителя, как требует законодательство.</p>
				<ul>
					<li>Регулярная диагностика и страхование транспорта</li>
					<li>Опытные водители категории D со стажем 10+ лет</li>
					<li>Кондиционер, микрофон, телевизор, USB-розетки</li>
					<li>Багажный отсек, ремни безопасности на каждом сидении</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="bt-section bt-section--soft">
	<div class="bt-container">
		<div class="bt-section__head">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Что в автопарке</p>
				<h2 class="bt-h2">От микроавтобуса до туристического лайнера</h2>
				<p>Подберём оптимальный транспорт под размер вашей группы и маршрут.</p>
			</div>
		</div>

		<div class="bt-grid bt-grid--3">
			<div class="bt-advantage" style="background:#fff">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'bus' ); ?></div>
				<h3>Mercedes Sprinter</h3>
				<p>До <strong>19 мест</strong>, кондиционер, ТВ. Идеально для семейных и небольших корпоративных поездок.</p>
			</div>
			<div class="bt-advantage" style="background:#fff">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'bus' ); ?></div>
				<h3>Туристический автобус</h3>
				<p><strong>40-50 мест</strong>, багажный отсек, микрофон. Большие группы, школьные выезды, дальние маршруты.</p>
			</div>
			<div class="bt-advantage" style="background:#fff">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'users' ); ?></div>
				<h3>Минивэн</h3>
				<p>До <strong>8 человек</strong>. Семейные поездки, трансферы аэропорт-отель, индивидуальные экскурсии.</p>
			</div>
		</div>
	</div>
</section>

<section class="bt-section">
	<div class="bt-container">
		<div class="bt-feature-row bt-feature-row--reverse">
			<div class="bt-feature-row__media">
				<div class="bt-circle bt-circle--xl">
					<img src="<?php echo esc_url( BT_THEME_URI ); ?>/assets/img/hero.jpg" alt="Путешествия с БархатТрэвел">
				</div>
			</div>
			<div class="bt-feature-row__content">
				<p class="bt-eyebrow">Куда едем</p>
				<h2 class="bt-h2">География перевозок</h2>
				<p>Беларусь, Россия, страны ближнего зарубежья — Литва, Латвия, Польша, Украина. Для тематических туров — Европа и дальше.</p>
				<ul>
					<li><strong>Корпоративные мероприятия</strong> — конференции, выезды, тимбилдинг</li>
					<li><strong>Свадебные и юбилейные перевозки</strong></li>
					<li><strong>Школьные экскурсии</strong> — со страховкой каждого ребёнка</li>
					<li><strong>Доставка к аэропорту/вокзалу</strong> — Минск-2, Витебск</li>
					<li><strong>Долгосрочная аренда</strong> с водителем</li>
				</ul>
				<p>
					<a class="bt-btn bt-btn--primary bt-js-open" data-form="application" data-subject="Аренда транспорта"><?php echo bt_icon( 'bus', 'bt-icon bt-icon--sm' ); ?> Заказать транспорт</a>
				</p>
			</div>
		</div>
	</div>
</section>

<section class="bt-section bt-section--dark">
	<div class="bt-container bt-center">
		<p class="bt-eyebrow">Расчёт стоимости</p>
		<h2 class="bt-h2">Звоните — посчитаем за 5 минут</h2>
		<p style="opacity:.9; max-width:560px; margin: 0 auto">Стоимость зависит от маршрута, типа транспорта и продолжительности. Никаких скрытых платежей — всё в договоре.</p>
		<div class="bt-hero__actions" style="justify-content:center; margin-top:24px">
			<a class="bt-btn bt-btn--primary bt-btn--lg" href="tel:+375296041234"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> +375 29 604-12-34</a>
			<a class="bt-btn bt-btn--ghost bt-btn--lg bt-js-open" data-form="callback">Заказать звонок</a>
		</div>
	</div>
</section>

<?php endwhile; get_footer();
