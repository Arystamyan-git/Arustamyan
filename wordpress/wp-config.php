<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'kid_world' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'Admin' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'giveme5' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Qepc$P3rVFXIu3`LtKl-!p0C+y@5;s-g}}m5{DQ:y1gzJl_iO%wfoaz!WBiww+ R' );
define( 'SECURE_AUTH_KEY',  ' =<_X{fG w>*5YF%L[`,Y/TMjJ7XG/]wF{;{z!;:NUIqeov7pbF^JrCH#Bf=/S|E' );
define( 'LOGGED_IN_KEY',    'F~;Po(w6`M`$+s4b9Ts@@{2mb->`/o<1/}0.O IMwx:CU/9iYdvZ1S!!w#ZOVCo4' );
define( 'NONCE_KEY',        'rpK+sYGft;j8gb=[Jm#FP_Xy/H3&E0JI@@1h`$^rW/[=>2#rg1{K{ls`O,{?eBqx' );
define( 'AUTH_SALT',        ';g;zZO0 `P:6G~1)@y%!/9rYgnpO90x=ZC{v^kwV_YDQy8@T.gRhh7Ugihx-D+0Q' );
define( 'SECURE_AUTH_SALT', 'BDHSZ1yC;Mb9?eH:Z{osU9U87&G#jxUL@rx!JB*B&FLaPyyrdlubl%rvI-0i9+-&' );
define( 'LOGGED_IN_SALT',   '3,KJ|m^FC4R)Vd*L)HQVuO^i7qE#>Nq.z,La~1I!uMRH+N01L}]FSpW<3Y#Q)]%G' );
define( 'NONCE_SALT',       'L:sLvfyuoW<Z<n[A>L|wxmL7coJyb|m 2p [nqql(*9e+6<;gOc[IEC*D4O;1}[H' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 *
 * В процессе установки указанный префикс добавляется к именам таблиц базы данных.
 * Если изменить это значение после установки WordPress, то сайт снова перейдёт
 * в режим установки.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
