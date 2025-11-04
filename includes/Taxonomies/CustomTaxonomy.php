<?php
/**
 * Custom Taxonomy class file.
 *
 * @package StarterPlugin
 */

declare(strict_types=1);

namespace StarterPlugin\Taxonomies;

/**
 * Class CustomTaxonomy
 * Registers the custom taxonomy.
 */
final class CustomTaxonomy {
	/**
	 * Taxonomy slug.
	 *
	 * @var non-empty-string
	 */
	private const SLUG = 'custom_category';

	/**
	 * Get the taxonomy slug.
	 *
	 * @return lowercase-string&non-empty-string
	 */
	public function get_slug(): string {
		return self::SLUG;
	}

	/**
	 * Initialize the taxonomy and register hooks.
	 *
	 * @return void
	 */
	public function init(): void {
		add_action( 'init', array( $this, 'register_taxonomy' ) );
	}

	/**
	 * Get the taxonomy registration arguments.
	 *
	 * @return array<string, mixed>
	 */
	public function get_args(): array {
		return array(
			'labels'            => array(
				'name'                       => __( 'Custom categories', 'starter-plugin' ),
				'singular_name'              => _x( 'Custom category', 'taxonomy general name', 'starter-plugin' ),
				'search_items'               => __( 'Search Custom categories', 'starter-plugin' ),
				'popular_items'              => __( 'Popular Custom categories', 'starter-plugin' ),
				'all_items'                  => __( 'All Custom categories', 'starter-plugin' ),
				'parent_item'                => __( 'Parent Custom category', 'starter-plugin' ),
				'parent_item_colon'          => __( 'Parent Custom category:', 'starter-plugin' ),
				'edit_item'                  => __( 'Edit Custom category', 'starter-plugin' ),
				'update_item'                => __( 'Update Custom category', 'starter-plugin' ),
				'view_item'                  => __( 'View Custom category', 'starter-plugin' ),
				'add_new_item'               => __( 'Add New Custom category', 'starter-plugin' ),
				'new_item_name'              => __( 'New Custom category', 'starter-plugin' ),
				'separate_items_with_commas' => __( 'Separate custom categories with commas', 'starter-plugin' ),
				'add_or_remove_items'        => __( 'Add or remove custom categories', 'starter-plugin' ),
				'choose_from_most_used'      => __( 'Choose from the most used custom categories', 'starter-plugin' ),
				'not_found'                  => __( 'No custom categories found.', 'starter-plugin' ),
				'no_terms'                   => __( 'No custom categories', 'starter-plugin' ),
				'menu_name'                  => __( 'Custom categories', 'starter-plugin' ),
				'items_list_navigation'      => __( 'Custom categories list navigation', 'starter-plugin' ),
				'items_list'                 => __( 'Custom categories list', 'starter-plugin' ),
				'most_used'                  => _x( 'Most Used', 'custom_category', 'starter-plugin' ),
				'back_to_items'              => __( '&larr; Back to Custom categories', 'starter-plugin' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array(
				'slug'       => 'custom-category',
				'with_front' => false,
			),
			'capabilities'      => array(
				'manage_terms' => 'edit_posts',
				'edit_terms'   => 'edit_posts',
				'delete_terms' => 'edit_posts',
				'assign_terms' => 'edit_posts',
			),
		);
	}

	/**
	 * Register the taxonomy.
	 *
	 * @return void
	 */
	public function register_taxonomy(): void {
		register_taxonomy( $this->get_slug(), array( 'custom_post' ), $this->get_args() );
	}
}
