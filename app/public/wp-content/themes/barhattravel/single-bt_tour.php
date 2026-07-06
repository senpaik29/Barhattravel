<?php
get_header();
while ( have_posts() ) : the_post();
	$id        = get_the_ID();
	$subtitle  = get_post_meta( $id, '_bt_subtitle', true );
	$region    = get_post_meta( $id, '_bt_region', true );
	$duration  = get_post_meta( $id, '_bt_duration', true );
	$price     = (float) get_post_meta( $id, '_bt_price', true );
	$dates_raw = get_post_meta( $id, '_bt_dates', true );
	$program   = json_decode( get_post_meta( $id, '_bt_program', true ) ?: '[]', true );
	if ( ! is_array( $program ) ) $program = [];
	$inc = array_filter( array_map( 'trim', explode( "\n", get_post_meta( $id, '_bt_includes', true ) ) ) );
	$exc = array_filter( array_map( 'trim', explode( "\n", get_post_meta( $id, '_bt_excludes', true ) ) ) );
	$dates = array_filter( array_map( 'trim', explode( "\n", $dates_raw ) ) );
	$gallery = array_filter( array_map( 'intval', array_map( 'trim', explode( ',', get_post_meta( $id, '_bt_gallery', true ) ) ) ) );
	$map = get_post_meta( $id, '_bt_map', true );
	$cats = get_the_terms( $id, 'tour_category' );
?>

<section class="bt-tour-hero">
	<div class="bt-tour-hero__bg">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'bt-tour-hero' );
		} else {
			$hero_img = get_post_meta( $id, '_bt_hero_image', true );
			if ( $hero_img ) {
				printf(
					'<img src="%s" alt="%s" style="width:100%%;height:100%%;object-fit:cover;">',
					esc_url( BT_THEME_URI . '/assets/img/' . $hero_img ),
					esc_attr( get_the_title() )
				);
			}
		}
		?>
	</div>
	<div class="bt-container">
		<?php if ( $cats && ! is_wp_error( $cats ) ) : ?><span class="bt-card__tag" style="position:static;display:inline-block;margin-bottom:10px"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
		<h1><?php the_title(); ?></h1>
		<?php if ( $subtitle ) : ?><p><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
		<div class="bt-tour-hero__meta">
			<?php if ( $region ) : ?><span><?php echo bt_icon( 'map', 'bt-icon bt-icon--sm' ); ?> <?php echo esc_html( $region ); ?></span><?php endif; ?>
			<?php if ( $duration ) : ?><span><?php echo bt_icon( 'clock', 'bt-icon bt-icon--sm' ); ?> <?php echo esc_html( $duration ); ?></span><?php endif; ?>
		</div>
	</div>
</section>

<section class="bt-section bt-section--page">
	<div class="bt-container">
		<div class="bt-tour-layout">
			<article class="bt-tour-content">
				<?php if ( $program ) : ?>
					<h2 class="bt-h2">Программа по дням</h2>
					<div class="bt-accordion">
						<?php foreach ( $program as $i => $row ) : ?>
							<div class="bt-accordion__item">
								<button type="button" class="bt-accordion__head">
									<span><strong>День <?php echo (int) ( $i + 1 ); ?>.</strong> <?php echo esc_html( $row['title'] ?? '' ); ?></span>
									<?php echo bt_icon( 'arrow', 'bt-icon chev' ); ?>
								</button>
								<div class="bt-accordion__body"><?php echo wp_kses_post( wpautop( $row['body'] ?? '' ) ); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="bt-prose bt-mt-4"><?php the_content(); ?></div>

				<?php if ( $inc || $exc ) : ?>
					<div class="bt-includes">
						<?php if ( $inc ) : ?>
							<div class="bt-includes__col is-in">
								<h3>В стоимость включено</h3>
								<ul><?php foreach ( $inc as $row ) echo '<li>' . esc_html( $row ) . '</li>'; ?></ul>
							</div>
						<?php endif; ?>
						<?php if ( $exc ) : ?>
							<div class="bt-includes__col is-out">
								<h3>Не включено</h3>
								<ul><?php foreach ( $exc as $row ) echo '<li>' . esc_html( $row ) . '</li>'; ?></ul>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( $gallery ) : ?>
					<h2 class="bt-h2 bt-mt-4">Фотогалерея</h2>
					<div class="bt-gallery">
						<?php foreach ( $gallery as $att_id ) {
							$src = wp_get_attachment_image_src( $att_id, 'bt-thumb' );
							if ( $src ) echo '<a href="' . esc_url( wp_get_attachment_url( $att_id ) ) . '"><img src="' . esc_url( $src[0] ) . '" alt="" loading="lazy"></a>';
						} ?>
					</div>
				<?php endif; ?>

				<?php if ( $map ) : ?>
					<h2 class="bt-h2 bt-mt-4">Маршрут на карте</h2>
					<div class="bt-map" style="border-radius:14px;overflow:hidden;border:1px solid var(--bt-line)">
						<?php echo wp_kses( $map, [ 'iframe' => [ 'src' => [], 'width' => [], 'height' => [], 'frameborder' => [], 'allow' => [], 'allowfullscreen' => [], 'loading' => [], 'style' => [] ] ] ); ?>
					</div>
				<?php endif; ?>
			</article>

			<aside class="bt-tour-aside">
				<h3>Забронировать</h3>
				<p style="color:var(--bt-on-surface-variant);font-size:14px;margin:0 0 14px">Стоимость и даты ближайших выездов уточняйте у менеджера — расскажем по телефону или в мессенджере.</p>
				<p style="display:flex;flex-direction:column;gap:8px;margin:0">
					<button class="bt-btn bt-btn--primary bt-js-open" data-form="application" data-tour="<?php echo esc_attr( get_the_title() ); ?>">Оставить заявку</button>
					<a class="bt-btn bt-btn--dark" href="tel:+375296041234"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> Позвонить</a>
					<a class="bt-btn bt-btn--ghost" style="color:var(--bt-navy);border-color:var(--bt-navy)" href="<?php echo esc_url( bt_social()['telegram'] ); ?>" target="_blank" rel="noopener"><?php echo bt_icon( 'tg', 'bt-icon bt-icon--sm' ); ?> Telegram</a>
				</p>
			</aside>
		</div>
	</div>
</section>

<?php endwhile; get_footer();
