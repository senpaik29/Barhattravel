<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', function () {
	$ver = filemtime( BT_THEME_DIR . '/assets/css/main.css' ) ?: BT_THEME_VERSION;

	// Google fonts — Caveat only (Times New Roman is a system font, no loading needed).
	wp_enqueue_style(
		'bt-fonts',
		'https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&display=swap',
		[],
		null
	);

	wp_enqueue_style( 'bt-style', get_stylesheet_uri(), [], BT_THEME_VERSION );
	wp_enqueue_style( 'bt-main', BT_THEME_URI . '/assets/css/main.css', [ 'bt-style' ], $ver );

	$jsver = filemtime( BT_THEME_DIR . '/assets/js/main.js' ) ?: BT_THEME_VERSION;
	wp_enqueue_script( 'bt-main', BT_THEME_URI . '/assets/js/main.js', [], $jsver, true );

	wp_localize_script( 'bt-main', 'BT', [
		'ajaxUrl' => admin_url( 'admin-post.php' ),
		'nonce'   => wp_create_nonce( 'bt_form' ),
		'i18n'    => [
			'sending'     => __( 'Отправка...', 'barhattravel' ),
			'sentOk'      => __( 'Спасибо! Мы свяжемся с вами в ближайшее время.', 'barhattravel' ),
			'sentReview'  => __( 'Спасибо! Ваш отзыв отправлен на модерацию.', 'barhattravel' ),
			'errGeneric'  => __( 'Не удалось отправить. Попробуйте ещё раз или позвоните нам.', 'barhattravel' ),
			'errRequired' => __( 'Заполните обязательные поля.', 'barhattravel' ),
		],
	] );
} );
