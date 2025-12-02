<?php
define( 'WP_CACHE', true );

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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'u588984589_3xtkj' );

/** Database password */
define( 'DB_PASSWORD', '5!8.Qx8MVApPNRp' );

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
define( 'AUTH_KEY',          'Pi(|-fC[Q7rQa2!c#{IgDG{d> DsyYAft+Xe_SKA9P:JqV|NRJEnjC0wQZOA&<oY' );
define( 'SECURE_AUTH_KEY',   'W7? ^dGosz0{o2u-krX_@n^hvj3oKA{(:[U@1K/$(c.~^R$:<waI8E#0;os;m{xi' );
define( 'LOGGED_IN_KEY',     '|%dA|Ku}t?AIw= sQ J&g:=VzmHm7/qv{y>rLb>Mos2}!ji,omZtWfUZF.e*sgK:' );
define( 'NONCE_KEY',         'ts=P+[9-X@awRN4jyN@M(<s,C_r/RNbnYT<-%9}%re /*T(Bll6F5CQ5VPgVLOdk' );
define( 'AUTH_SALT',         'vW7)4hzjsmduymlOmF#H`E$/J??&>(>i]~ArM?8<ln&%41CO+T3MMr4v-7H$H3oA' );
define( 'SECURE_AUTH_SALT',  ' @Rw-JrEBClb>]yu1#Yl4xv>Iw<&GG%[W7J`[Bce~5~lLJ;lAX{XPe4:9|Wc81Tt' );
define( 'LOGGED_IN_SALT',    'E9TIWuI2gstfH!)w2Cqikpv4ONQbG:3iqQJxIJualm:og, kxKIN^cm!l(L}w|=T' );
define( 'NONCE_SALT',        'Y0RGNE! -y3/y;<$;.>F$ewQ9@Js|qEitF!={}e_I4O/]Sj5Db/3(O_}(OC&c^7<' );
define( 'WP_CACHE_KEY_SALT', '5?8uy97k_8]%MtpM$:GH.q}`~4&p,H`Q::(tKd7paukstk-fEcl%W@%b96}z=m??' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
