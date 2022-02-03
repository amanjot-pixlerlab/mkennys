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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define('DB_NAME', 'mkennys');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost:3307');

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
define('AUTH_KEY',         '*)_Ti?j/L|B^[Daw]`Xk3Q5!s|,Dty`/}R8s2~<msFU^=e_qauv #&vz];cQFqW>');
define('SECURE_AUTH_KEY',  '5*i_2l_iDXJhOA|fI@cX.C,}eE|TDv[)&ota#P[LC(mC|e1gH%.&oG]YRC;]?d44');
define('LOGGED_IN_KEY',    'mIE#f1r`FMB]%/|w;ywryx?31jmhN$+-$PM:<>j:pj={)|z3+_e346Ps-T@0G7|2');
define('NONCE_KEY',        'f4-*>%Pu@.z8;?Jtf^CRU8.D(B3F)kz%`$JMs(:joRWm(,]-RzP5D8Y.sIYk_>gs');
define('AUTH_SALT',        '&$}.JL(bV93;4$7zHS;u9K[IX[=69<Z?& /C,L*%)4.n*WOpnp:P{JFh- |OoIe1');
define('SECURE_AUTH_SALT', '>9Cy9h!17(? X7Z]-eI5B9#~C<I`K;BL!=pQ@#p-#OUW=2:K}LvffMZ7YjvpL%Zc');
define('LOGGED_IN_SALT',   '!LDgc=($#_<~xp3[6[hMnrg^ZD(kO8vyrnij&6X1ZpWD:^WKj32z).Z;V9V|pW#k');
define('NONCE_SALT',       '(Vq2;.Wkrs`hv}qf5^q]6dr,D<SjI/|$#(;DDwOrd3uKm!gW_Cm;Hw$OPtYgZaPJ');

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
define('WP_DEBUG', false);  

define('WP_MEMORY_LIMIT', '768M');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/** Disable File Editor */
define( 'DISALLOW_FILE_EDIT', false );

define('WP_HOME','http://localhost/mkennys/');
define('WP_SITEURL','http://localhost/mkennys/');

@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system

