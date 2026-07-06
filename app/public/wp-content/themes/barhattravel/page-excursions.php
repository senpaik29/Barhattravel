<?php
/**
 * Template Name: Экскурсии
 */
get_header();
while ( have_posts() ) : the_post();
	bt_page_hero( [
		'title'    => '<em>Экскурсии</em> по Беларуси',
		'subtitle' => 'От ночного Полоцка до парк-музея «Сула», карьерных самосвалов БелАЗ и средневековых замков.',
		'crumbs'   => [ [ 'label' => 'Экскурсии' ] ],
	] );
?>

<section class="bt-section bt-worldmap" style="padding-top: clamp(20px, 4vw, 40px)">
	<div class="bt-container">
		<?php bt_render_category_block( 'excursions' ); ?>
	</div>
</section>

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
