<?php
/**
 * Register Standard Blocks (Non-Dynamic).
 *
 * @package BlockPluginTemplate
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load registration for our blocks.
 *
 * @since 1.0.0
 */
class BlockPluginTemplate_Register_Blocks {


	/**
	 * This plugin's instance.
	 *
	 * @var BlockPluginTemplate_Register_Blocks
	 */
	private static $instance;

	/**
	 * Registers the plugin.
	 */
	public static function register() {
		if ( null === self::$instance ) {
			self::$instance = new BlockPluginTemplate_Register_Blocks();
		}
	}

	/**
	 * The Plugin slug.
	 *
	 * @var string $slug
	 */
	private $slug;

	/**
	 * The Constructor.
	 */
	public function __construct() {
		$this->slug = 'bpt';

		add_filter( 'block_categories', array( $this, 'register_custom_block_category' ), 10, 2 );
		add_action( 'init', array( $this, 'register_blocks' ), 99 );
	}

	/**
	 * Register a new custom block category for all blocks.
	 *
	 * @access public
	 */
	public function register_custom_block_category( $categories, $post ) {

		// Shortcut for the slug.
		$slug = $this->slug;

		return array_merge(
	        $categories,
	        array(
	            array(
	                'slug' => $slug,
	                'title' => __( 'Block Plugin Template', 'bpt_textdomain' ),
	                'icon'  => '',
	            ),
	        )
	    );
	}

	/**
	 * Register all standard blocks.
	 * Dynamic blocks should register themselves in their own php file.
	 *
	 * @access public
	 */
	public function register_blocks() {

		// Return early if this function does not exist.
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		// Shortcut for the slug.
		$slug = $this->slug;

		register_block_type(
			$slug . '/standard-block',
			array(
				'editor_script' => $slug . '-editor',
				'editor_style'  => $slug . '-editor',
				'style'         => $slug . '-frontend',
			)
		);
	}
}

BlockPluginTemplate_Register_Blocks::register();
