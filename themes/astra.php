<?php
/**
 * Astra compatibility class
 */

class JTCCK_Astra extends JTCCK_Theme_Base {

	public function get_map() {
		return array(
			'astra_header' => 'header',
			'astra_footer' => 'footer',
		);
	}

}

new JTCCK_Astra();
