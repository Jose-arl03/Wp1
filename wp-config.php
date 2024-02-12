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
define( 'DB_NAME', 'Wp-bd' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '/F4:m 7)PYflAzoA5Hjn|_tR%,aW|99ji_X(RT_hjCT/<l|Z|fWZNj~,4}(+=&6M' );
define( 'SECURE_AUTH_KEY',  '9;Jj~M)S*ip#6B9e$sE;w>aL>!dMri%{:A)8&~7-4$t,/)zV/rzc2D}oocPE<}-%' );
define( 'LOGGED_IN_KEY',    '-F};ufA`Nnim}6:88W *0+&@vj9(+G/9eqeyc~GUfFeVk]+7:eh=p~<zPxqXrC<*' );
define( 'NONCE_KEY',        'nncgHWe1-&3[[bLySobn1QV1-?@}cY.n.m[^hmoE+Mk_W9Piz0C^PkY),|k+?XEC' );
define( 'AUTH_SALT',        'NrPIm rlIgI^,$>J*M}G=QZ{HpyIYb,ojYF6&{IiGszo.LCl6w>2^)B<Sd^yNFC^' );
define( 'SECURE_AUTH_SALT', 'w^F5Umh[[ULkQ]dyCMeo%]^qUJF;%6=L2i%Bn0NUYUn`cH5!bmSVm34treVw]hZ$' );
define( 'LOGGED_IN_SALT',   'f7?=K39]>~F5>YW|+;|g6IyQ1uOff!%*h~Qld57bk$,2aFI_3<rYjG:XFE6iQtr)' );
define( 'NONCE_SALT',       'SprZ/:TbYYa^2e~CZ;c4qRi*Zc#gKEH3ijFm7qHbA!R3~G22blPJpAu}W5y[LEw-' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
