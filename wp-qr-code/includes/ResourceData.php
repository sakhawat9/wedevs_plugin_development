<?php
namespace Fixolab\WpQrCode;

class Resource_Data {
    public function __construct() {
        add_action( 'add_meta_boxes', array($this, 'add') );
        add_action( 'save_post', array($this, 'save') );

        add_action( 'wp_head', function() {
            echo get_post_meta( get_the_ID(), 'instructor_name', true );
        } );
    }

    public function add() {
        add_meta_box (
            'wedevs_academy_custom',
            'weDevs Academy - Custom',
            array($this, 'show'),
            array('post'),
        );
    }
}
