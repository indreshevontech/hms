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
define( 'DB_NAME', 'healing_touch_hospital' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'admin' );

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
define( 'AUTH_KEY',         'Nh+Zl{ qCNYu^AD1:r%BDDbPJOQS1)_HDtZ$A]XY^SpZ*%gpxl[j.z!u@dt6 +(2' );
define( 'SECURE_AUTH_KEY',  '8Ud&rtsbb;&1OGen3T,@u>r;?R7(}P?+3*|rv#ok;cA-([A^;K~}H@[[*5XIGLnt' );
define( 'LOGGED_IN_KEY',    '$6@0pCY_ypTF}MFN{h9;>:Oi!^:dcxg2/bm1,+w.JC`r/nt5ei7wC<QA>WIRk- k' );
define( 'NONCE_KEY',        'n:!}xgJK-QFRj5FNa2%N~l_Kv872#xby-k|~Zw9ry3G/1XB~3P^*3LAT.[i;Yr;=' );
define( 'AUTH_SALT',        'gn|sEH~+Us&_lyKW$[$7]*Mm4=~ }bp.?-7AQ?~*[g<[oX!]6`i}kVSTrt<UYDQV' );
define( 'SECURE_AUTH_SALT', '4jJ1,0A+~-;dAgw1%axco9!H*ltNzx7iSL;kv}lmy:%3BVJ2jpT;W)2[LZ-jVK_V' );
define( 'LOGGED_IN_SALT',   't7db,>Wd8cFy w>~cjegA@?Qe.mkgDO29[PxwYmfEG}Z^f$.> b(V5o2M|+jit1,' );
define( 'NONCE_SALT',       '&:rAQ@ADQa~9<pF)pQK{jsI54:J9@tzu![YS=1+;SYHPCBjkkc#y*8:;b*Q@v;#=' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'hth_';

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
define( 'WP_DEBUG', false );
define( 'FS_METHOD', 'direct');
define( 'WPMS_ON', true );
define( 'WPMS_SMTP_PASS', 'your_password' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
