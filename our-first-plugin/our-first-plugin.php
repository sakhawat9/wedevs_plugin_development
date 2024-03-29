<?php
/**
 * Plugin Name: Our First Plugin
 * Description: This is our first plugin. 
 * Version: 1.0.0
 * Author: Hasin Hayder
 * Author URI: http://hasin.me
 * Plugin URI: http://google.com
 */

// if (!class_exists('Our_First_Class')) {
class Our_First_Class {
    public function __construct() {
        add_action('init',array($this,'init'));
    }

    public function init() {
        add_filter('the_content', array($this,'change_content'));
        add_filter('the_title', array($this,'change_title'));
        add_filter('excerpt_length', array($this,'change_excerpt_length'));
    }

    public function change_content($content) {

        // if(!is_page()){
        //     return $content;
        // }

        $id = get_the_ID();

        $custom_content = '<div style="border: 1px solid #ddd; padding: 10px; margin: 20px 0;">';
        $custom_content .= '<p>This is custom content added under the post!</p>';
        $custom_content .= '<p>Post ID: ' . $id . '</p>';
        $custom_content .= '</div>';

        // $content = $content . $custom_content;
        $content .= $custom_content;

        return $content;
    }

    function change_title($title) {
        if(is_admin()) {
            return $title;
        }
        $title = $title . "!!!!";
        return $title;
    }

    function change_excerpt_length($number) {
        return 20;
    }
}

new Our_First_Class();
// }