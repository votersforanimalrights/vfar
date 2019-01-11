<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

error_reporting(-1);
define('WP_CONTENT_DIR', __DIR__ . '/wp-content');
$protocol = isset($_SERVER['HTTPS']) && filter_var($_SERVER['HTTPS'], FILTER_VALIDATE_BOOLEAN) ? 'https' : 'http';
define('WP_CONTENT_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . '/wp-content');

require( __DIR__ . '/vendor/autoload.php' );

if ( file_exists( __DIR__ . '/local.php' ) ) {
	define('DB_NAME', 'vfar');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', 'mypassword');

	/** MySQL hostname */
	define('DB_HOST', '127.0.0.1');
} else {
	require_once( __DIR__ . '/remote.php' );
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'kS2~mA{::&h@VWG3M:ug,9(R`*#(@N5J.VYuy9D:F*m@K! h+#>lK{l4Y=i}6at8');
define('SECURE_AUTH_KEY',  '/Y,*)MSTNk.pw6wlRDkNdqdjI..XZUB]/G)yx;|~t#kvCFgg]Ni/D)xw9M:Cp:V}');
define('LOGGED_IN_KEY',    '#2H%@K-z}_[Co?+S+ry3;M;N=sJ=.jgC.R_dpi8jqaCL#=mDM:+LdG491V^x;kRG');
define('NONCE_KEY',        'qaXEj]{|6F5UEe@8K_L,}3VUJy YSvXUaQC&+ Yrvpq}k>`!SF~W~Ag-)@GM&JIf');
define('AUTH_SALT',        '(6&3wBi77o*(3UWuL+~tap+.ShE6$]BSwg*Vjze_jW(?b|: {$Q7[>J-NV?PrY3f');
define('SECURE_AUTH_SALT', 'qux5OJGLJ2zr-u=qPD_p -dk]Noi)]A$BbzZN*V;6uD/&6|Uww|| Bi!nUPFWg=:');
define('LOGGED_IN_SALT',   '>qFy=}2.2x~q2vlhiT.D1fAm(z=4F_/^/&-O4:-s:b:77:pnkrc@v^w/!nypRm7,');
define('NONCE_SALT',       '0(U#wwPV<Y=ngL.BD&fOJ,J+p6nP_%z{^*lc@Wge!t!pj0D#fH*{Y8:/n*:Qa]ky');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
