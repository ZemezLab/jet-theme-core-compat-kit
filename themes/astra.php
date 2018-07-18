<?php
/**
 * Astra compatibility class
 */

class JTCCK_Astra extends JTCCK_Theme_Base {

	public function get_map() {
		return array(
			'astra_header'       => 'header',
			'astra_footer'       => 'footer',
			'astra_content_loop' => 'single, archive',
		);
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

		if ( 'astra_content_loop' === $hook ) {
			if ( is_singular() ) {
				$done = jtcck()->do_location( 'single' );
			} else {
				$done = jtcck()->do_location( 'archive' );
			}
		} else {
			$done = jtcck()->do_location( $location );
		}

		if ( $done ) {
			remove_all_actions( $hook );
		}

	}

}

new JTCCK_Astra();
