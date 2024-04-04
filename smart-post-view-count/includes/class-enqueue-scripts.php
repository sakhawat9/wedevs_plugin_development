<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue scripts class
 *
 * @since 1.0
 */
class SPVC_Enqueue_Scripts
{
    public function __construct()
    {
        add_action('init', [$this, 'init']);
    }

    /**
     * Initialization.
     */
    public function init()
    {
        add_action('wp_enqueue_scripts', [$this, 'spvc_enqueue_styles']);
    }

    /**
     * Enqueue frontend styles.
     */
    public function spvc_enqueue_styles()
    {
        // Get plugin version
        $plugin_data = get_file_data(__FILE__, array('Version' => 'Version'));
        $version = $plugin_data['Version'];

        // Define asset directory URL
        $asset_directory = SPVC_DIR_URL . 'assets/';

        // Enqueue main style for frontend
        wp_enqueue_style('spvc-main', $asset_directory . 'css/style.css', array(), $version, 'all');
    }

}
new SPVC_Enqueue_Scripts;
