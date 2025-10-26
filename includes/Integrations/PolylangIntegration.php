<?php
/**
 * Polylang Integration class file.
 *
 * @package StarterPlugin
 */

declare(strict_types=1);

namespace StarterPlugin\Integrations;

use StarterPlugin\PostTypes\CustomPostType;
use StarterPlugin\Taxonomies\CustomTaxonomy;

/**
 * Class PolylangIntegration
 * Handles Polylang compatibility for translatable content.
 */
final class PolylangIntegration {
	/**
	 * Post type instance.
	 *
	 * @var CustomPostType
	 */
	private CustomPostType $post_type;

	/**
	 * Taxonomy instance.
	 *
	 * @var CustomTaxonomy
	 */
	private CustomTaxonomy $taxonomy;

	/**
	 * Constructor with dependency injection.
	 *
	 * @param CustomPostType $post_type The post type instance.
	 * @param CustomTaxonomy $taxonomy The taxonomy instance.
	 */
	public function __construct( CustomPostType $post_type, CustomTaxonomy $taxonomy ) {
		$this->post_type = $post_type;
		$this->taxonomy  = $taxonomy;
	}

	/**
	 * Check if integration should be active.
	 *
	 * @return bool
	 */
	public function is_active(): bool {
		return function_exists( 'pll_register_string' );
	}

	/**
	 * Initialize Polylang integration.
	 *
	 * @return void
	 */
	public function init(): void {
		if ( ! $this->is_active() ) {
			return;
		}

		add_filter( 'pll_get_post_types', array( $this, 'register_translatable_post_types' ) );
		add_filter( 'pll_get_taxonomies', array( $this, 'register_translatable_taxonomies' ) );
	}

	/**
	 * Register post types for translation.
	 *
	 * @param array<string, string> $post_types Existing post types.
	 * @return array<string, string>
	 */
	public function register_translatable_post_types( array $post_types ): array {
		$post_types[ $this->post_type->get_slug() ] = $this->post_type->get_slug();
		return $post_types;
	}

	/**
	 * Register taxonomies for translation.
	 *
	 * @param array<string, string> $taxonomies Existing taxonomies.
	 * @return array<string, string>
	 */
	public function register_translatable_taxonomies( array $taxonomies ): array {
		$taxonomies[ $this->taxonomy->get_slug() ] = $this->taxonomy->get_slug();
		return $taxonomies;
	}
}
