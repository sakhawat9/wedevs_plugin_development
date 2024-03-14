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
 * @package           Smart_Related_Posts
 *
 * Plugin Name:       Smart Related Post
 * Description:       Display related posts in the same category.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sakhawat Hossain
 * Author URI:        https://sakhawat.vercel.app/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smart-related-posts
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

/**
 * Main plugin class
 *
 * @since 1.0
 */
class SRP_Related_Post {


	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Initialization.
	 */
	public function init() {
		// Add custom style.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		// Add the related posts function to the content.
		add_filter( 'the_content', array( $this, 'related_post' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	/**
	 * Load plugin text domain for translation.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'smart-related-posts', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		wp_register_style( 'srp-main', plugins_url( 'css/style.css', __FILE__ ), array(), '1.0.0', 'all' );
	}

	/**
	 * Related post function.
	 *
	 * @param string $content The post content.
	 * @return string Modified post content.
	 */
	public function related_post( $content ) {
		global $post;

		// Get the current post's categories.
		$categories = get_the_category( $post->ID );

		// Check if the current post has categories or is a singular post.
		if ( $categories || is_singular( 'post' ) ) {
			wp_enqueue_style( 'srp-main' );

			$srp_related_posts_col               = apply_filters( 'srp_related_posts_col', 3 );
			$srp_related_posts_layout            = apply_filters( 'srp_related_posts_layout', 'grid' );
			$srp_related_posts_section_title_tag = apply_filters( 'srp_related_posts_title_tag', 'h3' );
			$srp_related_posts_section_title     = apply_filters( 'srp_related_posts_title', __( 'Related Posts', 'smart-related-posts' ) );
			$srp_related_post_remove_thumb       = apply_filters( 'srp_related_post_remove_thumb', true );
			$srp_related_post_remove_excerpt     = apply_filters( 'srp_related_post_remove_excerpt', true );
			$srp_related_post_remove_category    = apply_filters( 'srp_related_post_remove_category', true );
			$srp_related_posts_title_tag         = apply_filters( 'srp_related_posts_title_tag', 'h4' );
			$srp_related_posts_excerpt_tag       = apply_filters( 'srp_related_posts_excerpt_tag', 'p' );
			$srp_related_posts_excerpt_length       = apply_filters( 'srp_related_posts_excerpt_length', 15 );

			$layout = 'grid' === $srp_related_posts_layout ? 'grid_layout' : 'list_layout';

			$category_ids = array();
			foreach ( $categories as $category ) {
				$category_ids[] = $category->term_id;
			}

			$args = apply_filters(
				'srp_related_posts_args',
				array(
					'post__not_in'   => array( get_the_ID() ),
					'posts_per_page' => 5,
					'orderby'        => 'rand',
					'post_type'      => 'post',
					'category__in'   => $category_ids,
				)
			);

			$srp_related_posts = new WP_Query( $args );

			if ( $srp_related_posts->have_posts() ) {
				$content .= '<div class="related_posts">';

				$content .= '<' . esc_html( $srp_related_posts_section_title_tag ) . '>' . esc_html( $srp_related_posts_section_title ) . '</' . esc_html( $srp_related_posts_section_title_tag ) . '>';
				$content .= '<div class="related_posts_items ' . esc_attr( $layout ) . '" style="--srp_posts_col:' . $srp_related_posts_col . '">';
				while ( $srp_related_posts->have_posts() ) {
					$excerpt = wp_trim_words( get_the_content(), esc_attr($srp_related_posts_excerpt_length), '...' );
					$srp_related_posts->the_post();
					$content .= '<div class="post_item">';
					// Display post thumbnail.
					if ( has_post_thumbnail() && $srp_related_post_remove_thumb ) {
						$thumbnail_url = get_the_post_thumbnail_url( $srp_related_posts->ID, 'medium' );
						if ( $thumbnail_url ) {
							$content .= '<div class="related-thumb">';
							$content .= '<img src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
							$content .= '</div>';
						}
					}
					$content .= '<div class="post_item_content">';
					// Display post title.
					$content .= '<' . esc_html( $srp_related_posts_title_tag ) . '><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></' . esc_html( $srp_related_posts_title_tag ) . '>';
					// Display post category.

					if ( ! empty( $categories ) && $srp_related_post_remove_category ) {
						$category_names = array();
						foreach ( $categories as $category ) {
							$category_names[] = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
						}

						$content .= '<div class="post_category">';
						$content .= implode( ', ', $category_names );
						$content .= '</div>';
					}
					// Display post excerpt.
					if ( $srp_related_post_remove_excerpt ) {
						$content .= '<' . esc_html( $srp_related_posts_excerpt_tag ) . '>' . esc_html( $excerpt ) . '</' . esc_html( $srp_related_posts_excerpt_tag ) . '>';
					}
					$content .= '</div>';
					$content .= '</div>';
				}
				$content .= '</div>';
				$content .= '</div>';
			}

			// Reset post data.
			wp_reset_postdata();
		}

		return $content;
	}
}

/**
 * Kickstart the plugin
 */
new SRP_Related_Post();
