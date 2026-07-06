<?php get_header(); ?>
<section class="bt-section">
	<div class="bt-container">
		<h1 class="bt-h1"><?php printf( esc_html__( 'Поиск: %s', 'barhattravel' ), '<em>' . esc_html( get_search_query() ) . '</em>' ); ?></h1>
		<?php if ( have_posts() ) : ?>
			<ul class="bt-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
		<?php else : ?>
			<p><?php esc_html_e( 'Ничего не найдено.', 'barhattravel' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
