<?php
/**
 * Template Name: Отзывы
 */
get_header();
while ( have_posts() ) : the_post();
	bt_page_hero( [
		'eyebrow'  => 'Отзывы',
		'title'    => 'Наши <em>счастливые</em> и благодарные туристы',
		'subtitle' => 'Мы работаем для вас, и ваши отзывы очень важны для нас, чтобы мы становились ещё лучше день за днём.',
		'crumbs'   => [ [ 'label' => 'Отзывы' ] ],
	] );
?>

<section class="bt-section bt-worldmap">
	<div class="bt-container">
		<?php echo do_shortcode( '[bt_reviews limit="30"]' ); ?>
	</div>
</section>

<section class="bt-section bt-section--soft">
	<div class="bt-container bt-narrow">
		<div class="bt-section__head" style="margin-bottom:24px">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Расскажите о вашей поездке</p>
				<h2 class="bt-h2">Оставить отзыв</h2>
				<p>После проверки модератором отзыв появится на сайте.</p>
			</div>
		</div>
		<div style="background:#fff; padding:28px; border-radius:var(--bt-radius); border:1px solid var(--bt-line); box-shadow:var(--bt-shadow)">
			<?php echo do_shortcode( '[bt_review_form]' ); ?>
		</div>
	</div>
</section>

<?php endwhile; get_footer();
