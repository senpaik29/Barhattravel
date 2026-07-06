<form role="search" method="get" class="bt-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="bt-sr" for="bt-s"><?php esc_html_e( 'Поиск', 'barhattravel' ); ?></label>
	<input type="search" id="bt-s" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Куда поедем?', 'barhattravel' ); ?>">
	<button type="submit"><?php esc_html_e( 'Найти', 'barhattravel' ); ?></button>
</form>
