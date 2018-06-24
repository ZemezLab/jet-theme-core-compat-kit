<?php
/**
 * OceanWP compatibility class
 */

class JTCCK_OceanWP extends JTCCK_Theme_Base {

	public function get_map() {
		return array(
			'ocean_header' => 'header',
			'ocean_footer' => 'footer',
		);
	}

}

new JTCCK_OceanWP();
