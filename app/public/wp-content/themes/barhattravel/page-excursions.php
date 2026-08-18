<?php
/**
 * Template Name: Экскурсии
 */
get_header();
$bt_tour_slug = get_query_var( 'bt_tour_slug' );

while ( have_posts() ) : the_post();

	if ( $bt_tour_slug ) {
		if ( ! bt_render_tour_page( 'excursions', $bt_tour_slug ) ) {
			status_header( 404 );
			bt_page_hero( [
				'title'    => 'Экскурсия не найдена',
				'subtitle' => 'Возможно, ссылка устарела. Вернитесь в каталог экскурсий.',
				'crumbs'   => [ [ 'label' => 'Экскурсии', 'url' => home_url( '/excursions/' ) ], [ 'label' => '404' ] ],
			] );
		}
	} else {
		bt_page_hero( [
			'title'    => '<em>Экскурсии</em> по Беларуси',
			'subtitle' => 'Очень хочется путешествовать, но у Вас всего 1 день? Не беда! Наш экскурсионный каталог приятно удивит даже самого взыскательного путешественника.',
			'crumbs'   => [ [ 'label' => 'Экскурсии' ] ],
		] );
		?>
		<section class="bt-section bt-worldmap" style="padding-top: clamp(20px, 4vw, 40px)">
			<div class="bt-container">
				<?php bt_render_category_block( 'excursions' ); ?>
			</div>
		</section>
		<?php
	}
?>

<section class="bt-section bt-section--dark">
	<div class="bt-container bt-center">
		<p class="bt-eyebrow">Подберём программу под вас</p>
		<h2 class="bt-h2">Закажите тематическую экскурсию</h2>
		<div class="bt-hero__actions" style="justify-content:center;margin-top:24px">
			<a class="bt-btn bt-btn--primary bt-btn--lg bt-js-open" data-form="application" data-subject="Экскурсия"><?php echo bt_icon( 'compass', 'bt-icon bt-icon--sm' ); ?> Оставить заявку</a>
			<a class="bt-btn bt-btn--ghost bt-btn--lg" href="tel:+375296041234"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> +375 29 604-12-34</a>
		</div>
	</div>
</section>

<?php endwhile; get_footer();
