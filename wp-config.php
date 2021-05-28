<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'shareavi_wp397' );

/** MySQL database username */
define( 'DB_USER', 'shareavi_wp397' );

/** MySQL database password */
define( 'DB_PASSWORD', 'pS6p]7S2)9' );

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
define( 'AUTH_KEY',         '0iwlwbbzgvcgkh78ljc5elg6kzsgwcqeupupho1rvou9cxbedrlq7nlbqoqy3wnz' );
define( 'SECURE_AUTH_KEY',  'xxl1u5vrm1dexdzg2a7escybmzfvenp3iat1svurctfxhnia5ais3f8mjyuktpp3' );
define( 'LOGGED_IN_KEY',    'yajckohljiocbw5rllsaj0uw1g7zunog5iglttnohgvb56z5bm1ncgwljp8ajkjw' );
define( 'NONCE_KEY',        'kuajayf9tn5xsz40ixnwqx1bmqhk8rl2ahtnp1fedjc5j2m9fgcvjbxtgqa3shu5' );
define( 'AUTH_SALT',        'bprbmunu7ykivnljzhsdeorrf7xhtwericpdbqvgli2mt3yroprtkhespc63tkku' );
define( 'SECURE_AUTH_SALT', 'bx0uunpp82jpzdpd7exzcszdmmrawwbkgbtn4lytukloemln3lu6uptw8awyrket' );
define( 'LOGGED_IN_SALT',   'puuhai80s7kycxjgjynjodituwbj10jtfp8ncmyptzlk4b47h9xeooiz55tk5cev' );
define( 'NONCE_SALT',       'lrjvhygpyrst1itp3hsszsgxnu63bifzfkgwvu0zrwcgmseerid0lniopm6vyqyq' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpdf_';

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
