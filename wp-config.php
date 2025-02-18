<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
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
define( 'DB_NAME', 'news' );
//test
/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '1111' );

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
define( 'AUTH_KEY',         'kKX9]wXzZq5d54j,OL3X37{ygH$HTf.J|8:)y tj}L+{i>So!/#@XkQ>$4Q;2KuE' );
define( 'SECURE_AUTH_KEY',  'bR3XilIx+k|Q`PvIvM{odqGC%OVUFr[Yu7*dJ2x{(.#K,9z;*?w9jM-+<VPXZ,ES' );
define( 'LOGGED_IN_KEY',    '+d[Ci^Spj5D-7^oNcc!!~vWG^o1$z~3G(lUALG&nN`V$bOiW2-#(scTerQq7bO&>' );
define( 'NONCE_KEY',        'oCJ}vmKs.yfZ7?cDl,AH)EcL2YQ* uG`K0A~5S{27l2Kl,1/?6v;n#,U8ru>B#};' );
define( 'AUTH_SALT',        '2GmV2#|[gF?l#@`L[<nZwB<s{$~3Yk#=W@>Y7>F<?nFfy:!cE9Igi*(Le5APR~};' );
define( 'SECURE_AUTH_SALT', 'zdR|`#}mFIUIw!Jas a#J|~0Gmo ~Co0;yB$M$gnBD4A}=,IXe&3njq:Ce#8Z>zU' );
define( 'LOGGED_IN_SALT',   'QVO_ 5(VAK(fHid5Ph}R}zDXl0`i78?j]QRvcZWz;X)#t`Kd-gi$wQfRI2rg:L5W' );
define( 'NONCE_SALT',       ']=0!&R2Qv/vM0(B_C1VB`F;o va(.Qn?S5<Y#pU ~+3mcn`.KslYoAxWnLV)d`rf' );

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
