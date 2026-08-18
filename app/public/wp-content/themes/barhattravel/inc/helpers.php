<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Office contacts shown in header / footer.
 */
function bt_offices() {
	return [
		[
			'city'    => 'Полоцк',
			'address' => 'ул. Октябрьская, д. 54, пом. 408',
			'phone'   => '+375 29 604-12-34',
			'tel'     => '+375296041234',
		],
		[
			'city'    => 'Новополоцк',
			'address' => 'ул. Якуба Коласа, д. 48, офис 108',
			'phone'   => '+375 29 214-20-06',
			'tel'     => '+375292142006',
		],
	];
}

function bt_email() {
	return 'ooobarhattravel@gmail.com';
}

/**
 * Google Maps search URL for an office address.
 */
function bt_office_map_url( $office ) {
	$query = $office['address'] . ', ' . $office['city'] . ', Беларусь';
	return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $query );
}

function bt_social() {
	return [
		'telegram'  => 'https://t.me/barhat_travel_belarus',
		'viber'     => 'viber://chat?number=%2B375296041234',
		'whatsapp'  => 'https://wa.me/375296041234',
		'instagram' => 'https://www.instagram.com/barhattravel.by',
		'facebook'  => 'https://www.facebook.com/share/14pRMQsct3/?mibextid=LQQI4d',
		'tiktok'    => '#', // TODO: заменить на реальную ссылку
	];
}

/**
 * Pretty-print a phone number for tel:.
 */
