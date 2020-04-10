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
if(file_exists(dirname(__FILE__). '/local.php')) {

	// Local Database Settings
	/** The name of the database for WordPress */
	define( 'DB_NAME', 'local' );

	/** MySQL database username */
	define( 'DB_USER', 'root' );

	/** MySQL database password */
	define( 'DB_PASSWORD', 'root' );

	/** MySQL hostname */
	define( 'DB_HOST', 'localhost' );
} else {

	// Live Database settings
	/** The name of the database for WordPress */
	define( 'DB_NAME', 'codetos3_universityData' );

	/** MySQL database username */
	define( 'DB_USER', 'codetos3_wp124' );

	/** MySQL database password */
	define( 'DB_PASSWORD', '123456' );

	/** MySQL hostname */
	define( 'DB_HOST', 'localhost' );
}


/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'SLfgT60FWic5Za7U5nZ2FMTclsgtWbNRF0QWjO38VdfwumAOPzSv1byiwBiLU6j1Roc5L9f7g0hthwWpVqwA4A==');
define('SECURE_AUTH_KEY',  'dFqmNosSy8mSk2GXDKEkNvm7IDFH8It5Rk6NeFsRTioNmGWIdlB9cZ02KHXFlOj7BMuOgXW+Jv0zT+8mRVnNIQ==');
define('LOGGED_IN_KEY',    'yjyO0P0+83gPSUvWi8tbu7p0BBdQ/92FTubnmgyKfKVr1JZJ4gPIOFy4wefpcxSj7xktvblEuK+v7DdQ8G7c9Q==');
define('NONCE_KEY',        'Q6eeK/SPYYBQOVtZlDj1Opy/jB62AnszDeib9W/io3CPR9WhQK7LhyyifKDlYMhl8sz9qVI7blZ+Pv1AqxwmWg==');
define('AUTH_SALT',        'DjLaup0vLVOW/56uPs//d4tm9nnjAqP01CxeISO+b08Nw8pKc+RRVtr7X+C1JvxHWDPb+yFY/GaF9hKLqeyQfw==');
define('SECURE_AUTH_SALT', '560PyeHbn1yqU6N1Pbdfalgz8u+nGF1/YPd1MukPqp011lxJQA9k6NJ1qmIW0DQ1Slcrfoiuo4Vs4/V1thpTzA==');
define('LOGGED_IN_SALT',   'p5iccX5a7XwyXwEps8TSrM0GZIHR2zfLNh5RP0jrxA134L0K5mLCg0mJbmjMJ+dOfOpMVYf4pQgIj1f/rFagIQ==');
define('NONCE_SALT',       'PW/hw1nN4WxmAyM4CJNuH/6IvAXO++Cn+XtzCpE3dTnrTWC158/QF4dEyFjBCDAz+ZJyMnD0QlcxVrjjr9k4Wg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
