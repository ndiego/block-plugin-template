<?php
/**
 * Plugin Name: 	Block Plugin Template
 * Plugin URI: 		https://www.blockplugintemplate.com
 * Description: 	A description of the Block Plugin Template
 * Author: 			Nick Diego
 * Author URI: 		https://www.nickdiego.com
 * Version: 		1.0.0
 * Text Domain: 	bpt_textdomain
 * Domain Path: 	/languages
 * Tested up to: 	5.3
 *
 * The Block Plugin Template is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * You should have received a copy of the GNU General Public License
 * along with the Block Plugin Template. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package BlockPluginTemplate
 */

 // Exit if accessed directly.
 if ( ! defined( 'ABSPATH' ) ) {
 	exit;
 }

define( 'BPT_VERSION', '1.0.0' );
define( 'BPT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BPT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'BPT_PLUGIN_FILE', __FILE__ );
define( 'BPT_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'BPT_REVIEW_URL', 'https://wordpress.org/support/plugin/BlockPluginTemplate/reviews/?filter=5' );



if ( ! class_exists( 'BlockPluginTemplate' ) ) :
	/**
	 * Main BlockPluginTemplate Class.
	 *
	 * @since 1.0.0
	 */
	final class BlockPluginTemplate {
		/**
		 * This plugin's instance.
		 *
		 * @var BlockPluginTemplate
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Main BlockPluginTemplate Instance.
		 *
		 * Insures that only one instance of BlockPluginTemplate exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since 1.0.0
		 * @static
		 * @return object|BlockPluginTemplate The one true BlockPluginTemplate
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof BlockPluginTemplate ) ) {
				self::$instance = new BlockPluginTemplate();
				self::$instance->init();
				self::$instance->includes();
			}
			return self::$instance;
		}

		/**
		 * Throw error on object clone.
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'bpt_textdomain' ), '1.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'bpt_textdomain' ), '1.0' );
		}

		/**
		 * Include required files.
		 *
		 * @access private
		 * @since 1.0.0
		 * @return void
		 */
		private function includes() {
			require_once BPT_PLUGIN_DIR . 'includes/class-bpt-block-assets.php';
			require_once BPT_PLUGIN_DIR . 'includes/class-bpt-register-blocks.php';
            require_once BPT_PLUGIN_DIR . 'includes/get-dynamic-blocks.php';


			if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
				require_once BPT_PLUGIN_DIR . 'includes/admin/class-bpt-action-links.php';
			}
		}

		/**
		 * Load actions
		 *
		 * @return void
		 */
		private function init() {
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 99 );
			add_action( 'enqueue_block_editor_assets', array( $this, 'block_localization' ) );
		}

		/**
         * @TODO Figure this out
		 * If debug is on, serve unminified source assets.
		 *
		 * @since 1.0.0
		 * @param string|string $type The type of resource.
		 * @param string|string $directory Any extra directories needed.
		 */
		/*public function asset_source( $type = 'js', $directory = null ) {

			if ( 'js' === $type ) {
				return BPT_PLUGIN_URL . 'dist/' . $type . '/' . $directory;
			} else {
				return BPT_PLUGIN_URL . 'dist/css/' . $directory;
			}
		}*/

		/**
         * @TODO Figure this out
		 * Loads the plugin language files.
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'bpt_textdomain', false, basename( BPT_PLUGIN_DIR ) . '/languages' );
		}

		/**
		 * @TODO Figure this out
         * Enqueue localization data for our blocks.
		 *
		 * @access public
		 */
		public function block_localization() {
			if ( function_exists( 'wp_set_script_translations' ) ) {
				wp_set_script_translations( 'bpt_textdomain-editor', 'bpt_textdomain', BPT_PLUGIN_DIR . '/languages' );
			}
		}

		/**
        * @TODO Figure this out
		 * Is an AMP endpoint.
		 *
		 * @return bool Whether the current response will be AMP.
		 */
		/*public function is_amp() {
			return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
		}*/
	}
endif;

/**
 * The main function for that returns BlockPluginTemplate
 *
 * The main function responsible for returning the one true BlockPluginTemplate
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $sample_plugin = BlockPluginTemplate(); ?>
 *
 * @since 1.0.0
 * @return object|BlockPluginTemplate The one true BlockPluginTemplate Instance.
 */
function block_plugin_template() {
	return BlockPluginTemplate::instance();
}

// Get the plugin running. Load on plugins_loaded action to avoid issue on multisite.
if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	add_action( 'plugins_loaded', 'block_plugin_template', 90 );
} else {
	block_plugin_template();
}
