<?php
get_header();
while ( have_posts() ) : the_post();
	$id    = get_the_ID();
	$d     = get_post_meta( $id, '_bt_t_date', true );
	$t     = get_post_meta( $id, '_bt_t_time', true );
	$from  = get_post_meta( $id, '_bt_t_from', true );
	$to    = get_post_meta( $id, '_bt_t_to', true );
	$bus   = get_post_meta( $id, '_bt_t_bus', true );
	$price = (float) get_post_meta( $id, '_bt_t_price', true );
	$seats = (int) get_post_meta( $id, '_bt_t_seats', true );
?>
<section class="bt-section bt-section--page">
	<div class="bt-container bt-narrow">
		<p class="bt-eyebrow">Перевозка</p>
		<h1 class="bt-h1"><?php the_title(); ?></h1>
		<ul class="bt-services bt-mt-3">
			<?php if ( $d ) : ?><li><strong>Дата выезда:</strong> <?php echo esc_html( $d ); ?> <?php echo esc_html( $t ); ?></li><?php endif; ?>
			<?php if ( $from || $to ) : ?><li><strong>Маршрут:</strong> <?php echo esc_html( $from ); ?> → <?php echo esc_html( $to ); ?></li><?php endif; ?>
			<?php if ( $bus ) : ?><li><strong>Транспорт:</strong> <?php echo esc_html( $bus ); ?></li><?php endif; ?>
			<?php if ( $price > 0 ) : ?><li><strong>Цена:</strong> <?php echo esc_html( bt_price( $price ) ); ?></li><?php endif; ?>
			<?php if ( $seats > 0 ) : ?><li><strong>Свободных мест:</strong> <?php echo (int) $seats; ?></li><?php endif; ?>
		</ul>
		<div class="bt-prose bt-mt-3"><?php the_content(); ?></div>
		<p class="bt-mt-3">
			<button class="bt-btn bt-btn--primary bt-js-open" data-form="application" data-tour="<?php echo esc_attr( get_the_title() . ' (' . $d . ')' ); ?>"><?php echo bt_icon( 'bus', 'bt-icon bt-icon--sm' ); ?> Забронировать место</button>
			<a class="bt-btn bt-btn--ghost" style="color:var(--bt-navy);border-color:var(--bt-navy)" href="<?php echo esc_url( get_post_type_archive_link( 'bt_transport' ) ); ?>">← Все рейсы</a>
		</p>
	</div>
</section>
<?php endwhile; get_footer();
