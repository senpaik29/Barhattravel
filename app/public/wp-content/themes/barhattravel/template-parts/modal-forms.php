<?php
/**
 * Modal forms: callback, application, review.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$nonce = wp_create_nonce( 'bt_form' );
?>

<!-- Заказать звонок -->
<div class="bt-modal" data-form="callback" role="dialog" aria-modal="true" aria-labelledby="bt-cb-title">
	<div class="bt-modal__box">
		<button type="button" class="bt-modal__close" aria-label="Закрыть">×</button>
		<p class="bt-eyebrow">Свяжемся за 15 минут</p>
		<h3 id="bt-cb-title" class="bt-h3">Заказать звонок</h3>
		<p>Оставьте номер — менеджер перезвонит и поможет подобрать тур.</p>
		<form class="bt-form bt-js-form" data-form="callback" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<input type="hidden" name="action" value="bt_callback">
			<input type="hidden" name="bt_nonce" value="<?php echo esc_attr( $nonce ); ?>">
			<input type="text" name="bt_hp" tabindex="-1" autocomplete="off" class="bt-hp" aria-hidden="true">
			<label>Имя*
				<input type="text" name="name" required>
			</label>
			<label>Телефон*
				<input type="tel" name="phone" required placeholder="+375 XX XXX-XX-XX">
			</label>
			<label class="bt-consent">
				<input type="checkbox" required>
				<span>Согласен на <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">обработку персональных данных</a></span>
			</label>
			<button type="submit" class="bt-btn bt-btn--primary"><?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?> Перезвоните мне</button>
			<div class="bt-form__msg" role="status" aria-live="polite"></div>
		</form>
	</div>
</div>

<!-- Оставить заявку (на тур / рейс / транспорт) -->
<div class="bt-modal" data-form="application" role="dialog" aria-modal="true" aria-labelledby="bt-ap-title">
	<div class="bt-modal__box">
		<button type="button" class="bt-modal__close" aria-label="Закрыть">×</button>
		<p class="bt-eyebrow">Лучшее путешествие в одну заявку</p>
		<h3 id="bt-ap-title" class="bt-h3">Оставить заявку</h3>
		<form class="bt-form bt-js-form" data-form="application" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<input type="hidden" name="action" value="bt_application">
			<input type="hidden" name="bt_nonce" value="<?php echo esc_attr( $nonce ); ?>">
			<input type="text" name="bt_hp" tabindex="-1" autocomplete="off" class="bt-hp" aria-hidden="true">
			<label>Имя*
				<input type="text" name="name" required>
			</label>
			<label>Телефон*
				<input type="tel" name="phone" required>
			</label>
			<label>E-mail
				<input type="email" name="email">
			</label>
			<label>Тур / направление
				<input type="text" name="tour">
			</label>
			<label>Количество человек
				<input type="number" name="people" min="1" step="1">
			</label>
			<label>Комментарий
				<textarea name="message" rows="3" placeholder="Удобные даты, особенности, вопросы"></textarea>
			</label>
			<label class="bt-consent">
				<input type="checkbox" required>
				<span>Согласен на <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">обработку персональных данных</a></span>
			</label>
			<button type="submit" class="bt-btn bt-btn--primary">Отправить заявку</button>
			<div class="bt-form__msg" role="status" aria-live="polite"></div>
		</form>
	</div>
</div>

<!-- Оставить отзыв -->
<div class="bt-modal" data-form="review" role="dialog" aria-modal="true" aria-labelledby="bt-rv-title">
	<div class="bt-modal__box">
		<button type="button" class="bt-modal__close" aria-label="Закрыть">×</button>
		<p class="bt-eyebrow">Спасибо за вашу искренность</p>
		<h3 id="bt-rv-title" class="bt-h3">Оставить отзыв</h3>
		<p>После модерации отзыв появится на сайте.</p>
		<form class="bt-form bt-js-form" data-form="review" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<input type="hidden" name="action" value="bt_review_submit">
			<input type="hidden" name="bt_nonce" value="<?php echo esc_attr( $nonce ); ?>">
			<input type="text" name="bt_hp" tabindex="-1" autocomplete="off" class="bt-hp" aria-hidden="true">
			<label>Ваше имя*
				<input type="text" name="name" required>
			</label>
			<label>Город
				<input type="text" name="city">
			</label>
			<label>Тур / поездка
				<input type="text" name="tour">
			</label>
			<label>Оценка
				<select name="rating">
					<option value="5">★★★★★ — отлично</option>
					<option value="4">★★★★☆ — хорошо</option>
					<option value="3">★★★☆☆ — нормально</option>
					<option value="2">★★☆☆☆ — могло быть лучше</option>
					<option value="1">★☆☆☆☆ — плохо</option>
				</select>
			</label>
			<label>Текст отзыва*
				<textarea name="text" required rows="5"></textarea>
			</label>
			<label class="bt-consent">
				<input type="checkbox" required>
				<span>Согласен на <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">обработку персональных данных</a></span>
			</label>
			<button type="submit" class="bt-btn bt-btn--primary">Отправить отзыв</button>
			<div class="bt-form__msg" role="status" aria-live="polite"></div>
		</form>
	</div>
</div>
