<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'morris' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '43f02b1cd5c3f2f6cc9fa2e4ab87c16f0615b13c' );
define( 'SECURE_AUTH_KEY',  '6e8e93c04309afe8ea3930a8fa53c1e873389c4d' );
define( 'LOGGED_IN_KEY',    'c22e53ec1b4196f2ef166b8167e3568923e1ceca' );
define( 'NONCE_KEY',        'bb4c105a3b0b6dc5c3e4640ad551318755497770' );
define( 'AUTH_SALT',        '3063f04120b28844404e50e1aef7b2a0158689a5' );
define( 'SECURE_AUTH_SALT', 'cb7ca5a4458faad9b913d84788714477a35829cc' );
define( 'LOGGED_IN_SALT',   '28bf0a8c878841ab2d44c918a516abf12cf58e98' );
define( 'NONCE_SALT',       '09310ef9ea65838bedb5b1f9f4ddc03c74a780f6' );
echo ('mamad');
/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
define( 'WP_MEMORY_LIMIT', '256M');
define('SITE_KEY', '6Lf1CmMpAAAAAJJSNY4nllZucYYqA31pbKqymTO7');
define('SECRET_KEY', '6Lf1CmMpAAAAAEOaAp2-X23LGBB_r_fL6FbACmwE');
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
