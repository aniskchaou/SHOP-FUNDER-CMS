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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'shop-funder' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'aoh4#[)vt6p)BGv5vZKHGB)~NNXg9tL->?u7qD6BOADx4Zwc!e~Ve[m5jl0RvHZ5' );
define( 'SECURE_AUTH_KEY',  '-<bSfA(YQkVgvn./wn&{MNs.xUha-/VT6 T2k%f`%UYtibDe)^du_6Bo/7O_u FF' );
define( 'LOGGED_IN_KEY',    ')UqYdig3fYfF;>ooC|5f`4(-py!qKp?(|r1K2my^wBzaQCl[*v`D8rpT| >YpIDZ' );
define( 'NONCE_KEY',        'b/(AEs}Vf3JAz-F,FB~(+jV3;0LVhm]Mg=$y@z+Bhpzl8(z$_U2VY^~awPlQdxBM' );
define( 'AUTH_SALT',        '#]~L9~j9ZQ?m.z==N_a8qYdHN=UMj>[?Q^va~CAtYP%yyut`+tfqz;z|79@[P[zu' );
define( 'SECURE_AUTH_SALT', 'GghN{Cz Ie{1q##!N#&coPzErfHcAJQZR=$5kRTW6 GG(2ahDG{$o=;t>LCP#uZD' );
define( 'LOGGED_IN_SALT',   '=~-tL.}OAiC0C`[A2;S{KoLiw7[_DWp*$0,Kd@I1s$bk?)E#Q)[t$bW3tzmG9S<0' );
define( 'NONCE_SALT',       ',u|DOXy<>Rn0ij8lp_0kTQ7E}+7hQWe,Ii+z$DXUCS}EYBn*Iy~Qh!yCk5eA1(Dq' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
