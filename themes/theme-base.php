<?php
/**
 * Theme compatibility base class
 */
abstract class JTCCK_Theme_Base {

	/**
	 * Returns hooks/locations map
	 * Must be rewritten in each theme class if theme adds header/footer by hooks
	 *
	 * @return array
	 */
	public function get_map() {
		return array(
			'theme_header_action' => 'header',
			'theme_footer_action' => 'footer',
		);
	}

	public function __construct() {
		$this->init_hooks();
	}

	/**
	 * Initialize theme hooks
	 *
	 * @return void
	 */
	public function init_hooks() {

		$map = $this->get_map();

		if ( empty( $map ) ) {
			return;
		}

		foreach ( $this->get_map() as $hook => $location ) {
			add_action( $hook, array( $this, 'process_location' ), -999 );
		}
	}

	/**
	 * Process single location
	 *
	 * @return void
	 */
	public function process_location() {

		$hook     = current_filter();
		$map      = $this->get_map();
		$location = ! empty( $map[ $hook ] ) ? $map[ $hook ] : false;

		if ( ! $location ) {
			return;
		}

		$done = jtcck()->do_location( $location );

		if ( $done ) {
			remove_all_actions( $hook );
		}

	}

}