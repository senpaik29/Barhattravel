<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'barhattravel', BT_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'custom-logo', [
		'height'      => 120,
		'width'       => 320,
		'flex-height' => true,
		'flex-width'  => true,
	] );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_image_size( 'bt-tour-card', 720, 480, true );
	add_image_size( 'bt-tour-hero', 1600, 720, true );
	add_image_size( 'bt-thumb', 480, 320, true );

	register_nav_menus( [
		'primary' => __( 'Основное меню', 'barhattravel' ),
		'footer'  => __( 'Меню в подвале', 'barhattravel' ),
		'legal'   => __( 'Юридическое меню', 'barhattravel' ),
	] );
} );

/**
 * Body classes used by CSS.
 */
add_filter( 'body_class', function ( $classes ) {
	$classes[] = 'bt-body';
	if ( is_front_page() ) {
		$classes[] = 'bt-front';
	}
	return $classes;
} );
