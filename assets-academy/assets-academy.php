<?php
/*
 * Plugin Name:       Assets Academy
 * Plugin URI:        https://example.com
 * Description:       This is a plugin for assets management examples.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            SH Shakib
 * Author URI:        https://sakhawat.vercel.app/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

 class Assets_Academy {
    function __construct() {
        add_action( 'init', [$this, 'init'] );
    }

    function init() {
        add_action('wp_enqueue_scripts', [$this, 'load_assets'] );
    }

    function load_assets() {
        $assets_directory = plugin_url('assets/', __FILE__);
    }
 }

 new Assets_Academy();