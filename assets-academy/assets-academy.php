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

 include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 class Assets_Academy {
     function __construct() {
         add_action('init', [$this, 'init']);
     }
 
     function init() {
         add_action('wp_enqueue_scripts', [$this, 'load_assets']);
         add_action('admin_enqueue_scripts', [$this, 'load_admin_assets']);
     }
 
     function load_admin_assets($hook) {
         $asset_directory = plugins_url('assets/', __FILE__);
         if ($hook == 'plugins.php') {
             wp_enqueue_script('assets-academy-admin', $asset_directory . 'js/admin.js', [], '1.0', true);
         }
     }
 
     function load_assets() {
         $plugin_data = get_plugin_data(__FILE__);
         $version = $plugin_data['Version'];
         // $asset_directory = plugin_dir_url(__FILE__) . 'assets/';
         $asset_directory = plugins_url('assets/', __FILE__);
         //degegister jquery
         // wp_deregister_script('jquery');
         // wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.0.min.js', [], '3.6.0', true);
         // wp_enqueue_style('assets-academy-style', $asset_directory . 'css/style.css', [], '1.0');
         wp_enqueue_script('assets-academy-main', $asset_directory . 'js/main.js', [], $version, true);
         wp_enqueue_script('assets-academy-secondary', $asset_directory . 'js/secondary.js', [], $version, true);
         if (is_page('contact')) {
             wp_enqueue_script('assets-academy-contact', $asset_directory . 'js/contact.js', [], "1.0", true);
         }
 
         $data = [
             'course'=>'WordPress Plugin Development',
             'instructor'=>'Hasin Hayder'
         ];
         wp_localize_script('assets-academy-main', 'course', $data);
 
         wp_enqueue_script('assets-academy-comic', $asset_directory . 'js/comic.js', ['jquery'], '1.0', true);
     }
 }
 
 new Assets_Academy();
 
 // <div id="xkcd" number="936"></div>