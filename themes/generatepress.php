<?php
/**
 * GeneratePress compatibility class
 */

class JTCCK_GeneratePress extends JTCCK_Theme_Base {

	public function get_map() {
		return array(
			'generate_header' => 'header',
			'generate_footer' => 'footer',
		);
	}

}

new JTCCK_GeneratePress();
