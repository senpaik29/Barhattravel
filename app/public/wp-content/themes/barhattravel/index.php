<?php
get_header();
?>
<section class="bt-section">
	<div class="bt-container">
		<h1 class="bt-h1"><?php single_post_title(); ?></h1>
		<div class="bt-grid bt-grid--3">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article class="bt-card">
					<a class="bt-card__media" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'bt-tour-card' ); ?>
					</a>
					<div class="bt-card__body">
						<p class="bt-eyebrow"><?php echo esc_html( get_the_date() ); ?></p>
						<h3 class="bt-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
						<a class="bt-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Читать далее', 'barhattravel' ); ?> →</a>
					</div>
				</article>
			<?php endwhile; endif; ?>
		</div>
		<div class="bt-pagination"><?php the_posts_pagination(); ?></div>
	</div>
</section>
<?php get_footer();
