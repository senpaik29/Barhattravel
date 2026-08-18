<?php
/**
 * Template Name: Автобусные туры
 */
get_header();
while ( have_posts() ) : the_post();
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

<section class="bt-section" style="padding-top: clamp(20px, 4vw, 40px)">
	<div class="bt-container">
		<div class="bt-center" style="margin-bottom: clamp(24px, 4vw, 40px)">
			<p class="bt-eyebrow">Что вас ждёт</p>
			<h2 class="bt-h2">Программы туров</h2>
		</div>
		<?php bt_render_tour_programs( 'tours-catalog' ); ?>
	</div>
</section>

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
