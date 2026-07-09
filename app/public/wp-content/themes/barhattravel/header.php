<?php
/**
 * Header.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="theme-color" content="#0E2A5E">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="bt-skip" href="#main"><?php esc_html_e( 'Перейти к содержимому', 'barhattravel' ); ?></a>

<div class="bt-topbar">
	<div class="bt-container bt-topbar__inner">
		<div class="bt-topbar__offices">
			<?php foreach ( bt_offices() as $i => $o ) : ?>
				<span class="bt-topbar__office">
					<a class="bt-topbar__addr" href="<?php echo esc_url( bt_office_map_url( $o ) ); ?>" target="_blank" rel="noopener" title="Открыть в Google Maps">
						<?php echo bt_icon( 'map', 'bt-icon bt-icon--xs' ); ?>
						<strong><?php echo esc_html( $o['city'] ); ?>:</strong>
						<?php echo esc_html( $o['address'] ); ?>
					</a>
					<a class="bt-topbar__phone" href="tel:<?php echo esc_attr( $o['tel'] ); ?>"><?php echo esc_html( $o['phone'] ); ?></a>
				</span>
			<?php endforeach; ?>
		</div>
		<div class="bt-topbar__social">
			<a href="<?php echo esc_url( bt_social()['telegram'] ); ?>" aria-label="Telegram" target="_blank" rel="noopener"><?php echo bt_icon( 'tg' ); ?></a>
			<a href="<?php echo esc_url( bt_social()['whatsapp'] ); ?>" aria-label="WhatsApp" target="_blank" rel="noopener"><?php echo bt_icon( 'wa' ); ?></a>
			<a href="<?php echo esc_url( bt_social()['instagram'] ); ?>" aria-label="Instagram" target="_blank" rel="noopener"><?php echo bt_icon( 'ig' ); ?></a>
			<a href="<?php echo esc_url( bt_social()['facebook'] ); ?>" aria-label="Facebook" target="_blank" rel="noopener"><?php echo bt_icon( 'fb' ); ?></a>
			<a href="<?php echo esc_url( bt_social()['tiktok'] ); ?>" aria-label="TikTok" target="_blank" rel="noopener"><?php echo bt_icon( 'tt' ); ?></a>
			<a href="mailto:<?php echo esc_attr( bt_email() ); ?>" aria-label="<?php esc_attr_e( 'Email', 'barhattravel' ); ?>"><?php echo bt_icon( 'mail' ); ?></a>
		</div>
	</div>
</div>

<header class="bt-header">
	<div class="bt-container bt-header__inner">
		<a class="bt-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?>">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				$logo = BT_THEME_URI . '/assets/img/logo.png';
				printf( '<img src="%s" alt="%s" width="220" height="93" loading="eager">', esc_url( $logo ), esc_attr( get_bloginfo( 'name' ) ) );
			}
			?>
		</a>

		<button class="bt-burger" aria-label="<?php esc_attr_e( 'Меню', 'barhattravel' ); ?>" aria-expanded="false" aria-controls="bt-nav">
			<?php echo bt_icon( 'menu',  'bt-icon bt-burger__open' ); ?>
			<?php echo bt_icon( 'close', 'bt-icon bt-burger__close' ); ?>
		</button>

		<nav id="bt-nav" class="bt-nav" aria-label="<?php esc_attr_e( 'Основное меню', 'barhattravel' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( [
					'theme_location' => 'primary',
					'menu_class'     => 'bt-menu',
					'container'      => false,
					'depth'          => 2,
				] );
			} else {
				bt_primary_menu_fallback();
			}
			?>
		</nav>

		<div class="bt-header__cta">
			<a class="bt-btn bt-btn--ghost bt-js-open" data-form="callback" href="#callback">
				<?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?>
				<span><?php esc_html_e( 'Заказать звонок', 'barhattravel' ); ?></span>
			</a>
			<a class="bt-btn bt-btn--primary bt-js-open" data-form="application" href="#application">
				<?php esc_html_e( 'Оставить заявку', 'barhattravel' ); ?>
			</a>
		</div>
	</div>
</header>

<main id="main" class="bt-main">
