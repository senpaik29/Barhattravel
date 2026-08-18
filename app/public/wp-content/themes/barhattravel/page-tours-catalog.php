<?php
/**
 * Template Name: Автобусные туры
 */
get_header();
$bt_tour_slug = get_query_var( 'bt_tour_slug' );

while ( have_posts() ) : the_post();

	if ( $bt_tour_slug ) {
		// Отдельная страница конкретного тура: /tours-catalog/{slug}/
		if ( ! bt_render_tour_page( 'tours-catalog', $bt_tour_slug ) ) {
			status_header( 404 );
			bt_page_hero( [
				'title'    => 'Тур не найден',
				'subtitle' => 'Возможно, ссылка устарела. Вернитесь в каталог маршрутов.',
				'crumbs'   => [ [ 'label' => 'Автобусные и ж/д туры', 'url' => home_url( '/tours-catalog/' ) ], [ 'label' => '404' ] ],
			] );
		}
	} else {
		// Основной каталог
		bt_page_hero( [
			'title'    => 'Автобусные и ж/д <em>туры</em> по Беларуси',
			'subtitle' => 'Устали от ежедневной суеты? Хотите получить массу новых впечатлений и зарядиться энергией для новых свершений? Тогда пакуем чемоданы и отправляемся в тур по Беларуси!',
			'crumbs'   => [ [ 'label' => 'Автобусные и ж/д туры' ] ],
		] );
		?>
		<section class="bt-section bt-worldmap" style="padding-top: clamp(20px, 4vw, 40px)">
			<div class="bt-container">
				<?php bt_render_category_block( 'tours-catalog' ); ?>
			</div>
		</section>
		<?php
	}
?>

<section class="bt-section bt-section--dark">
	<div class="bt-container bt-center">
		<p class="bt-eyebrow">Не нашли свой маршрут?</p>
		<h2 class="bt-h2">Соберём индивидуальный тур под вас</h2>
		<div class="bt-hero__actions" style="justify-content:center;margin-top:24px">
			<a class="bt-btn bt-btn--primary bt-btn--lg bt-js-open" data-form="application"><?php echo bt_icon( 'bus', 'bt-icon bt-icon--sm' ); ?> Оставить заявку</a>
			<a class="bt-btn bt-btn--ghost bt-btn--lg" href="tel:+375296041234"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> +375 29 604-12-34</a>
		</div>
	</div>
</section>

<?php endwhile; get_footer();
