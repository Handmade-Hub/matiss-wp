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
define('DB_NAME', 'matiss');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         '7c68sh_],9[vs<2}<^D2isjc,LKINp#FZB_c@Lt<I.MF6U)h{%]7WO]t+pigR8Af');
define('SECURE_AUTH_KEY',  'G{Ds+umh,N/?j$N{Byaxrrp.Q=c{E(+ /c[{,=HMcl[rSHTTM@jW[>b}!uu#0Z,M');
define('LOGGED_IN_KEY',    '2foZ}GC[Cv@ c`3{GRoh#n[g6WqC:EZe,8Rp pT0(9gv1jo3?a.upa{Q|_?kD7Z]');
define('NONCE_KEY',        '$d:_ca.3o7#QDeRGSpf~P3Fp9;Du>S1,=IR$+Hs[8<ndV$V`dG*B1:+DW(x+KRAH');
define('AUTH_SALT',        'yy-a `G|*lInTiOBQW~vtpL$-A!T>G/<8 B)y/T=SZ.)O&.0w$tLm_j8mO!Ubt/B');
define('SECURE_AUTH_SALT', 'GiP5o_QmL*%%0K5,nJW ].o_wip67{s5UD2ZBx[+SCMkqum(`mYu!VONB~1rjyW/');
define('LOGGED_IN_SALT',   'g&,[tQa.cenq 2LG/Lz7LS/cbB`cvdWtDa9+oC`NRlgo~Swqw4,w5 L5lgehltp:');
define('NONCE_SALT',       'i(93WruTiI]@fmpyUT0ziQa+CbU>s6#]3YBwQtV&H!%24hV4(8WD-tz66M{[q1>S');

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
