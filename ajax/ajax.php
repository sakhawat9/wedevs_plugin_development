<?php 
/**
 * Plugin Name: Ajax
 * Description A simple plugin to demonstrate how to use AJAX in WordPress.
 * Version: 1.0
 * Author: Shakib
 * Author URL: http://sakhawat.vercel.app
 */

 class Ajax_examples {
    public function __construct(){
        add_action('init', [$this, 'init']);
    }

    function init(){
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_ajax_contact', [$this, 'contact']);
        add_action('wp_ajax_backup', [$this, 'backup']);
        add_action('wp_ajax_comic', [$this, 'comic']);

        add_action('wp_ajax_nopriv_backup', [$this, 'backup']);
    }

    function enqueue_scripts() {
        //tailwindcss cdn
        // wp_enqueue_script('tailwindcss', '//cdn.tailwindcss.com', [], '1.0');

        $ajax_url = admin_url('admin-ajax.php');
        $nonce = wp_create_nonce('contact');
        $comic_nonce = wp_create_nonce('comic');

        if(is_page('contact')){
            wp_enqueue_style('ajax-css', plugin_dir_url(__FILE__) . 'assets/css/form.css');
            wp_enqueue_script('ajax-js', plugin_dir_url(__FILE__) . 'assets/js/main.js', ['jquery'], '1.0', true);
            wp_localize_script('ajax-js', 'ajax_object', [
                'ajax_url' => $ajax_url,
                'nonce' => $nonce,
                'comic_nonce' => $comic_nonce
            ]);
        }
        
    }

 }

 new Ajax_examples();