function bt_tel( $phone ) {
	return preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * SVG icon — keeps markup tidy and avoids extra HTTP requests.
 */
function bt_icon( $name, $class = 'bt-icon' ) {
	$icons = [
		'phone'     => '<path d="M4 5c0-1 1-2 2-2h2l2 4-2 1c.5 2 2 3.5 4 4l1-2 4 2v2c0 1-1 2-2 2C9 16 4 11 4 5z"/>',
		'mail'     => '<path d="M3 5h18v14H3z"/><path d="M3 5l9 7 9-7"/>',
		'map'      => '<path d="M12 2a7 7 0 00-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 00-7-7z"/><circle cx="12" cy="9" r="2.5"/>',
		'bus'      => '<rect x="3" y="5" width="18" height="12" rx="2"/><circle cx="8" cy="18" r="2"/><circle cx="16" cy="18" r="2"/><path d="M3 11h18M8 5v6M16 5v6"/>',
		'shield'   => '<path d="M12 2l8 3v6c0 5-4 9-8 11-4-2-8-6-8-11V5l8-3z"/><path d="M9 12l2 2 4-4"/>',
		'compass'  => '<circle cx="12" cy="12" r="9"/><path d="M15 9l-2 6-6 2 2-6 6-2z"/>',
		'tag'      => '<path d="M3 12V3h9l9 9-9 9-9-9z"/><circle cx="8" cy="8" r="1.5"/>',
		'steps'    => '<path d="M4 19h4v-4M10 15h4v-4M16 11h4V7"/>',
		'heart'    => '<path d="M12 21s-7-4.5-9.5-9A5 5 0 0112 6a5 5 0 019.5 6C19 16.5 12 21 12 21z"/>',
		'check'    => '<path d="M4 12l5 5 11-11"/>',
		'x'        => '<path d="M6 6l12 12M18 6L6 18"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'star'     => '<path d="M12 3l2.9 5.9 6.5.9-4.7 4.6 1.1 6.5L12 17.8 6.2 21l1.1-6.5L2.6 9.8l6.5-.9L12 3z"/>',
		'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'users'    => '<circle cx="9" cy="8" r="3"/><path d="M3 20c0-3 3-5 6-5s6 2 6 5"/><circle cx="17" cy="9" r="2.5"/><path d="M15 20c0-2 2-3.5 4-3.5s2 1 2 3.5"/>',
		'globe'    => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c3 4 3 14 0 18M12 3c-3 4-3 14 0 18"/>',
		'plane'    => '<path d="M10 2l2 8 9 3-9 3-2 8-1-8-7-3 7-3 1-8z"/>',
		'beach'    => '<circle cx="6" cy="6" r="3"/><path d="M6 9v12M2 21h20M10 9c2 0 5 1 8 4"/>',
		'castle'   => '<path d="M3 21V9l3 2V7l3 2V5l3 2V5l3 2v4l3-2v12H3z"/>',
		'school'   => '<path d="M2 9l10-5 10 5-10 5L2 9z"/><path d="M6 11v6l6 3 6-3v-6"/>',
		'tg'       => '<path d="M21 4L3 11l5 2 2 6 3-4 5 4 3-15z"/>',
		'ig'       => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/>',
		'fb'       => '<path d="M14 9V7a1 1 0 011-1h2V3h-3a4 4 0 00-4 4v2H8v3h3v8h3v-8h2.5l.5-3H14z"/>',
		'tt'       => '<path d="M16 3a4 4 0 004 4v3a7 7 0 01-4-1v6a5 5 0 11-5-5v3a2 2 0 102 2V3z"/>',
		'wa'       => '<path d="M3 21l1.5-5A8 8 0 1112 20a8 8 0 01-4-1L3 21z"/>',
		'menu'     => '<path d="M4 6h16M4 12h16M4 18h16"/>',
		'close'    => '<path d="M6 6l12 12M18 6L6 18"/>',
	];
	$d = $icons[ $name ] ?? '';
	return sprintf(
		'<svg class="%s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%s</svg>',
		esc_attr( $class ),
		$d
	);
}

/**
 * Format a price number with currency.
 */
function bt_price( $value ) {
	$value = (float) $value;
	if ( $value <= 0 ) {
		return __( 'По запросу', 'barhattravel' );
	}
	return number_format( $value, 0, ',', ' ' ) . ' BYN';
}

/**
 * Render a branded page hero (light-blue gradient + map watermark).
 * Used at the top of inner pages for consistent design.
 *
 * $args = [ 'eyebrow' => '', 'title' => '', 'subtitle' => '', 'slogan' => '', 'crumbs' => [['url','label']] ]
 */
function bt_page_hero( $args = [] ) {
	$args = wp_parse_args( $args, [
		'eyebrow'  => '',
		'title'    => '',
		'subtitle' => '',
		'slogan'   => '',
		'crumbs'   => [],
	] );
	?>
	<section class="bt-page-hero">
		<div class="bt-container">
			<div class="bt-page-hero__inner">
				<?php if ( $args['crumbs'] ) : ?>
					<nav class="bt-page-hero__breadcrumbs" aria-label="Хлебные крошки">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<?php foreach ( $args['crumbs'] as $i => $c ) : ?>
							<span>›</span>
							<?php if ( $i < count( $args['crumbs'] ) - 1 && ! empty( $c['url'] ) ) : ?>
								<a href="<?php echo esc_url( $c['url'] ); ?>"><?php echo esc_html( $c['label'] ); ?></a>
							<?php else : ?>
								<?php echo esc_html( $c['label'] ); ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>
				<?php if ( $args['eyebrow'] ) : ?>
					<span class="bt-page-hero__eyebrow"><?php echo bt_icon( 'compass', 'bt-icon bt-icon--xs' ); ?> <?php echo esc_html( $args['eyebrow'] ); ?></span>
				<?php endif; ?>
				<h1 class="bt-page-hero__title"><?php echo wp_kses_post( $args['title'] ); ?></h1>
				<?php if ( $args['subtitle'] ) : ?>
					<p class="bt-page-hero__sub"><?php echo esc_html( $args['subtitle'] ); ?></p>
				<?php endif; ?>
				<?php if ( $args['slogan'] ) : ?>
					<p class="bt-page-hero__slogan"><?php echo esc_html( $args['slogan'] ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Tour category catalog data — used by category page templates and homepage promo.
 */
function bt_tour_categories() {
	return [
		'tours-catalog' => [
			'slug'    => 'tours-catalog',
			'icon'    => 'bus',
			'banner'  => 'bus-tour.jpg',
			'title'   => 'Автобусные и ж/д туры по Беларуси',
			'eyebrow' => 'Туры выходного дня',
			'desc'    => 'Насыщенная программа, выезд с пятницы или субботы.',
			'short'   => 'Устали от ежедневной суеты? Хотите получить массу новых впечатлений и зарядиться энергией для новых свершений? Тогда пакуем чемоданы и отправляемся в тур по Беларуси!',
			'destinations' => [
				[ 'name' => 'Гродно – Лида',                    'icon' => 'castle',  'sub' => '«По следам Гродненских рыцарей и королей»',   'image' => 'dest-grodno.jpg',          'program' => 'grodno-lida' ],
				[ 'name' => 'Брест – Коссово',                  'icon' => 'castle',  'sub' => '«Великий и непокоренный Брест»',              'image' => 'dest-brest.jpg',           'program' => 'brest-kossovo' ],
				[ 'name' => 'Жиличи – Красный берег – Гомель',  'icon' => 'map',     'sub' => '«Наследие Гомельской земли»',                 'image' => 'dest-bobruysk-gomel.jpg',  'program' => 'zhilichi-gomel' ],
				[ 'name' => 'Пинск – Барановичи',               'icon' => 'compass', 'sub' => '«По следам иезуитов и сказочных животных»',   'image' => 'dest-pinsk-baranovichi.jpg', 'program' => 'pinsk-baranovichi' ],
				[ 'name' => 'Крево – Новогрудок – Туров',       'icon' => 'castle',  'sub' => '«Навагрудскія таямніцы і Марсіянскія пейзажы»', 'image' => 'dest-novogrudok.jpg',     'program' => 'krevo-turov' ],
			],
			'programs' => [
				[
					'slug'  => 'grodno-lida',
					'route' => 'Гродно – Лида',
					'title' => 'По следам Гродненских рыцарей и королей',
					'text'  => 'Лида и Гродно — это два города с богатейшим историческим наследием, посещение которых окунёт вас в атмосферу величественных замков, костёлов и уютных старинных улочек. Во время нашего тура вы посетите: жемчужину неоготики — Костёл Святой Троицы в а/г Гервяты, мистический Гольшанский замок, а также свои тайны для вас приоткроет Лидский замок и Старый замок в Гродно. Завершится наше путешествие посиделками со вкусным обедом и пивной дегустацией в гостях у «Вольнага мельніка». Приглашаем всех провести выходные необычно и увлекательно — будет весело и вкусно, а главное, очень интересно!',
				],
				[
					'slug'  => 'brest-kossovo',
					'route' => 'Брест – Коссово',
					'title' => 'Великий и непокоренный Брест',
					'text'  => 'Всем тем, кто собирается не упустить замечательную возможность побывать в Великом городе, чья крепость носит гордое звание «ГЕРОЙ», — в Бресте! Услышать голос Левитана, окунуться в атмосферу стойкости и величия, прогуляться по вечернему «Брестскому Арбату», поздороваться с фонарщиком и увидеть величественный замок Пусловских — всё это и не только вы сможете сделать, поехав в наш двухдневный тур Коссово – Брест.',
				],
				[
					'slug'  => 'zhilichi-gomel',
					'route' => 'Жиличи – Красный берег – Гомель',
					'title' => 'Наследие Гомельской земли',
					'text'  => 'Где можно увидеть красивейший фарфор, бумажную фабрику, ювелирные изделия на любой вкус, чудесно сохранившийся дворец и парк, а также излюбленное место сталкеров? Это Его Величество — Гомель! А по дороге мы посетим величественный дворец Булгаков, чья резиденция была роскошнее, чем у Радзивиллов в своё время. Также заглянем в гости к Козел-Поклевским и узнаем трагическую историю места, где располагается мемориальный комплекс «Красный берег».',
				],
				[
					'slug'  => 'pinsk-baranovichi',
					'route' => 'Пинск – Барановичи',
					'title' => 'По следам иезуитов и сказочных животных',
					'text'  => 'Иезуитская история вплоть до 1939 года, тихие аутентичные улочки, теплоход по реке Пина, а также возможность погладить альпак и наперегонки махнуть со страусом! Вот это и есть наш увлекательный тур выходного дня «По следам иезуитов и сказочных животных». Подарите себе и своим близким незабываемые эмоции.',
				],
				[
					'slug'  => 'krevo-turov',
					'route' => 'Крево – Новогрудок – Слуцк – Солигорск – Микашевичи – Туров',
					'title' => 'Навагрудскія таямніцы і Марсіянскія пейзажы',
					'text'  => 'Если хочется попробовать «абваранки», побывать в первой столице Великого Княжества Литовского, услышать легенды доминиканцев, взглянуть на марсианские пейзажи и заглянуть в гости к княгине Слуцкой, а после увидеть могущественные гранитные водопады и насладиться божественными сырами «Bonfesto» — тогда срочно собираем чемоданы и отправляемся в тур выходного дня «Навагрудскія таямніцы і Марсіянскія пейзажы»!',
				],
			],
		],
		'excursions' => [
			'slug'    => 'excursions',
			'icon'    => 'compass',
			'banner'  => 'cat-excursions.jpg',
			'title'   => 'Экскурсии',
			'eyebrow' => 'Однодневные и тематические',
			'desc'    => 'Экскурсионные и тематические поездки на один день — интерактивные программы, промышленный, агро- и событийный туризм.',
			'short'   => 'Очень хочется путешествовать, но у Вас всего 1 день? Не беда! Наш экскурсионный каталог приятно удивит даже самого взыскательного путешественника.',
			'destinations' => [
				[ 'name' => 'Полоцк',           'icon' => 'castle',  'sub' => '«Скарбы падземнага гораду», «По следам первопечатника»', 'image' => 'dest-polotsk.jpg',          'program' => 'interactive-polotsk' ],
				[ 'name' => 'Минск – Жодино',   'icon' => 'bus',     'sub' => '«В гости к хаски и машинам-гигантам»',                   'image' => 'dest-belaz.jpg',            'program' => 'industrial-tourism' ],
				[ 'name' => 'Нарочь – Глубокое – Поставы', 'icon' => 'heart', 'sub' => '«Индейской тропой по Глубокскому краю»',       'image' => 'dest-nanosy.jpg',           'program' => 'agro-gastro' ],
				[ 'name' => 'Минск-Мир',        'icon' => 'castle',  'sub' => '«В Мире замков и кино»',                                 'image' => 'dest-mir-nesvizh.jpg',      'program' => 'history-culture-mir' ],
				[ 'name' => 'Витебск – Александрия – Миоры', 'icon' => 'globe', 'sub' => '«Фестивальная столица», «Европейская Амазония»',                                   'program' => 'events-vitebsk' ],
			],
			'programs' => [
				[
					'slug'  => 'interactive-polotsk',
					'route' => 'Полоцк',
					'title' => 'Скарбы падземнага гораду · По следам первопечатника',
					'text'  => 'Хотите прикоснуться к тайнам самого древнего города Беларуси? У вас будет такая возможность с нашими замечательными программами в виде театрального действа, где сам «патриарх городов белорусских» выступает в роли художественных декораций, где оживают и предстают перед вашими глазами люди-легенды, древние сюжеты, утраченные сокровища.',
				],
				[
					'slug'  => 'industrial-tourism',
					'route' => 'Минск – Жодино',
					'title' => 'Приключения в шоколаде с шампанским · В гости к хаски и машинам-гигантам',
					'text'  => 'Проведите день с удовольствием — отправляйтесь в путешествие на фабрику, где рождается шоколад, а чашечка горячего чая или кофе подарит Вам своё тепло и особенную магию. Или же посвятите время себе и отправляйтесь в шаманское поселение к милейшим хаски, сделайте отличные фотографии, попробуйте в юрте настоящий шаманский чай с угощением. А на «десерт» — познакомьтесь с секретами производства машин-гигантов на БЕЛАЗе, заводе мировых рекордсменов среди самосвалов. Это не только незабываемый опыт, но и шанс ощутить масштаб техники, которая поражает своими размерами и мощностью.',
				],
				[
					'slug'  => 'agro-gastro',
					'route' => 'Нарочь – Глубокое – Поставы',
					'title' => 'Монастырские чаи, хлеба и вина · Индейской тропой · В гости к прадеду Дедушки Мороза',
					'text'  => 'Эти экскурсионные программы дадут возможность перенестись в места из романа Дж. Фенимора Купера «Последний из могикан», где человек не царь природы, а часть экосистемы. Вы узнаете о культуре экологического образа жизни и убедитесь в том, что жить можно в гармонии с природой, не нарушая её тонкого баланса, и при этом улучшая качество жизни, как своей, так и планеты в целом. А невероятное количество дегустаций, включая продукцию собственного производства, точно не оставит никого голодным и равнодушным в этом путешествии!',
				],
				[
					'slug'  => 'history-culture-mir',
					'route' => 'Минск-Мир',
					'title' => 'В Мире замков и кино',
					'text'  => 'Знаете ли вы, где живёт кино и как жили рыцари в средние века? Национальная киностудия «Беларусьфильм» — это не просто место, где создаются фильмы, это дом, где рождается искусство, вдохновение и национальная гордость! Не упустите уникальную возможность заглянуть за кулисы одного из самых известных кинопроизводств Беларуси и узнать о процессе создания фильмов, которые завоевали сердца зрителей. А после — отправимся в путешествие по замку Мира. Проберёмся в его тюремный подвал, башни, стены замка и часовню-усыпальницу князей! Почувствуйте себя настоящим магнатом XVI века, рыцарем или дамой сердца храброго воина. Дух средневековья окутает вас, едва вы переступите порог этого удивительного места!',
				],
				[
					'slug'  => 'events-vitebsk',
					'route' => 'Витебск – Александрия – Миоры',
					'title' => 'Фестивальная столица · Александрия собирает друзей · Европейская Амазония',
					'text'  => 'Отгадайте загадку: по площади — Флоренция и Париж вместе взятые, по возрасту — древнее египетских пирамид. Где? — В Беларуси! Такими впечатляющими параметрами встречает нас Ельня — древний рекуператор кислорода, который влияет на климатические условия целого региона. Осенью здесь можно наблюдать тысячи серых журавлей, их миграция — потрясающее зрелище, а нетронутые заболоченные места — настоящая таинственная редкость! Всё это и не только ждёт вас в Миорах на ежегодном экологическом празднике «Жураўлі і журавіны Міёрскага краю».',
				],
			],
		],
		'abroad' => [
			'slug'    => 'abroad',
			'icon'    => 'globe',
			'banner'  => 'cat-abroad.jpg',
			'title'   => 'Автобусные и ж/д туры по России и ближнему зарубежью',
			'eyebrow' => 'Многодневные поездки',
			'desc'    => 'Многодневные поездки в Москву, Петербург, Псков, Пушкинские Горы и другие направления. Сборные группы и индивидуальные программы.',
			'short'   => 'Россия очень большая страна, и, вроде, карту то все видели. Но лишь отправившись в путешествие по стране, понимаешь весь масштаб: от бескрайних степей и ветров на Ладожских шхерах до Балтийского моря и замков некогда Кёнигсберга. Вашему вниманию — туры в Москву, Петербург, Карелию, Калининград, Казань, Суздаль, Смоленск, Псков, Пушкинские Горы и другие города.',
			'destinations' => [
				[ 'name' => 'Москва',          'icon' => 'castle',  'flag' => '🇷🇺', 'sub' => '«Московская классика»',                    'image' => 'dest-moscow.jpg',            'program' => 'moscow-classic' ],
				[ 'name' => 'Санкт-Петербург', 'icon' => 'castle',  'flag' => '🇷🇺', 'sub' => '«Петербургские каникулы»',                  'image' => 'dest-spb.jpg',               'program' => 'spb-caniculy' ],
				[ 'name' => 'Псков',           'icon' => 'castle',  'flag' => '🇷🇺', 'sub' => '«Легенды Пскова, английский парк и улитки»','image' => 'dest-pskov.jpg',             'program' => 'pskov-legends' ],
				[ 'name' => 'Пушкинские Горы', 'icon' => 'compass', 'flag' => '🇷🇺', 'sub' => 'Место шедевральное и сакральное',           'image' => 'dest-pushkin-mountains.jpg', 'program' => 'pushkin-mountains' ],
			],
			'programs' => [
				[
					'slug'  => 'moscow-classic',
					'route' => 'Москва',
					'title' => 'Московская классика',
					'text'  => 'Москва притягивает туристов своим богатым историческим наследием, великолепной архитектурой, динамичной культурной жизнью и развитой инфраструктурой. Незабываемые впечатления гарантированы, а эмоциональный разброс от величественного Кремля до уютных парков, от оживлённых проспектов до неспешного ритма тихих улочек — это привычное состояние наших туристов в Москве. Для опытных путешественников у нас есть несколько советов по поводу списка must-do в Москве: пересчитать все «Сталинские высотки»; пройтись с экскурсией по туннелям подземного метро; забраться на смотровую «Москва-Сити»; попробовать торт «Москва»; прочувствовать столичную жизнь на Патриках; устроить речную прогулку на катере по Москве; наведаться в старинную пончиковую в Останкино; погулять по императорскому парку в Царицыно. Ну, что, едем?',
				],
				[
					'slug'  => 'spb-caniculy',
					'route' => 'Санкт-Петербург',
					'title' => 'Петербургские каникулы',
					'text'  => 'Санкт-Петербург — город, полный контрастов и удивительных открытий. Каждый его уголок дышит историей и культурой. С одной стороны, это город прямых проспектов, величественных дворцов и строгих памятников. С другой — город узких улочек, тихих дворов-колодцев и уютных кофеен, где время как будто замедляется. Невероятная архитектура, водные прогулки с выходом в Финский залив, пышечные, пельменные и, конечно же, магазин купцов Елисеевых; а ещё музеи, дворцы и парки невероятной красоты. Ну как не влюбляться в этот город снова и снова? Приглашаем присоединиться к поездке в Санкт-Петербург в рамках тура выходного дня с выездом вечером в пятницу и возвращением в ночь на понедельник.',
				],
				[
					'slug'  => 'pskov-legends',
					'route' => 'Псков',
					'title' => 'Легенды Пскова, английский парк и улитки',
					'text'  => 'Давно ли Вы ели улиток, наслаждаясь при этом бокалом шампанского, подобно французской королевской знати? Вы сможете попробовать изысканный деликатес, который не едят, а смакуют, каждый раз переживая удивительный гастрономический опыт, и ощутить эксклюзивные ароматы дорогостоящих сортов. И непременно отправляйтесь на прогулку по английскому парку с его изумительной французской оранжереей XIX века. А завершите путешествие пешей прогулкой по «городу тысячи церквей», хотя до наших дней сохранилось около 40 памятников. Семь из них включены в список объектов всемирного наследия ЮНЕСКО как представители псковской архитектурной школы. Бронируйте наш тур «Легенды Пскова, английский парк и улитки» — будет вкусно, весело и душевно!',
				],
				[
					'slug'  => 'pushkin-mountains',
					'route' => 'Пушкинские Горы',
					'title' => 'Пушкинские горы',
					'text'  => 'Место шедевральное и для ценителей литературы сакральное! Но в Пушкинские Горы стоит ехать даже если вы совершенно не ценитель наследия Александра Сергеевича, а предпочитаете стихи Лермонтова, или, скажем, Маяковского, или вообще вселенную «Марвел», или любой другой жанр кино. Хотя, судя по последним новинкам кинематографа, Пушкинские Горы — место особенное, наполненное невероятной красотой, вдохновением и силой. Хотите отдохнуть и перезагрузиться? Тогда нам точно по пути!',
				],
			],
		],
		'beach' => [
			'slug'    => 'beach',
			'icon'    => 'beach',
			'banner'  => 'cat-beach.jpg',
			'title'   => 'Пляжный отдых',
			'eyebrow' => 'Тёплое море круглый год',
			'desc'    => 'Чартеры и регулярные рейсы. Тёплое море круглый год — на любой бюджет.',
			'short'   => 'Чартеры и регулярные рейсы. Тёплое море на любой бюджет — от Египта до Шри-Ланки.',
			'destinations' => [
				[ 'name' => 'Египет',    'icon' => 'beach', 'flag' => '🇪🇬', 'image' => 'dest-egypt.jpg' ],
				[ 'name' => 'Турция',    'icon' => 'beach', 'flag' => '🇹🇷', 'image' => 'dest-turkey.jpg' ],
				[ 'name' => 'Шри-Ланка', 'icon' => 'beach', 'flag' => '🇱🇰', 'image' => 'dest-sri-lanka.jpg' ],
				[ 'name' => 'ОАЭ',       'icon' => 'beach', 'flag' => '🇦🇪', 'image' => 'dest-uae.jpg' ],
				[ 'name' => 'Таиланд',   'icon' => 'beach', 'flag' => '🇹🇭', 'image' => 'dest-thailand.jpg' ],
				[ 'name' => 'Вьетнам',   'icon' => 'beach', 'flag' => '🇻🇳', 'image' => 'dest-vietnam.jpg' ],
				[ 'name' => 'Китай',     'icon' => 'globe', 'flag' => '🇨🇳', 'image' => 'dest-china.jpg' ],
				[ 'name' => 'Испания',   'icon' => 'beach', 'flag' => '🇪🇸', 'image' => 'dest-spain.jpg' ],
				[ 'name' => 'Италия',    'icon' => 'castle','flag' => '🇮🇹', 'image' => 'dest-italy.jpg' ],
				[ 'name' => 'Греция',    'icon' => 'beach', 'flag' => '🇬🇷', 'image' => 'dest-greece.jpg' ],
			],
		],
		'school-tours' => [
			'slug'    => 'school-tours',
			'icon'    => 'school',
			'banner'  => 'cat-school.jpg',
			'title'   => 'Школьные поездки',
			'eyebrow' => 'Образовательный туризм',
			'desc'    => 'Историко-патриотические программы, интерактивные музеи, безопасные группы со страховкой каждого ребёнка.',
			'short'   => 'Историко-патриотические программы и интерактивные музеи, страховка каждого ребёнка в стоимости.',
			'destinations' => [
				[ 'name' => 'Линия Сталина',        'icon' => 'shield',  'sub' => 'Историко-культурный комплекс', 'image' => 'dest-stalin-line.jpg' ],
				[ 'name' => 'Альбатрос',            'icon' => 'compass', 'sub' => 'Конно-исторический комплекс',  'image' => 'dest-albatros.jpg' ],
				[ 'name' => 'Парк «Страна мини»',   'icon' => 'castle',  'sub' => 'Беларусь в макетах',           'image' => 'dest-mini-country.jpg' ],
				[ 'name' => 'Хатынь',               'icon' => 'heart',   'sub' => 'Мемориал',                     'image' => 'dest-khatyn.jpg' ],
				[ 'name' => 'Ржев + Музей Авиации', 'icon' => 'plane',   'flag' => '🇷🇺', 'sub' => 'Многодневный', 'image' => 'dest-rzhev.jpg' ],
			],
		],
	];
}

/**
 * Look up a bt_tour post whose title contains the given destination name.
 * Returns permalink, or null if no match.
 */
function bt_find_tour_link( $destination_name ) {
	static $cache = null;
	if ( $cache === null ) {
		$cache = [];
		$tours = get_posts( [
			'post_type'      => 'bt_tour',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		] );
		foreach ( $tours as $t ) {
			$cache[] = [ 'title' => $t->post_title, 'url' => get_permalink( $t ) ];
		}
	}
	$needle = mb_strtolower( trim( $destination_name ) );
	// Strip decorative parts like "«...»" quotes and " – ... " suffixes for better matching
	$needle_clean = trim( preg_replace( '/[«»"]/u', '', $needle ) );
	foreach ( $cache as $t ) {
		$title = trim( preg_replace( '/[«»"]/u', '', mb_strtolower( $t['title'] ) ) );
		// Exact substring match
		if ( mb_strpos( $title, $needle_clean ) !== false ) {
			return $t['url'];
		}
		// Morphological match — drop last 1-2 chars to catch case endings (Сула/Суле, Полоцк/Полоцка etc)
		if ( mb_strlen( $needle_clean ) >= 4 ) {
			$stem = mb_substr( $needle_clean, 0, -1 );
			if ( mb_strpos( $title, $stem ) !== false ) {
				return $t['url'];
			}
			if ( mb_strlen( $needle_clean ) >= 5 ) {
				$stem2 = mb_substr( $needle_clean, 0, -2 );
				if ( mb_strpos( $title, $stem2 ) !== false ) {
					return $t['url'];
				}
			}
		}
	}
	return null;
}

/**
 * Render a category page section (banner + destination grid).
 */
function bt_render_category_block( $slug ) {
	$cats = bt_tour_categories();
	if ( ! isset( $cats[ $slug ] ) ) return;
	$cat = $cats[ $slug ];
	$grads = [
		'linear-gradient(135deg,#3525cd,#712ae2)',
		'linear-gradient(135deg,#4f46e5,#8a4cfc)',
		'linear-gradient(135deg,#004d70,#006693)',
		'linear-gradient(135deg,#712ae2,#3525cd)',
		'linear-gradient(135deg,#3525cd,#004d70)',
		'linear-gradient(135deg,#8a4cfc,#4f46e5)',
	];
	?>
	<div class="bt-cat" id="cat-<?php echo esc_attr( $cat['slug'] ); ?>">
		<div class="bt-cat__head">
			<img src="<?php echo esc_url( BT_THEME_URI . '/assets/img/' . $cat['banner'] ); ?>" alt="<?php echo esc_attr( $cat['title'] ); ?>" loading="lazy">
			<div class="bt-cat__head-inner">
				<div class="bt-cat__icon"><?php echo bt_icon( $cat['icon'] ); ?></div>
				<div>
					<h2><?php echo esc_html( $cat['title'] ); ?></h2>
					<p><?php echo esc_html( $cat['desc'] ); ?></p>
				</div>
			</div>
		</div>

		<?php
		// Индекс программ по slug — чтобы карточка направления могла вести к описанию тура на той же странице.
		$programs_by_slug = [];
		if ( ! empty( $cat['programs'] ) ) {
			foreach ( $cat['programs'] as $p ) {
				if ( ! empty( $p['slug'] ) ) $programs_by_slug[ $p['slug'] ] = $p;
			}
		}
		?>
		<div class="bt-destinations">
			<?php foreach ( $cat['destinations'] as $i => $d ) :
				$tour_url = bt_find_tour_link( $d['name'] );
				if ( $tour_url ) {
					$link_attrs = 'href="' . esc_url( $tour_url ) . '"';
					$link_extra = '';
				} elseif ( ! empty( $d['program'] ) && isset( $programs_by_slug[ $d['program'] ] ) ) {
					// Есть программа тура — карточка ведёт на отдельную страницу с полным описанием.
					$tour_page_url = home_url( '/' . $cat['slug'] . '/' . $d['program'] . '/' );
					$link_attrs = 'href="' . esc_url( $tour_page_url ) . '"';
					$link_extra = '';
				} else {
					// Нет ни страницы тура, ни программы — клик открывает форму заявки, помеченную названием направления.
					$link_attrs = 'href="#application"';
					$link_extra = ' bt-js-open" data-form="application" data-tour="' . esc_attr( $d['name'] );
				}
			?>
				<a class="bt-destination<?php echo $link_extra; ?>" <?php echo $link_attrs; ?>>
					<div class="bt-destination__pic <?php echo ! empty( $d['image'] ) ? 'bt-destination__pic--photo' : ''; ?>" style="--bt-d-grad: <?php echo esc_attr( $grads[ $i % count( $grads ) ] ); ?>">
						<?php if ( ! empty( $d['image'] ) ) : ?>
							<img src="<?php echo esc_url( BT_THEME_URI . '/assets/img/' . $d['image'] ); ?>" alt="<?php echo esc_attr( $d['name'] ); ?>" loading="lazy">
						<?php else : ?>
							<?php echo bt_icon( $d['icon'] ); ?>
						<?php endif; ?>
						<?php if ( ! empty( $d['flag'] ) ) : ?>
							<span class="bt-destination__flag" aria-hidden="true"><?php echo esc_html( $d['flag'] ); ?></span>
						<?php endif; ?>
					</div>
					<div class="bt-destination__body">
						<div>
							<div class="bt-destination__name"><?php echo esc_html( $d['name'] ); ?></div>
							<?php if ( ! empty( $d['sub'] ) ) : ?>
								<div class="bt-destination__sub"><?php echo esc_html( $d['sub'] ); ?></div>
							<?php endif; ?>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

/**
 * Render tour programs list — used under category catalog to describe each route in full.
 */
function bt_render_tour_programs( $slug ) {
	$cats = bt_tour_categories();
	if ( ! isset( $cats[ $slug ]['programs'] ) ) return;
	$programs = $cats[ $slug ]['programs'];
	?>
	<div class="bt-programs">
		<?php foreach ( $programs as $p ) :
			$prog_id = ! empty( $p['slug'] ) ? 'program-' . $p['slug'] : '';
		?>
			<article class="bt-program"<?php echo $prog_id ? ' id="' . esc_attr( $prog_id ) . '"' : ''; ?>>
				<header class="bt-program__head">
					<div class="bt-program__route"><?php echo esc_html( $p['route'] ); ?></div>
					<h3 class="bt-program__title">«<?php echo esc_html( $p['title'] ); ?>»</h3>
				</header>
				<p class="bt-program__text"><?php echo esc_html( $p['text'] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
	<?php
}

/**
 * Render a single tour page — hero, image, full program text, related tours, CTA.
 * Used by category templates when /cat-slug/tour-slug/ is requested.
 */
function bt_render_tour_page( $cat_slug, $tour_slug ) {
	$cats = bt_tour_categories();
	if ( ! isset( $cats[ $cat_slug ] ) ) return false;
	$cat = $cats[ $cat_slug ];
	if ( empty( $cat['programs'] ) ) return false;

	// Find the program by slug
	$program = null;
	foreach ( $cat['programs'] as $p ) {
		if ( ! empty( $p['slug'] ) && $p['slug'] === $tour_slug ) { $program = $p; break; }
	}
	if ( ! $program ) return false;

	// Find matching destination (for image + name)
	$dest = null;
	foreach ( $cat['destinations'] as $d ) {
		if ( ! empty( $d['program'] ) && $d['program'] === $tour_slug ) { $dest = $d; break; }
	}
	$image = $dest && ! empty( $dest['image'] ) ? BT_THEME_URI . '/assets/img/' . $dest['image'] : '';

	// Hero
	bt_page_hero( [
		'title'    => '«' . esc_html( $program['title'] ) . '»',
		'subtitle' => $program['route'],
		'eyebrow'  => $cat['eyebrow'],
		'crumbs'   => [
			[ 'label' => $cat['title'], 'url' => home_url( '/' . $cat['slug'] . '/' ) ],
			[ 'label' => $program['route'] ],
		],
	] );
	?>

	<section class="bt-section bt-worldmap" style="padding-top: clamp(20px, 4vw, 40px)">
		<div class="bt-container">
			<article class="bt-tour-page">
				<?php if ( $image ) : ?>
					<div class="bt-tour-page__media">
						<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $dest['name'] ); ?>" loading="lazy">
					</div>
				<?php endif; ?>
				<div class="bt-tour-page__body">
					<div class="bt-tour-page__route"><?php echo esc_html( $program['route'] ); ?></div>
					<h2 class="bt-tour-page__title">«<?php echo esc_html( $program['title'] ); ?>»</h2>
					<div class="bt-tour-page__text">
						<?php echo wpautop( esc_html( $program['text'] ) ); ?>
					</div>
					<div class="bt-tour-page__actions">
						<a class="bt-btn bt-btn--primary bt-btn--lg bt-js-open" data-form="application" data-tour="<?php echo esc_attr( $dest ? $dest['name'] : $program['route'] ); ?>">
							<?php echo bt_icon( 'compass', 'bt-icon bt-icon--sm' ); ?>
							Оставить заявку на этот тур
						</a>
						<a class="bt-btn bt-btn--ghost bt-btn--lg" href="tel:+375296041234">
							<?php echo bt_icon( 'phone', 'bt-icon bt-icon--sm' ); ?>
							+375 29 604-12-34
						</a>
					</div>
				</div>
			</article>
		</div>
	</section>

	<?php
	// Related tours from the same category
	$related = [];
	foreach ( $cat['destinations'] as $d ) {
		if ( empty( $d['program'] ) || $d['program'] === $tour_slug ) continue;
		$related[] = $d;
	}
	if ( $related ) : ?>
		<section class="bt-section bt-section--soft" style="padding-top: clamp(20px, 4vw, 40px)">
			<div class="bt-container">
				<div class="bt-center" style="margin-bottom: clamp(20px, 3vw, 32px)">
					<p class="bt-eyebrow">Другие маршруты</p>
					<h2 class="bt-h2">Смотрите также</h2>
				</div>
				<div class="bt-destinations">
					<?php foreach ( $related as $i => $d ) :
						$url = home_url( '/' . $cat['slug'] . '/' . $d['program'] . '/' );
					?>
						<a class="bt-destination" href="<?php echo esc_url( $url ); ?>">
							<div class="bt-destination__pic <?php echo ! empty( $d['image'] ) ? 'bt-destination__pic--photo' : ''; ?>">
								<?php if ( ! empty( $d['image'] ) ) : ?>
									<img src="<?php echo esc_url( BT_THEME_URI . '/assets/img/' . $d['image'] ); ?>" alt="<?php echo esc_attr( $d['name'] ); ?>" loading="lazy">
								<?php else : ?>
									<?php echo bt_icon( $d['icon'] ); ?>
								<?php endif; ?>
								<?php if ( ! empty( $d['flag'] ) ) : ?>
									<span class="bt-destination__flag" aria-hidden="true"><?php echo esc_html( $d['flag'] ); ?></span>
								<?php endif; ?>
							</div>
							<div class="bt-destination__body">
								<div>
									<div class="bt-destination__name"><?php echo esc_html( $d['name'] ); ?></div>
									<?php if ( ! empty( $d['sub'] ) ) : ?>
										<div class="bt-destination__sub"><?php echo esc_html( $d['sub'] ); ?></div>
									<?php endif; ?>
								</div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif;

	return true;
}

/**
 * Pretty URLs for individual tour pages: /{category}/{tour-slug}/ → pagename={category}&bt_tour_slug={slug}
 */
add_action( 'init', function () {
	add_rewrite_rule(
		'^(tours-catalog|excursions|abroad)/([^/]+)/?$',
		'index.php?pagename=$matches[1]&bt_tour_slug=$matches[2]',
		'top'
	);
	// One-time flush after adding/changing rules (bump version to re-flush).
	$rewrite_ver = '2';
	if ( get_option( 'bt_rewrite_version' ) !== $rewrite_ver ) {
		flush_rewrite_rules( false );
		update_option( 'bt_rewrite_version', $rewrite_ver );
	}
} );
add_filter( 'query_vars', function ( $vars ) {
	$vars[] = 'bt_tour_slug';
	return $vars;
} );

/**
 * Cool gradient picker per index — keeps tour cards visually varied.
 */
function bt_card_gradient( $i ) {
	$g = [
		'linear-gradient(135deg,#1E4FB8,#0E2A5E)',
		'linear-gradient(135deg,#0EA5E9,#0E2A5E)',
		'linear-gradient(135deg,#F59E0B,#E63946)',
		'linear-gradient(135deg,#10B981,#0E2A5E)',
		'linear-gradient(135deg,#8B5CF6,#1E4FB8)',
		'linear-gradient(135deg,#FFC93C,#F59E0B)',
	];
	return $g[ $i % count( $g ) ];
}
