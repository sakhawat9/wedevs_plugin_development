<?php
/**
 * Plugin Name: Fantastic QR Code
 * Description: Display a QR code for the current page
 * Version: 1.0.0
 * Author: Hasin Hayder
 * Author URI: http://hasin.me
 * Plugin URI: http://google.com
 */

 require_once __DIR__ . '/vendor/autoload.php';

class FQC_Qr_Code {
    public function __construct() {
        new Fixolab\WpQrCode\Site_Wide_Data();
        
        new Fixolab\WpQrCode\Resource_Data();

        new Fixolab\WpQrCode\User_Data();

        new Fixolab\WpQrCode\Temporary_Data();
        
    }

}

new FQC_Qr_Code();