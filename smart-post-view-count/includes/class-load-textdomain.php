<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Load textdomain class
 *
 * @since 1.0
 */
class SPVC_Load_Textdomain
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
        add_action('plugins_loaded', [$this, 'spvc_load_textdomain']);
    }
    /**
     * Load plugin text domain for translation.
     */
    public function spvc_load_textdomain()
    {
        load_plugin_textdomain('smart-post-view-count', false, dirname(SPVC_PRO_BASENAME) . '/languages/');
    }
}
new SPVC_Load_Textdomain;
