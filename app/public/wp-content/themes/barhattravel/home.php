<?php
/**
 * Posts listing (Новости).
 * Used when a page is assigned as «Страница записей» in Settings → Reading.
 */
get_header();

$page_for_posts = (int) get_option( 'page_for_posts' );
$title    = $page_for_posts ? get_the_title( $page_for_posts ) : 'Новости';
$subtitle = $page_for_posts ? get_post_field( 'post_excerpt', $page_for_posts ) : '';

bt_page_hero( [
	'title'    => $title,
	'subtitle' => $subtitle ?: 'Актуальное расписание поездок, статьи о путешествиях и туризме',
	'crumbs'   => [ [ 'label' => 'Новости' ] ],
] );
?>

<section class="bt-section bt-worldmap" style="padding-top: clamp(20px, 4vw, 40px)">
	<div class="bt-container">
		<?php if ( have_posts() ) : ?>
			<?php
			global $wp_query;
			$paged = max( 1, get_query_var( 'paged' ) ?: get_query_var( 'page' ) );
			$total = (int) $wp_query->found_posts;
			$per   = (int) $wp_query->get( 'posts_per_page' );
			$from  = ( $paged - 1 ) * $per + 1;
			$to    = min( $paged * $per, $total );
			?>
			<p class="bt-eyebrow" style="margin-bottom:18px">Показано <?php echo (int) $from; ?>–<?php echo (int) $to; ?> из <?php echo (int) $total; ?> публикаций</p>

			<div class="bt-news-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="bt-news-card">
						<a class="bt-news-card__media" href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'bt-tour-card', [ 'loading' => 'lazy' ] );
							} else {
								echo bt_icon( 'calendar' );
							} ?>
							<span class="bt-news-card__date"><?php echo bt_icon( 'calendar', 'bt-icon bt-icon--xs' ); ?> <?php echo esc_html( get_the_date( 'j M Y' ) ); ?></span>
						</a>
						<div class="bt-news-card__body">
							<?php
							$cats = get_the_category();
							if ( $cats ) {
								echo '<p class="bt-news-card__cat">' . esc_html( $cats[0]->name ) . '</p>';
							}
							?>
							<h3 class="bt-news-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p class="bt-news-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
							<a class="bt-news-card__more" href="<?php the_permalink(); ?>">Читать дальше <?php echo bt_icon( 'arrow', 'bt-icon bt-icon--xs' ); ?></a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="bt-pagination">
				<?php
				the_posts_pagination( [
					'mid_size'  => 1,
					'end_size'  => 1,
					'prev_text' => '← Назад',
					'next_text' => 'Вперёд →',
				] );
				?>
			</div>
		<?php else : ?>
			<div class="bt-center" style="padding:40px 0">
				<?php echo bt_icon( 'calendar', 'bt-icon bt-icon--lg' ); ?>
				<h2 class="bt-h2 bt-mt-2">Скоро здесь появятся новости</h2>
				<p>Мы готовим первые публикации. Подпишитесь на рассылку, чтобы не пропустить выезды и акции.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
