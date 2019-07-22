<?php
/**
 * Page Builder Framework compatibility class
 */

class JTCCK_Page_Builder_Framework extends JTCCK_Theme_Base {

	public function get_map() {
		return array(
			'wpbf_header' => 'header',
			'wpbf_footer' => 'footer',
		);
	}

}

new JTCCK_Page_Builder_Framework();
