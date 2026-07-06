<?php
/**
 * Template Name: Школьные поездки
 */
get_header();
while ( have_posts() ) : the_post();
	bt_page_hero( [
		'title'    => '<em>Школьные</em> поездки',
		'subtitle' => 'Историко-патриотические программы и интерактивные музеи, страховка каждого ребёнка в стоимости.',
		'crumbs'   => [ [ 'label' => 'Школьные поездки' ] ],
	] );
?>

<section class="bt-section bt-worldmap" style="padding-top: clamp(20px, 4vw, 40px)">
	<div class="bt-container">
		<?php bt_render_category_block( 'school-tours' ); ?>
	</div>
</section>

<section class="bt-section bt-section--dark">
	<div class="bt-container bt-center">
		<p class="bt-eyebrow">Для класса или параллели</p>
		<h2 class="bt-h2">Подберём программу для вашей школы</h2>
		<div class="bt-hero__actions" style="justify-content:center;margin-top:24px">
			<a class="bt-btn bt-btn--primary bt-btn--lg bt-js-open" data-form="application" data-subject="Школьная поездка"><?php echo bt_icon( 'school', 'bt-icon bt-icon--sm' ); ?> Оставить заявку</a>
			<a class="bt-btn bt-btn--ghost bt-btn--lg" href="tel:+375296041234"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> +375 29 604-12-34</a>
		</div>
	</div>
</section>

<?php endwhile; get_footer();
