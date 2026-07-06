<?php
/**
 * Template Name: О нас
 */
get_header();
while ( have_posts() ) : the_post();
	bt_page_hero( [
		'title'    => 'ООО «БархатТрэвел» — <em>ваш проводник по миру</em>',
		'subtitle' => 'Туристическая компания из Полоцка с 2020 года. Два офиса, собственный автопарк и команда, которая искренне любит путешествия.',
		'crumbs'   => [ [ 'label' => 'О нас' ] ],
	] );
?>

<section class="bt-section bt-worldmap">
	<div class="bt-container">
		<div class="bt-feature-row">
			<div class="bt-feature-row__content">
				<p class="bt-eyebrow">Кто мы</p>
				<h2 class="bt-h2" style="color:#000">Туристическое агентство <span class="bt-nowrap">«<span class="bt-script" style="color:#000">БархатТрэвел</span>»</span></h2>
				<?php if ( get_the_content() ) : the_content();
				else : ?>
				<p>Тур.фирма БТ (БархатТрэвел) осуществляет свою деятельность с <strong>2020 года</strong>. Мы — небольшая, но дружная команда, для которой каждый турист — не клиент, а попутчик. Мы знаем, что лучшее путешествие — это не количество посещённых мест, а ощущение, что вы вернулись домой обновлённым.</p>
				<p>Член Республиканского Альянса Туриндустрии (<strong>РАТА</strong>). Победитель конкурса субъектов туристической деятельности в номинации <strong>«Открытие года 2025»</strong>. Плановая сертификация — лето 2026.</p>
				<ul>
					<li>Все виды пассажирских перевозок по Беларуси, РФ и ближнему зарубежью</li>
					<li>Сборные и индивидуальные туры в любую точку мира</li>
					<li>Бронирование отелей, билетов, мест проведения мероприятий</li>
					<li>Корпоративные программы и тимбилдинг</li>
					<li>Страхование жизни и здоровья туристов</li>
				</ul>
				<?php endif; ?>
				<p>
					<a class="bt-btn bt-btn--primary bt-js-open" data-form="application"><?php echo bt_icon( 'plane', 'bt-icon bt-icon--sm' ); ?> Подобрать тур</a>
					<a class="bt-btn bt-btn--primary" href="#contacts"><?php echo bt_icon( 'map', 'bt-icon bt-icon--sm' ); ?> Контакты</a>
				</p>
			</div>
			<div class="bt-feature-row__media">
				<div class="bt-circle bt-circle--xl">
					<img src="<?php echo esc_url( BT_THEME_URI ); ?>/assets/img/hero.jpg" alt="БархатТрэвел — путешествуйте с нами">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="bt-section bt-section--soft">
	<div class="bt-container">
		<div class="bt-feature-row bt-feature-row--reverse">
			<div class="bt-feature-row__media">
				<div class="bt-circle bt-circle--xl">
					<img src="<?php echo esc_url( BT_THEME_URI ); ?>/assets/img/family-slavic.jpg" alt="Счастливая семья на отдыхе" loading="lazy">
				</div>
			</div>
			<div class="bt-feature-row__content">
				<p class="bt-eyebrow">Что мы делаем</p>
				<h2 class="bt-h2">Полный спектр туристических услуг</h2>
				<p>Нам доверяют семьи, корпоративные клиенты и школьные группы — потому что заботимся о каждом туристе как о своём близком.</p>
				<ul class="bt-services bt-services--single bt-mt-2">
					<li><strong>Перевозки</strong> — все виды пассажирских перевозок</li>
					<li><strong>Сборные туры</strong> по Беларуси, России и зарубежью</li>
					<li><strong>Корпоративные туры</strong>, тимбилдинг, мероприятия</li>
					<li><strong>Индивидуальные туры</strong> с отдыхом на море</li>
					<li><strong>Экскурсионные туры</strong> и тематические поездки</li>
					<li><strong>Бронирование</strong> отелей, билетов, мест проведения</li>
					<li><strong>Страхование</strong> жизни и здоровья туристов</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- ============ CONTACTS — merged from /contacts/ ============ -->
<section class="bt-section bt-worldmap" id="contacts">
	<div class="bt-container">
		<div class="bt-section__head">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Контакты</p>
				<h2 class="bt-h2">Два офиса в Полоцке и Новополоцке</h2>
				<p>Мессенджеры, телефон, e-mail — выбирайте удобный канал, отвечаем в течение рабочего дня.</p>
			</div>
		</div>
		<div class="bt-offices">
			<?php foreach ( bt_offices() as $o ) : ?>
				<div class="bt-office-card">
					<h3><?php echo esc_html( $o['city'] ); ?></h3>
					<div class="bt-office-card__row">
						<a class="bt-office-card__ico" href="<?php echo esc_url( bt_office_map_url( $o ) ); ?>" target="_blank" rel="noopener" title="Открыть в Google Maps"><?php echo bt_icon( 'map' ); ?></a>
						<div><a href="<?php echo esc_url( bt_office_map_url( $o ) ); ?>" target="_blank" rel="noopener" style="color:inherit"><?php echo esc_html( $o['address'] ); ?></a></div>
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

<section class="bt-section bt-worldmap">
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
