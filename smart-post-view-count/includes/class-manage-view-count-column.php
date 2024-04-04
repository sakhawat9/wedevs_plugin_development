<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Manage view count column class
 *
 * @since 1.0
 */
class SPVC_Manage_View_Count_Column
{
    public function __construct()
    {
        add_filter('manage_posts_columns', [$this, 'add_view_count_column']);
        add_action('manage_posts_custom_column', [$this, 'manage_view_count_column'], 10, 2);
    }

    /**
     * Add view count column to posts list table.
     */
    public function add_view_count_column($columns)
    {
        $columns['post_views_count'] = esc_html__('Views', 'smart-post-view-count');
        return $columns;
    }

    /**
     * Display view count in the posts list table.
     */
    public function manage_view_count_column($column, $post_id)
    {
        if ($column === 'post_views_count') {
            $view_count = get_post_meta($post_id, '_post_views_count', true);
            $view_count = $view_count ? $view_count : 0;
            echo esc_html($view_count);
        }
    }
}

new SPVC_Manage_View_Count_Column();
