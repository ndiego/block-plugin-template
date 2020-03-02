<?php
/**
 * Add links to SamplePlugin on the plugins admin page.
 *
 * @package BlockPluginTemplate
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Generates a link.
 */
class BlockPluginTemplate_Action_Links {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Plugin row meta links
	 *
	 * @param array  $plugin_meta An array of the plugin's metadata.
	 * @param string $plugin_file Path to the plugin file.
	 * @return array $input
	 */
	public function plugin_row_meta( $plugin_meta, $plugin_file ) {

		// Check if this is defined.
		if ( ! defined( 'BPT_PLUGIN_BASE' ) ) {
			define( 'BPT_PLUGIN_BASE', null );
		}

		if ( BPT_PLUGIN_BASE === $plugin_file ) {
			$row_meta = array(
				'review' => '<a href="' . esc_url( BPT_REVIEW_URL ) . '" aria-label="' . esc_attr( __( 'Review SamplePlugin on WordPress.org', 'sample-plugin-textdomain' ) ) . '" target="_blank">' . __( 'Leave a Review', 'sample-plugin-textdomain' ) . '</a>',
			);

			$plugin_meta = array_merge( $plugin_meta, $row_meta );
		}

		return $plugin_meta;
	}
}

new BlockPluginTemplate_Action_Links();
