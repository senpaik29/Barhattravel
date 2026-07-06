<?php
/**
 * Template Name: Пляжный отдых
 */
get_header();
while ( have_posts() ) : the_post();
	bt_page_hero( [
		'title'    => 'Тёплое <em>море</em> круглый год',
		'subtitle' => 'Чартеры и регулярные рейсы. Подбираем туры на любой бюджет — от египетских отелей all-inclusive до белоснежных пляжей Шри-Ланки и Мальдив.',
		'crumbs'   => [ [ 'label' => 'Пляжный отдых' ] ],
	] );
?>

<section class="bt-section bt-worldmap" style="padding-top: clamp(20px, 4vw, 40px)">
	<div class="bt-container">
		<?php bt_render_category_block( 'beach' ); ?>
	</div>
</section>

<section class="bt-section bt-section--dark">
	<div class="bt-container bt-center">
		<p class="bt-eyebrow">Нужна помощь с выбором?</p>
		<h2 class="bt-h2">Подберём пляжный тур под ваш бюджет</h2>
		<p style="opacity:.9;max-width:560px;margin:0 auto">Расскажите о пожеланиях — менеджер пришлёт 3-5 вариантов отелей с ценами и подробной программой.</p>
		<div class="bt-hero__actions" style="justify-content:center;margin-top:24px">
			<a class="bt-btn bt-btn--primary bt-btn--lg bt-js-open" data-form="application" data-subject="Пляжный отдых"><?php echo bt_icon( 'beach', 'bt-icon bt-icon--sm' ); ?> Оставить заявку</a>
			<a class="bt-btn bt-btn--ghost bt-btn--lg" href="tel:+375296041234"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> +375 29 604-12-34</a>
		</div>
	</div>
</section>

<?php endwhile; get_footer();
