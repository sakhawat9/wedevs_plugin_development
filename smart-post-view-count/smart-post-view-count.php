<?php

/**
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link               https://sakhawat.vercel.app/
 * @since             1.0
 * @package           Smart_Post_View_Count
 *
 * Plugin Name:       Smart Post View Count
 * Description:       Display view count for specific posts.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sakhawat Hossain
 * Author URI:        https://sakhawat.vercel.app/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smart-post-view-count
 * Domain Path:       /languages
 */


if (!defined('ABSPATH')) {
    die;
} // Cannot access pages directly.

// Define constants for plugin basename.
if (!defined('SPVC_PRO_BASENAME')) {
    define('SPVC_PRO_BASENAME', plugin_basename(__FILE__));
}
// Define constants for plugin directory path.
if (!defined('SPVC_DIR_URL')) {
    define('SPVC_DIR_URL', plugin_dir_url(__FILE__));
}

/**
 * Main plugin class
 *
 * @since 1.0
 */
class SPVC_Smart_Post_View_Count
{
    public function __construct()
    {
        $this->orderby_view_count();
    }

    // Include necessary files.
    public function orderby_view_count()
    {
        require_once plugin_dir_path(__FILE__) . 'includes/class-load-textdomain.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-enqueue-scripts.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-shortcodes.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-post-view-count.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-sortable-view-count-column.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-manage-view-count-column.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-orderby-view-count.php';
    }
}
new SPVC_Smart_Post_View_Count;
