<?php get_header(); ?>
<section class="bt-section bt-section--page bt-center">
	<div class="bt-container">
		<p class="bt-eyebrow">404</p>
		<h1 class="bt-h1"><?php esc_html_e( 'Страница уехала в путешествие', 'barhattravel' ); ?></h1>
		<p><?php esc_html_e( 'Вернитесь на главную или посмотрите наши туры.', 'barhattravel' ); ?></p>
		<p>
			<a class="bt-btn bt-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'На главную', 'barhattravel' ); ?></a>
			<a class="bt-btn bt-btn--ghost" href="<?php echo esc_url( get_post_type_archive_link( 'bt_tour' ) ); ?>"><?php esc_html_e( 'Каталог туров', 'barhattravel' ); ?></a>
		</p>
	</div>
</section>
<?php get_footer(); ?>
