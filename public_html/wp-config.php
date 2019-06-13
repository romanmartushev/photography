<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Prevent Wordpress from auto updating as we control the WP version from Composer
define( 'WP_AUTO_UPDATE_CORE', env('WP_AUTO_UPDATE_CORE', false) );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', env('DB_DATABASE', 'wordpress'));

/** MySQL database username */
define('DB_USER', env('DB_USERNAME', 'db_user'));

/** MySQL database password */
define('DB_PASSWORD', env('DB_PASSWORD', 'db_password'));

/** MySQL hostname */
define('DB_HOST', env('DB_HOST', 'localhost'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', env('DB_CHARSET', 'utf8'));

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', env('DB_COLLATION', 'utf8_unicode_ci'));

if (env('ENVIRONMENT', 'local') !== 'production') {
    /** this will limit the revisions so the database is always clean */
    define('WP_POST_REVISIONS', 0);
}
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
$authKeys = [
    'AUTH_KEY',
    'SECURE_AUTH_KEY',
    'LOGGED_IN_KEY',
    'NONCE_KEY',
    'AUTH_SALT',
    'SECURE_AUTH_SALT',
    'LOGGED_IN_SALT',
    'NONCE_SALT'
];
for ($i = 0; $i < count($authKeys); $i++) {
    define($authKeys[$i], env('WP_' . $authKeys[$i], $authKeys[$i]));
}
/**
 * Path configuration
 */
$http_s="https://";//we dont allow http anymore

define('WP_CONTENT_DIR', __DIR__ . '/wp-content');
define('WP_CONTENT_URL', $http_s . $_SERVER['SERVER_NAME'] . '/wp-content');
define('WP_SITEURL', $http_s . $_SERVER['SERVER_NAME'] . '/wp');
define('WP_HOME', $http_s . $_SERVER['SERVER_NAME']);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = env('DB_PREFIX', 'wp_');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
// Enable WP_DEBUG mode
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/wp/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

// Fix bug created by WP which converts all variables to strings and PHP 7.2 does less coercion
$_SERVER['REQUEST_TIME'] = (int) $_SERVER['REQUEST_TIME'];
