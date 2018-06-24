<?php
/**
 * Plugin Name: JetThemeCore Compatibility Kit
 * Plugin URI:  https://crocoblock.com/
 * Description:
 * Version:     1.0.0
 * Author:      Zemez
 * Author URI:  https://zemez.io/wordpress/
 * Text Domain: jtcck
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// If class `JTCCK` doesn't exists yet.
if ( ! class_exists( 'JTCCK' ) ) {

	/**
	 * Sets up and initializes the plugin.
	 */
	class JTCCK {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * Holder for base plugin path
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_path = null;

		/**
		 * Sets up needed actions/filters for the plugin to initialize.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'init' ), -999 );
		}

		/**
		 * Manually init required modules.
		 *
		 * @return void
		 */
		public function init() {

			$current_theme = wp_get_theme();
			$template      = get_template();

			$themes = array(
				'oceanwp',
				'astra',
				'generatepress',
			);

			if ( in_array( $template, $themes ) ) {
				require $this->plugin_path( 'themes/theme-base.php' );
				require $this->plugin_path( 'themes/' . $template . '.php' );
			}

		}

		/**
		 * Try to do theme core location
		 */
		public function do_location( $name = 'header' ) {

			if ( ! function_exists( 'jet_theme_core' ) ) {
				return false;
			}

			if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
				return false;
			}

			$done = jet_theme_core()->locations->do_location( $name );

			return $done;

		}

		/**
		 * Returns path to file or dir inside plugin folder
		 *
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_path( $path = null ) {

			if ( ! $this->plugin_path ) {
				$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
			}

			return $this->plugin_path . $path;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

if ( ! function_exists( 'jtcck' ) ) {

	/**
	 * Returns instanse of the plugin class.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	function jtcck() {
		return JTCCK::get_instance();
	}
}

jtcck();
