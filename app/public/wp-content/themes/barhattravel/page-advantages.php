<?php
/**
 * Template Name: Преимущества
 */
get_header();
while ( have_posts() ) : the_post();
	bt_page_hero( [
		'title'    => 'Почему туристы выбирают <em>БархатТрэвел</em>',
		'subtitle' => 'Шесть весомых причин, по которым к нам возвращаются и приводят друзей.',
		'crumbs'   => [ [ 'label' => 'Преимущества' ] ],
	] );
?>

<section class="bt-section bt-worldmap">
	<div class="bt-container">
		<div class="bt-advantages">
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'shield' ); ?></div>
				<h3>Безопасность</h3>
				<p>Официальное оформление, страхование туристов, регулярные техосмотры собственного транспорта.</p>
			</div>
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'compass' ); ?></div>
				<h3>Разнообразие маршрутов</h3>
				<p>100+ маршрутов — от ночного Полоцка до пляжей Шри-Ланки и замков Европы.</p>
			</div>
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'tag' ); ?></div>
				<h3>Конкурентные цены</h3>
				<p>Гибкая система скидок для постоянных клиентов, организованных групп и школьников.</p>
			</div>
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'heart' ); ?></div>
				<h3>Индивидуальный подход</h3>
				<p>Подбираем качественный и эксклюзивный турпродукт.</p>
			</div>
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'users' ); ?></div>
				<h3>Профессионализм сотрудников</h3>
				<p>Высококвалифицированный персонал с профильным образованием и галантными манерами.</p>
			</div>
			<div class="bt-advantage">
				<div class="bt-advantage__ico"><?php echo bt_icon( 'star' ); ?></div>
				<h3>Открытие года 2025</h3>
				<p>Победитель конкурса субъектов тур. деятельности в номинации «Открытие года 2025». Сертифицированная тур. фирма. Член РАТА (Республиканской Ассоциации Туристических Агентств) с 2024 года.</p>
			</div>
		</div>
	</div>
</section>

<section class="bt-section bt-section--soft">
	<div class="bt-container">
		<div class="bt-section__head">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Как мы работаем</p>
				<h2 class="bt-h2">Четыре шага от заявки до путешествия</h2>
			</div>
		</div>
		<div class="bt-steps">
			<div class="bt-step"><h4>Заявка</h4><p>Оставляете заявку на сайте, в Telegram, WhatsApp или по телефону.</p></div>
			<div class="bt-step"><h4>Подбор маршрута</h4><p>Подбираем подходящий маршрут, готовим индивидуальную программу.</p></div>
			<div class="bt-step"><h4>Договор и оплата</h4><p>Заключаем договор, оформляем страховку, выбираем удобный способ оплаты.</p></div>
			<div class="bt-step"><h4>Поездка</h4><p>Встречаем у автобуса, сопровождаем по программе, на связи 24/7.</p></div>
		</div>

		<div class="bt-trust">
			<div class="bt-trust__badge"><?php echo bt_icon( 'check' ); ?> <span>Член <strong>РАТА</strong></span></div>
			<div class="bt-trust__badge"><?php echo bt_icon( 'star' ); ?> <span><strong>«Открытие года 2025»</strong></span></div>
			<div class="bt-trust__badge"><?php echo bt_icon( 'shield' ); ?> <span>Сертификация — <strong>лето 2026</strong></span></div>
		</div>
	</div>
</section>

<!-- ============ REVIEWS — merged from /reviews/ ============ -->
<section class="bt-section bt-worldmap" id="reviews">
	<div class="bt-container">
		<div class="bt-section__head">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Отзывы</p>
				<h2 class="bt-h2">Наши <em>счастливые</em> и благодарные туристы</h2>
				<p>Мы работаем для вас, и ваши отзывы очень важны для нас, чтобы мы становились ещё лучше день за днём.</p>
			</div>
		</div>
		<?php echo do_shortcode( '[bt_reviews limit="30"]' ); ?>
	</div>
</section>

<section class="bt-section bt-section--soft">
	<div class="bt-container bt-narrow">
		<div class="bt-section__head" style="margin-bottom:24px">
			<div class="bt-section__intro">
				<p class="bt-eyebrow">Расскажите о вашей поездке</p>
				<h2 class="bt-h2">Оставить отзыв</h2>
				<p>После проверки модератором отзыв появится на сайте.</p>
			</div>
		</div>
		<div style="background:#fff; padding:28px; border-radius:var(--bt-radius); border:1px solid var(--bt-line); box-shadow:var(--bt-shadow)">
			<?php echo do_shortcode( '[bt_review_form]' ); ?>
		</div>
	</div>
</section>

<section class="bt-section bt-section--dark">
	<div class="bt-container bt-center">
		<h2 class="bt-h2">Готовы выбрать тур?</h2>
		<div class="bt-hero__actions" style="justify-content:center; margin-top:24px">
			<a class="bt-btn bt-btn--primary bt-btn--lg" href="<?php echo esc_url( home_url( '/tours-catalog/' ) ); ?>"><?php echo bt_icon( 'compass', 'bt-icon bt-icon--sm' ); ?> К каталогу туров</a>
			<a class="bt-btn bt-btn--ghost bt-btn--lg bt-js-open" data-form="callback"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> Заказать звонок</a>
		</div>
	</div>
</section>

<?php endwhile; get_footer();
