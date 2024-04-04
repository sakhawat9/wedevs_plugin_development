<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode class
 *
 * @since 1.0
 */
class SPVC_Shortcodes
{
    public function __construct()
    {
        add_shortcode('spvc_post_view_count', [$this, 'spvc_post_view_count_shortcode']);
    }

    /**
     * Shortcode callback to display post view count.
     */
    public function spvc_post_view_count_shortcode($atts)
    {
        $show_title = isset($atts['show_title']) ? $atts['show_title'] : 'true';
        $show_subtitle = isset($atts['show_subtitle']) ? $atts['show_subtitle'] : 'true';
        $title = isset($atts['title']) ? $atts['title'] : __('Page Views', 'smart-post-view-count');
        $subtitle = isset($atts['subtitle']) ? $atts['subtitle'] : __('Total Views', 'smart-post-view-count');
        $counter_box = isset($atts['title_css']) ? $atts['title_css'] : '';
        $title_css = isset($atts['title_css']) ? $atts['title_css'] : '';
        $subtitle_css = isset($atts['subtitle_css']) ? $atts['subtitle_css'] : '';
        $counter_css = isset($atts['counter_css']) ? $atts['counter_css'] : '';
        $title_tag = isset($atts['title_tag']) ? $atts['title_tag'] : 'h3';
        $subtitle_tag = isset($atts['subtitle_tag']) ? $atts['subtitle_tag'] : 'p';
        $counter_tag = isset($atts['counter_tag']) ? $atts['counter_tag'] : 'h3';

        // Process shortcode attributes
        $atts = shortcode_atts(
            array(
                'id' => get_the_ID(),
            ),
            $atts,
            'spvc_post_view_count'
        );

        // Retrieve view count for the specified post ID
        $post_views = get_post_meta($atts['id'], '_post_views_count', true);

        // Output view count HTML
        // Output view count
        $content = '';
        $content .= '<div class="' . esc_attr($counter_box) . 'mb-3 inline-block shadow-lg p-5 rounded-lg">';
        if ($show_title == 'true') {
            $content .= '<' . esc_attr($title_tag) . ' class="' . esc_attr($title_css) . ' mb-2 text-3xl font-bold">' . esc_html($title) . '</' . esc_attr($title_tag) . '>';
        }
        if ($show_subtitle == 'true') {
            $content .= '<' . esc_attr($subtitle_tag) . ' class="' . esc_attr($subtitle_css) . ' mb-2 text-lg">' . esc_html($subtitle) . '</' . esc_attr($subtitle_tag) . '>';
        }
        $content .= '<' . esc_attr($counter_tag) . ' class="' . esc_attr($counter_css) . ' mb-0 text-4xl font-bold">' . esc_html($post_views) . '</' . esc_attr($counter_tag) . '>';
        $content .=  '</div>';
        return $content;
    }
}

new SPVC_Shortcodes();
