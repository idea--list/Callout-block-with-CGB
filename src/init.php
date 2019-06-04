<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function callout_cgb_load_td(){
	$path_to_translation = basename(dirname(__FILE__,2)) . '/languages/';
	//var_dump($path_to_translation);
	load_plugin_textdomain('Callout-block-with-CGB', false, $path_to_translation );
}
add_action('plugins_loaded', 'callout_cgb_load_td');

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function callout_cgb_cgb_block_assets() { // phpcs:ignore
	// Register block styles for both frontend + backend.
	wp_register_style(
		'callout_cgb-cgb-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		array( 'wp-editor' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);

	// Register block editor styles for backend.
	wp_register_style(
		'callout_cgb-cgb-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'callout-cgb/rtext', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'callout_cgb-cgb-style-css',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'callout_cgb-cgb-block-editor-css',
		)
	);
	
		
}

// Hook: Block assets.
add_action( 'init', 'callout_cgb_cgb_block_assets' );

function callout_add_gutenberg_scripts() {
	// Register block editor script for backend.
	wp_enqueue_script(
		'callout-cgb-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		'1.0.9', // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	//load script translation jsons
	$path_to_translation = plugin_dir_path( dirname(__FILE__)) . 'languages';
	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'callout-cgb-js', 'Callout-block-with-CGB', $path_to_translation );
	}
}

add_action( 'enqueue_block_editor_assets', 'callout_add_gutenberg_scripts' );
