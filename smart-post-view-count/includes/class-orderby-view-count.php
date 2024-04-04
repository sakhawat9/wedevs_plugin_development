<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Orderby view count class
 *
 * @since 1.0
 */
class SPVC_Orderby_View_Count
{
    public function __construct()
    {
        add_action('pre_get_posts', [$this, 'orderby_view_count']);
    }

    /**
     * Modify the query to order posts by view count.
     */
    public function orderby_view_count($query)
    {
        if (!is_admin() || !$query->is_main_query() || $query->get('orderby') !== 'views') {
            return;
        }

        $query->set('meta_key', '_post_views_count');
        $query->set('orderby', 'meta_value_num');
    }
}

new SPVC_Orderby_View_Count();
