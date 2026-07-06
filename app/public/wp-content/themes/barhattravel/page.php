<?php
get_header();
while ( have_posts() ) : the_post();
	bt_page_hero( [
		'title'   => get_the_title(),
		'eyebrow' => 'БархатТрэвел',
	] );
	?>
	<section class="bt-section bt-worldmap" style="padding-top: clamp(20px, 4vw, 40px)">
		<div class="bt-container bt-narrow">
			<article class="bt-article bt-prose">
				<?php the_content(); ?>
			</article>
		</div>
	</section>
<?php endwhile;
get_footer();
