<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fallback menu shown until user assigns one in Appearance → Menus.
 * Uses real page URLs so each item opens a standalone page.
 */
function bt_primary_menu_fallback() {
	$items = [
		[ 'url' => home_url( '/' ),                'label' => 'Главная' ],
		[ 'url' => home_url( '/about/' ),          'label' => 'О нас' ],
		[ 'url' => home_url( '/advantages/' ),     'label' => 'Преимущества' ],
		[ 'url' => home_url( '/tours-catalog/' ),  'label' => 'Автобусные туры по Беларуси' ],
		[ 'url' => home_url( '/excursions/' ),     'label' => 'Экскурсии' ],
		[ 'url' => home_url( '/abroad/' ),         'label' => 'Туры в РФ и зарубежье' ],
		[ 'url' => home_url( '/beach/' ),          'label' => 'Пляжный отдых' ],
		[ 'url' => home_url( '/school-tours/' ),   'label' => 'Школьные поездки' ],
		[ 'url' => home_url( '/rental/' ),         'label' => 'Аренда транспорта' ],
		[ 'url' => home_url( '/news/' ),           'label' => 'Новости' ],
	];

	$current = trailingslashit( home_url( $_SERVER['REQUEST_URI'] ?? '/' ) );

	echo '<ul class="bt-menu">';
	foreach ( $items as $item ) {
		$is_current = trailingslashit( $item['url'] ) === $current ? ' class="current-menu-item"' : '';
		printf( '<li%s><a href="%s">%s</a></li>',
			$is_current,
			esc_url( $item['url'] ),
			esc_html( $item['label'] )
		);
	}
	echo '</ul>';
}
