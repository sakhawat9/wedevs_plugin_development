<?php

namespace Fixolab\WpQrCode;

class Temporary_Data {
	
	public function __construct() {
		// add_action( 'init', array( $this, 'store_data' ) );

		add_action(
			'wp_head',
			function() {
				echo get_transient( 'wdac_api_data' );
			}
		);
	}

	public function store_data() {
		$data = array(
			'example_key' => 'example_value',
			'another_key' => 'another_value'
		);
	
		set_transient( 'wdac_api_data', $data, 60 );
	}
}