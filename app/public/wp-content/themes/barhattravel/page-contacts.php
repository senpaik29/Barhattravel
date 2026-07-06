<?php
/**
 * Template Name: Контакты
 */
get_header();
while ( have_posts() ) : the_post();
	bt_page_hero( [
		'eyebrow'  => 'Контакты',
		'title'    => 'Свяжитесь <em>с нами</em>',
		'subtitle' => 'Два офиса в Полоцке и Новополоцке. Мессенджеры, телефон, e-mail — выбирайте удобный канал.',
		'crumbs'   => [ [ 'label' => 'Контакты' ] ],
	] );
?>

<section class="bt-section bt-worldmap">
	<div class="bt-container">
		<div class="bt-offices">
			<?php foreach ( bt_offices() as $o ) : ?>
				<div class="bt-office-card">
					<h3><?php echo esc_html( $o['city'] ); ?></h3>
					<div class="bt-office-card__row">
						<span class="bt-office-card__ico"><?php echo bt_icon( 'map' ); ?></span>
						<div><?php echo esc_html( $o['address'] ); ?></div>
					</div>
					<div class="bt-office-card__row">
						<span class="bt-office-card__ico"><?php echo bt_icon( 'phone' ); ?></span>
						<div><a href="tel:<?php echo esc_attr( $o['tel'] ); ?>"><?php echo esc_html( $o['phone'] ); ?></a></div>
					</div>
					<div class="bt-office-card__row">
						<span class="bt-office-card__ico"><?php echo bt_icon( 'mail' ); ?></span>
						<div><a href="mailto:<?php echo esc_attr( bt_email() ); ?>"><?php echo esc_html( bt_email() ); ?></a></div>
					</div>
					<div class="bt-office-card__row">
						<span class="bt-office-card__ico"><?php echo bt_icon( 'clock' ); ?></span>
						<div>Пн–Пт: 10:00–18:00 · Сб: 10:00–14:00 · Вс: выходной</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="bt-section bt-section--soft">
	<div class="bt-container">
		<div class="bt-section__head">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Мессенджеры</p>
				<h2 class="bt-h2">Напишите там, где удобно</h2>
			</div>
		</div>
		<div class="bt-grid bt-grid--4">
			<a class="bt-advantage" style="background:#fff;text-decoration:none" href="<?php echo esc_url( bt_social()['telegram'] ); ?>" target="_blank" rel="noopener">
				<div class="bt-advantage__ico" style="background:linear-gradient(135deg,#5dc9f7,#1E4FB8); color:#fff"><?php echo bt_icon( 'tg' ); ?></div>
				<h3>Telegram</h3>
				<p>Быстрые ответы, отправка программ туров.</p>
			</a>
			<a class="bt-advantage" style="background:#fff;text-decoration:none" href="<?php echo esc_url( bt_social()['whatsapp'] ); ?>" target="_blank" rel="noopener">
				<div class="bt-advantage__ico" style="background:linear-gradient(135deg,#25D366,#0E7E3F);color:#fff"><?php echo bt_icon( 'wa' ); ?></div>
				<h3>WhatsApp</h3>
				<p>Звонки и сообщения без роуминга.</p>
			</a>
			<a class="bt-advantage" style="background:#fff;text-decoration:none" href="<?php echo esc_url( bt_social()['instagram'] ); ?>" target="_blank" rel="noopener">
				<div class="bt-advantage__ico" style="background:linear-gradient(135deg,#F58529,#DD2A7B,#8134AF);color:#fff"><?php echo bt_icon( 'ig' ); ?></div>
				<h3>Instagram</h3>
				<p>Фотоотчёты с туров и анонсы.</p>
			</a>
			<a class="bt-advantage" style="background:#fff;text-decoration:none" href="<?php echo esc_url( bt_social()['facebook'] ); ?>" target="_blank" rel="noopener">
				<div class="bt-advantage__ico" style="background:linear-gradient(135deg,#1877F2,#0E2A5E);color:#fff"><?php echo bt_icon( 'fb' ); ?></div>
				<h3>Facebook</h3>
				<p>Сообщество и расписание.</p>
			</a>
		</div>
	</div>
</section>

<section class="bt-section">
	<div class="bt-container bt-narrow">
		<div class="bt-section__head" style="margin-bottom:24px">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Напишите нам</p>
				<h2 class="bt-h2">Оставьте заявку — перезвоним за 15 минут</h2>
			</div>
		</div>
		<div style="background:#fff; padding:28px; border-radius:var(--bt-radius); border:1px solid var(--bt-line); box-shadow:var(--bt-shadow)">
			<form class="bt-form bt-js-form" data-form="application" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" style="max-width:none">
				<input type="hidden" name="action" value="bt_application">
				<?php wp_nonce_field( 'bt_form', 'bt_nonce' ); ?>
				<input type="text" name="bt_hp" tabindex="-1" autocomplete="off" class="bt-hp" aria-hidden="true">
				<div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
					<label>Имя*<input type="text" name="name" required></label>
					<label>Телефон*<input type="tel" name="phone" required></label>
				</div>
				<label>E-mail<input type="email" name="email"></label>
				<label>Тур / направление<input type="text" name="tour"></label>
				<label>Комментарий<textarea name="message" rows="4"></textarea></label>
				<label class="bt-consent">
					<input type="checkbox" required>
					<span>Согласен на <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">обработку персональных данных</a></span>
				</label>
				<button type="submit" class="bt-btn bt-btn--primary">Отправить заявку</button>
				<div class="bt-form__msg" role="status" aria-live="polite"></div>
			</form>
		</div>
	</div>
</section>

<?php endwhile; get_footer();
