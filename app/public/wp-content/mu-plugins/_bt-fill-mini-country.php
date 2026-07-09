<?php
/**
 * Plugin Name: _bt Fill Mini Country
 * Description: Одноразовый сидер — наполняет тур «Парк «Страна мини»» реальным содержимым (программа, включено, даты). Отрабатывает 1 раз, ставит option-флаг. УДАЛИТЬ ФАЙЛ ПОСЛЕ ДЕПЛОЯ.
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', function () {
	if ( get_option( '_bt_seed_mini_country_done' ) ) {
		return;
	}

	$posts = get_posts( [
		'post_type'      => 'bt_tour',
		'title'          => 'Парк «Страна мини»',
		'posts_per_page' => 1,
		'post_status'    => 'any',
	] );

	if ( ! $posts ) {
		return;
	}

	$id = $posts[0]->ID;

	$content = 'Однодневная экскурсия для школьников в парк-музей «Страна мини» под Минском — уникальную коллекцию макетов главных архитектурных памятников Беларуси в масштабе 1:25. За одну прогулку дети увидят Мирский и Несвижский замки, Софийский собор, Каменецкую вежу, Брестскую крепость и другие знаковые объекты страны.';

	$program = [
		[
			'title' => 'Знакомство с Беларусью в макетах',
			'body'  => '07:30 — сбор группы. Отъезд из Полоцка/Новополоцка.' . "\n"
				. '11:00 — прибытие в парк «Страна мини» (Уручье, Минск).' . "\n"
				. '11:15 — экскурсия по территории парка: макеты Мирского и Несвижского замков, Каменецкой вежи, Софийского собора, Брестской крепости, Дворца Румянцевых-Паскевичей и других памятников архитектуры Беларуси.' . "\n"
				. '13:00 — интерактив: викторина о белорусском наследии, фото на память у макетов.' . "\n"
				. '14:00 — обед в кафе рядом с парком.' . "\n"
				. '15:00 — отправление домой.' . "\n"
				. '18:30 — прибытие в Полоцк.',
		],
	];

	$includes = "Транспортное обслуживание комфортабельным автобусом\nЭкскурсионное обслуживание\nВходной билет в парк\nОбед\nСтраховка каждого ребёнка\nСопровождение группы";
	$excludes = "Сувениры\nДополнительные аттракционы и активности\nЛичные расходы";

	wp_update_post( [
		'ID'           => $id,
		'post_content' => $content,
		'post_name'    => 'park-strana-mini',
	] );

	update_post_meta( $id, '_bt_subtitle', 'Беларусь в макетах 1:25' );
	update_post_meta( $id, '_bt_region', 'Уручье, Минск' );
	update_post_meta( $id, '_bt_duration', '1 день' );
	update_post_meta( $id, '_bt_price', '55' );
	update_post_meta( $id, '_bt_dates', "25.09.2026\n09.10.2026\n23.10.2026" );
	update_post_meta( $id, '_bt_program', wp_slash( wp_json_encode( $program, JSON_UNESCAPED_UNICODE ) ) );
	update_post_meta( $id, '_bt_includes', $includes );
	update_post_meta( $id, '_bt_excludes', $excludes );
	update_post_meta( $id, '_bt_hero_image', 'dest-mini-country.jpg' );

	update_option( '_bt_seed_mini_country_done', 1 );
} );
