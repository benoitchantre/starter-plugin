<?php
/**
 * Main Plugin Class file.
 *
 * @package StarterPlugin
 */

declare(strict_types=1);

namespace StarterPlugin;

use StarterPlugin\PostTypes\CustomPostType;
use StarterPlugin\Taxonomies\CustomTaxonomy;
use StarterPlugin\Integrations\PolylangIntegration;
use StarterPlugin\Blocks\BlockRegistry;

/**
 * Main Plugin Class
 * Simple initialization without complex dependency injection.
 */
final class Plugin {
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
	 * Polylang integration instance.
	 *
	 * @var PolylangIntegration
	 */
	private PolylangIntegration $polylang;

	/**
	 * Block registry instance.
	 *
	 * @var BlockRegistry
	 */
	private BlockRegistry $block_registry;

	/**
	 * Singleton instance.
	 *
	 * @var self|null
	 */
	private static ?self $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @return self
	 */
	public static function get_instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->post_type      = new CustomPostType();
		$this->taxonomy       = new CustomTaxonomy();
		$this->polylang       = new PolylangIntegration(
			$this->post_type,
			$this->taxonomy
		);
		$this->block_registry = new BlockRegistry( __DIR__ . '/../' );
	}

	/**
	 * Initialize the plugin.
	 *
	 * @return void
	 */
	public function init(): void {
		$this->post_type->init();
		$this->taxonomy->init();
		$this->polylang->init();
		$this->block_registry->init();
	}

	/**
	 * Plugin activation.
	 *
	 * @return void
	 */
	public function activate(): void {
		// Initialize components first.
		$this->init();

		// Flush rewrite rules after registering post types and taxonomies.
		flush_rewrite_rules();
	}

	/**
	 * Plugin deactivation.
	 *
	 * @return void
	 */
	public function deactivate(): void {
		// Flush rewrite rules to clean up.
		flush_rewrite_rules();
	}
}
