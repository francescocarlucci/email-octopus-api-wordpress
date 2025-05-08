<?php
/*
 * Plugin Name: WP EmailOctopus API
 * Description: An extensible integration framework for the EmailOctopus API.
 * Version:     0.1
 * Author:      Francesco Carlucci
 * Author URI:  https://francescocarlucci.com
 */

defined( 'ABSPATH' ) || exit; // prevent direct access

define( 'EMAILOCTOPUS_API_LOGGING', false );
define( 'WP_EMAILOCTOPUS_API_CLASSES_PATH', plugin_dir_path(__FILE__) . 'src/' );

require_once( WP_EMAILOCTOPUS_API_CLASSES_PATH . 'EmailOctopusAPI.class.php' );

/*
 * Load just the classes you need based on your implementation
 */
require_once( WP_EMAILOCTOPUS_API_CLASSES_PATH . 'EmailOctopusContact.class.php' );

