<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'widgets_init', function () {
	register_sidebar( [
		'name'          => __( 'Подвал', 'barhattravel' ),
		'id'            => 'footer-1',
		'before_widget' => '<div class="bt-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="bt-widget__title">',
		'after_title'   => '</h4>',
	] );
} );
