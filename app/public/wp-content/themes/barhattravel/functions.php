<?php
/**
 * BarhatTravel theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BT_THEME_VERSION', '1.0.0' );
define( 'BT_THEME_DIR', get_template_directory() );
define( 'BT_THEME_URI', get_template_directory_uri() );

require_once BT_THEME_DIR . '/inc/setup.php';
require_once BT_THEME_DIR . '/inc/enqueue.php';
require_once BT_THEME_DIR . '/inc/nav-walker.php';
require_once BT_THEME_DIR . '/inc/helpers.php';
require_once BT_THEME_DIR . '/inc/widgets.php';
