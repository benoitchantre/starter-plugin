<?php
/**
 * Custom Post Type class file.
 *
 * @package StarterPlugin
 */

declare(strict_types=1);

namespace StarterPlugin\PostTypes;

/**
 * Class CustomPostType
 * Registers the custom post type.
 */
final class CustomPostType {
	/**
	 * Post type slug.
	 *
	 * @var string
	 */
	public readonly string $slug;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->slug = 'custom_post';
	}

	/**
	 * Initialize the post type and register hooks.
	 *
	 * @return void
	 */
	public function init(): void {
		add_action( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * Get the post type slug.
	 *
	 * @return string
	 */
	public function get_slug(): string {
		return $this->slug;
	}

	/**
	 * Get the post type registration arguments.
	 *
	 * @return array<string, mixed>
	 */
	public function get_args(): array {
		return array(
			'label'                 => esc_html__( 'Custom Posts', 'starter-plugin' ),
			'labels'                => array(
				'name'                  => __( 'Custom posts', 'starter-plugin' ),
				'singular_name'         => __( 'Custom post', 'starter-plugin' ),
				'all_items'             => __( 'All Custom posts', 'starter-plugin' ),
				'archives'              => __( 'Custom post Archives', 'starter-plugin' ),
				'attributes'            => __( 'Custom post Attributes', 'starter-plugin' ),
				'insert_into_item'      => __( 'Insert into custom post', 'starter-plugin' ),
				'uploaded_to_this_item' => __( 'Uploaded to this custom post', 'starter-plugin' ),
				'featured_image'        => _x( 'Featured Image', 'custom_post', 'starter-plugin' ),
				'set_featured_image'    => _x( 'Set featured image', 'custom_post', 'starter-plugin' ),
				'remove_featured_image' => _x( 'Remove featured image', 'custom_post', 'starter-plugin' ),
				'use_featured_image'    => _x( 'Use as featured image', 'custom_post', 'starter-plugin' ),
				'filter_items_list'     => __( 'Filter custom posts list', 'starter-plugin' ),
				'items_list_navigation' => __( 'Custom posts list navigation', 'starter-plugin' ),
				'items_list'            => __( 'Custom posts list', 'starter-plugin' ),
				'new_item'              => __( 'New Custom post', 'starter-plugin' ),
				'add_new'               => __( 'Add New', 'starter-plugin' ),
				'add_new_item'          => __( 'Add New Custom post', 'starter-plugin' ),
				'edit_item'             => __( 'Edit Custom post', 'starter-plugin' ),
				'view_item'             => __( 'View Custom post', 'starter-plugin' ),
				'view_items'            => __( 'View Custom posts', 'starter-plugin' ),
				'search_items'          => __( 'Search custom posts', 'starter-plugin' ),
				'not_found'             => __( 'No custom posts found', 'starter-plugin' ),
				'not_found_in_trash'    => __( 'No custom posts found in trash', 'starter-plugin' ),
				'parent_item_colon'     => __( 'Parent Custom post:', 'starter-plugin' ),
				'menu_name'             => __( 'Custom posts', 'starter-plugin' ),
			),
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => array(
				'title',
				'editor',
				'thumbnail',
				'excerpt',
				'custom-fields',
			),
			'has_archive'           => true,
			'rewrite'               => array(
				'slug'       => 'custom-posts',
				'with_front' => false,
			),
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'custom-posts',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		);
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function register_post_type(): void {
		register_post_type( $this->get_slug(), $this->get_args() );
	}
}
