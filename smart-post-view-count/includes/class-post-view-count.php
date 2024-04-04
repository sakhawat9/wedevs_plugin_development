<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Post view count class
 *
 * @since 1.0
 */
class SPVC_Post_View_Count
{
    public function __construct()
    {
        add_action('wp_head', [$this, 'count_post_view']);
    }

    /**
     * Increment post view count.
     */
    public function count_post_view()
    {
        if (is_single()) {
            $post_id = get_the_ID();
            $views = get_post_meta($post_id, '_post_views_count', true);
            $views = $views ? $views : 0;
            $views++;
            update_post_meta($post_id, '_post_views_count', $views);
        }
    }
}

new SPVC_Post_View_Count();
