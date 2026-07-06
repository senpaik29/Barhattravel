<?php
get_header();
while ( have_posts() ) : the_post();
	$cats = get_the_category();
	$cat_name = $cats ? $cats[0]->name : 'Новость';
	bt_page_hero( [
		'eyebrow' => $cat_name . ' · ' . get_the_date( 'j F Y' ),
		'title'   => get_the_title(),
		'crumbs'  => [
			[ 'url' => home_url( '/news/' ), 'label' => 'Новости' ],
			[ 'label' => get_the_title() ],
		],
	] );
	?>
	<section class="bt-section bt-worldmap" style="padding-top: clamp(20px, 4vw, 40px)">
		<div class="bt-container bt-narrow">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="bt-article__cover" style="margin-bottom:24px;border-radius:var(--bt-radius);overflow:hidden;box-shadow:var(--bt-shadow)">
					<?php the_post_thumbnail( 'bt-tour-hero' ); ?>
				</div>
			<?php endif; ?>
			<article class="bt-article bt-prose">
				<?php the_content(); ?>
			</article>

			<div class="bt-mt-4" style="padding-top:24px;border-top:1px solid var(--bt-line); display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap">
				<a class="bt-link" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">← Ко всем новостям</a>
				<a class="bt-btn bt-btn--primary bt-js-open" data-form="application">Оставить заявку</a>
			</div>
		</div>
	</section>
<?php endwhile;
get_footer();
