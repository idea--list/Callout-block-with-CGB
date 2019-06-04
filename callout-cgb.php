<?php
/**
 * Plugin Name: Callout Block Plugin made with CGB
 * Description: This is a remake of Callout Block Plugin made with CGB toolkit.
 * Author: Peter Bankuti
 * Version: 0.1
 * Text Domain: callout-cgb
 * Domain Path: languages
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
