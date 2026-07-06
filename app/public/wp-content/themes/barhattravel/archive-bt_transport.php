<?php
get_header();
?>
<section class="bt-section bt-section--page">
	<div class="bt-container">
		<p class="bt-eyebrow">Перевозки</p>
		<h1 class="bt-h1">Расписание рейсов и выездов</h1>
		<p>Все ближайшие пассажирские перевозки и сборные выезды. Бронируйте место заранее по телефону или через форму.</p>
		<div class="bt-mt-3"><?php echo do_shortcode( '[bt_transport limit="50"]' ); ?></div>
	</div>
</section>
<?php get_footer();
