<?php
/**
 * Loads dynamic blocks for server-side rendering.
 *
 * @package BlockPluginTemplate
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register server-side code for individual blocks.
foreach ( glob( dirname( dirname( __FILE__ ) ) . '/src/blocks/*/index.php' ) as $bpt_block_logic ) {
	require_once $bpt_block_logic;
}
