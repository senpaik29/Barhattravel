</main>

<footer class="bt-footer" id="contacts">
	<div class="bt-container bt-footer__grid">
		<div class="bt-footer__brand">
			<a class="bt-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					$logo = BT_THEME_URI . '/assets/img/logo.png';
					printf( '<img src="%s" alt="%s" width="200" height="85">', esc_url( $logo ), esc_attr( get_bloginfo( 'name' ) ) );
				}
				?>
			</a>
			<p class="bt-footer__tagline"><?php esc_html_e( 'Ваше лучшее путешествие начинается здесь', 'barhattravel' ); ?></p>
			<div class="bt-footer__social">
				<a href="<?php echo esc_url( bt_social()['telegram'] ); ?>" aria-label="Telegram" target="_blank" rel="noopener"><?php echo bt_icon( 'tg' ); ?></a>
				<a href="<?php echo esc_url( bt_social()['whatsapp'] ); ?>" aria-label="WhatsApp" target="_blank" rel="noopener"><?php echo bt_icon( 'wa' ); ?></a>
				<a href="<?php echo esc_url( bt_social()['instagram'] ); ?>" aria-label="Instagram" target="_blank" rel="noopener"><?php echo bt_icon( 'ig' ); ?></a>
				<a href="<?php echo esc_url( bt_social()['facebook'] ); ?>" aria-label="Facebook" target="_blank" rel="noopener"><?php echo bt_icon( 'fb' ); ?></a>
				<a href="<?php echo esc_url( bt_social()['tiktok'] ); ?>" aria-label="TikTok" target="_blank" rel="noopener"><?php echo bt_icon( 'tt' ); ?></a>
			</div>
		</div>

		<div class="bt-footer__col">
			<h4><?php esc_html_e( 'Офисы', 'barhattravel' ); ?></h4>
			<?php foreach ( bt_offices() as $o ) : ?>
				<p>
					<strong><?php echo esc_html( $o['city'] ); ?></strong><br>
					<a class="bt-footer__addr" href="<?php echo esc_url( bt_office_map_url( $o ) ); ?>" target="_blank" rel="noopener" title="Открыть в Google Maps">
						<?php echo bt_icon( 'map', 'bt-icon bt-icon--xs' ); ?>
						<span><?php echo esc_html( $o['address'] ); ?></span>
					</a><br>
					<a href="tel:<?php echo esc_attr( $o['tel'] ); ?>"><?php echo esc_html( $o['phone'] ); ?></a>
				</p>
			<?php endforeach; ?>
		</div>

		<div class="bt-footer__col">
			<h4><?php esc_html_e( 'Меню', 'barhattravel' ); ?></h4>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu( [
					'theme_location' => 'footer',
					'menu_class'     => 'bt-footer__menu',
					'container'      => false,
					'depth'          => 1,
				] );
			} else {
				bt_primary_menu_fallback();
			}
			?>
		</div>

		<div class="bt-footer__col">
			<h4><?php esc_html_e( 'Подписка на рассылку', 'barhattravel' ); ?></h4>
			<p class="bt-footer__muted"><?php esc_html_e( 'Получайте акции и расписание выездов раз в неделю.', 'barhattravel' ); ?></p>
			<form class="bt-form bt-form--inline bt-js-form" data-form="subscribe" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="bt_subscribe">
				<?php wp_nonce_field( 'bt_form', 'bt_nonce' ); ?>
				<input type="text" name="bt_hp" tabindex="-1" autocomplete="off" class="bt-hp" aria-hidden="true">
				<label class="bt-sr"><?php esc_html_e( 'E-mail', 'barhattravel' ); ?>
					<input type="email" name="email" required placeholder="<?php esc_attr_e( 'Ваш e-mail', 'barhattravel' ); ?>">
				</label>
				<button type="submit" class="bt-btn bt-btn--primary"><?php esc_html_e( 'Подписаться', 'barhattravel' ); ?></button>
				<label class="bt-consent">
					<input type="checkbox" name="consent" required>
					<span><?php printf( esc_html__( 'Согласен на %sобработку персональных данных%s', 'barhattravel' ), '<a href="' . esc_url( home_url( '/privacy/' ) ) . '">', '</a>' ); ?></span>
				</label>
				<div class="bt-form__msg" role="status" aria-live="polite"></div>
			</form>
		</div>
	</div>

	<div class="bt-footer__bottom">
		<div class="bt-container">
			<p>© <?php echo esc_html( date( 'Y' ) ); ?> ООО «БархатТрэвел». УНП 391956930. <?php esc_html_e( 'Все права защищены.', 'barhattravel' ); ?></p>
			<p>
				<a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>"><?php esc_html_e( 'Политика конфиденциальности', 'barhattravel' ); ?></a>
				<span>·</span>
				<a href="<?php echo esc_url( home_url( '/offer/' ) ); ?>"><?php esc_html_e( 'Публичная оферта', 'barhattravel' ); ?></a>
			</p>
		</div>
	</div>
</footer>

<?php get_template_part( 'template-parts/modal-forms' ); ?>
<?php get_template_part( 'template-parts/cookie' ); ?>

<?php wp_footer(); ?>
</body>
</html>
