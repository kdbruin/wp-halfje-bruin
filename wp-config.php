<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
// ** Set proper URL location ** //
define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/Halfje-Bruin/wp');
define('WP_HOME', 'http://' . $_SERVER['SERVER_NAME'] . '/Halfje-Bruin');

// ** Relocate wp-content directory ** //
define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/Halfje-Bruin/wp-content');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'halfje_bruin');

/** MySQL database username */
define('DB_USER', 'halfje_bruin');

/** MySQL database password */
define('DB_PASSWORD', 'hume6duz');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/* * #@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'j5iB.MWW{<(Q0m-|%k-bJ)!h&^8|pihkr?%Y,r* Ge{$4j>a+=B8N<y<HP0l8SRO');
define('SECURE_AUTH_KEY', '`u1rk5dJa/3g]^i| }wX^tQM$pOb{SvGI2nMncESWjDdpmeUZ-~@QB dCGqPr<*i');
define('LOGGED_IN_KEY', 'y9h)?3_sBYIVh.MJEN.6[+$_0tvH-r}U~&QGY(M!A|E=ziWi:|?{ fv.22p)<tWS');
define('NONCE_KEY', 'g.LIX`*oV&:,60mIa-gjuNwcjw445%|j>IsoDAB`]kgXl&krb@`+7wGf)LL[G3[&');
define('AUTH_SALT', ')RfE4qr%iO(NI]sxcBRv-Osx7U&$-2#IZ($]UjXxa59;8AfG$r+pyHJwa1_0b@5<');
define('SECURE_AUTH_SALT', 'L:019/F__IYG;}%ca-tgl(c!t#jY_/(b$;4<#DoQKU<-MuSF4K%V*p`tws(_[&<B');
define('LOGGED_IN_SALT', '4eLB9PW4KCUARm|TWWh1qw!I(TUaHzR<rF<.>PC4ZCqT<.sPO:qd|iU.~$}d(67V');
define('NONCE_SALT', '.nZ@h.iECODRb+F-.O-!sJpWFE7Fv455.7B-]{WL<0FDmo(6+OBip&9qIPugRXI>');

/* * #@- */

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'nl_NL');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/**
 * Disable all core updates
 */
define('WP_AUTO_UPDATE_CORE', false);

/**
 * FTP details for auto upgrading
 */
define('FS_METHOD', 'direct');

/**
 * Disable file editing
 */
define('DISALLOW_FILE_EDIT', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
