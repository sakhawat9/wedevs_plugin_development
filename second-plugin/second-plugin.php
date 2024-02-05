<?php
/**
 * Plugin Name: Second Plugin
 * Description: This is second plugin. 
 * Version: 1.0.0
 * Author: Hasin Hayder
 * Author URI: http://hasin.me
 * Plugin URI: http://google.com
 */

// if (!class_exists('Second_Class')) {
class Second_Class {
    public function __construct() {
        add_action('init',array($this,'init'));
    }

    public function init() {
        add_filter('the_content', array($this,'osp_display_some_content'), 999);
    }

    public function osp_display_some_content($content) {

        $custom_content = '<div style="border: 1px solid #ddd; padding: 10px; margin: 20px 0;">';
        $custom_content .= '<p>This is custom content added under the post!</p>';
        $custom_content .= '</div>';

        // $content = $content . $custom_content;
        $content .= $custom_content;

        return $content;
    }
}

new Second_Class();
// }