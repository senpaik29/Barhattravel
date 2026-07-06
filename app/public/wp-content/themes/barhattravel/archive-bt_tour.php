<?php
get_header();
?>
<section class="bt-section bt-section--page">
	<div class="bt-container">
		<p class="bt-eyebrow">Каталог</p>
		<h1 class="bt-h1">
			<?php
			if ( is_tax( 'tour_category' ) || is_tax( 'tour_destination' ) ) {
				single_term_title();
			} else {
				echo 'Все туры';
			}
			?>
		</h1>

		<div class="bt-tabs bt-mt-3" style="margin-bottom:24px">
			<a class="bt-tab <?php echo is_post_type_archive( 'bt_tour' ) ? 'is-active' : ''; ?>" href="<?php echo esc_url( get_post_type_archive_link( 'bt_tour' ) ); ?>">Все</a>
			<?php
			$terms = get_terms( [ 'taxonomy' => 'tour_category', 'hide_empty' => false ] );
			foreach ( $terms as $t ) {
				$active = is_tax( 'tour_category', $t->slug ) ? 'is-active' : '';
				echo '<a class="bt-tab ' . $active . '" href="' . esc_url( get_term_link( $t ) ) . '">' . esc_html( $t->name ) . '</a>';
			}
			?>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="bt-grid bt-grid--3">
				<?php $i = 0; while ( have_posts() ) { the_post(); ( new BT_Core() )->render_tour_card( get_post(), $i++ ); } ?>
			</div>
			<div class="bt-pagination"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<p>В этой категории пока нет туров. Позвоните нам — подберём индивидуальный маршрут.</p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer();
