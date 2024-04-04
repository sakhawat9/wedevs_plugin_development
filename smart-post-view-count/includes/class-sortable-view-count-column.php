<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sortable view count column class
 *
 * @since 1.0
 */
class SPVC_Sortable_View_Count_Column
{
    public function __construct()
    {
        add_filter('manage_edit-post_sortable_columns', [$this, 'add_sortable_view_count_column']);
    }

    /**
     * Register 'View Count' column as sortable.
     */
    public function add_sortable_view_count_column($sortable_columns)
    {
        $sortable_columns['post_views_count'] = 'views';
        return $sortable_columns;
    }
}

new SPVC_Sortable_View_Count_Column();
