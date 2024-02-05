<?php
/**
 * Plugin Name: World Time
 * Description: Display World Time
 * Version: 1.0.0
 * Author: Hasin Hayder
 * Author URI: http://hasin.me
 * Plugin URI: http://google.com
 */

 class World_Time {

    public function __construct() {
        // Hook the function to add menu items to the admin bar
       add_action('init', array($this, 'init'));
    }

    // Function to initialize the plugin
    public function init() {
        // Add menu items to the admin bar
        add_action('admin_bar_menu', array($this, 'add_admin_bar_menu'), 999);
    }

    // Function to add menu items to the admin bar
    public function add_admin_bar_menu($admin_bar) {
        // Add a parent menu item with the label "World City Times"
        $admin_bar->add_menu(array(
            'id'    => 'world_city_times',
            'title' => 'World City Times',
            'href'  => '#',
            'meta'  => array('class' => 'world-city-times'),
        ));

        // Get the list of cities using the filter hook
        $cities = apply_filters('world_city_times_cities', array(
            'New York',
            'London',
            'Tokyo',
            'Sydney',
            // Add more cities as needed
        ));

        // Add child menu items for each city with random dummy times
        foreach ($cities as $city) {
            $dummy_time = $this->generate_dummy_time();
            $admin_bar->add_menu(array(
                'id'     => sanitize_title($city),
                'parent' => 'world_city_times',
                'title'  => $city . ' - ' . $dummy_time,
                'href'   => '#',
                'meta'   => array('class' => 'world-city-times-city'),
            ));
        }
    }

    // Function to generate a random dummy time
    private function generate_dummy_time() {
        // Generate a random hour and minute
        $hour   = mt_rand(0, 23);
        $minute = str_pad(mt_rand(0, 59), 2, '0', STR_PAD_LEFT);

        // Return the formatted time
        return $hour . ':' . $minute;
    }
}

// Instantiate the World_City_Times class
new World_Time();