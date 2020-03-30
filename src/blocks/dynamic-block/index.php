<?php
/**
 * Server-side rendering of the `dynamic-block` block.
 *
 * @package BlockPluginTemplate
 */

 /**
  * Renders the block on server.
  *
  * @param array $attributes The block attributes.
  *
  * @return string Returns the block content.
  */
 function bpt_render_dynamic_block_block( $attributes ) {

}

/**
 * Registers the block on server.
 */
function bpt_register_dynamic_block_block() {
	// Return early if this function does not exist.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	// Load attributes from block.json.
	ob_start();
	include BPT_PLUGIN_DIR . 'src/block/dynamic-block/block.json';
	$metadata = json_decode( ob_get_clean(), true );

	register_block_type(
		'bpt/dynamic-block', /* rename */
		array(
			'attributes'      => $metadata['attributes'],
			'render_callback' => 'bpt_render_dynamic_block_block',
		)
	);
}
add_action( 'init', 'bpt_register_dynamic_block_block' );
