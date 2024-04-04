<?php

namespace Nahid\WpQrCode;

class Site_Wide_Data {
	public function __construct(){
		add_action(
			'wp_head',
			function() {
				echo 'Autoloaded file';
			}
		);
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		$this->store_installation_timestamp();
		$this->store_plugin_version();
	}
 
	public function store_installation_timestamp() {
		$installed = get_option( 'fqc_installed' );
 
		if ( ! $installed ) {
			update_option( 'fqc_installed', time() );
		}
	}

	public function store_plugin_version() {
		update_option( 'fqc_version', '1.0.0' );
	}
}