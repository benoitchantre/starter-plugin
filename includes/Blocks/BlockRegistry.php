<?php
/**
 * BlockRegistry class file.
 *
 * @package StarterPlugin
 */

declare(strict_types=1);

namespace StarterPlugin\Blocks;

/**
 * Class BlockRegistry
 * Handles registration of custom Gutenberg blocks.
 */
final class BlockRegistry {

	/**
	 * Plugin root directory path.
	 *
	 * @var string
	 */
	private string $plugin_path;

	/**
	 * Constructor.
	 *
	 * @param string $plugin_path The absolute path to the plugin directory.
	 */
	public function __construct( string $plugin_path ) {
		$this->plugin_path = $plugin_path;
	}

	/**
	 * Initialize block registration.
	 *
	 * @return void
	 */
	public function init(): void {
		add_action( 'init', array( $this, 'register_custom_blocks' ) );
	}

	/**
	 * Registers custom blocks from the build directory.
	 *
	 * @return void
	 */
	public function register_custom_blocks(): void {
		$block_manifest_path = $this->plugin_path . 'build/blocks-manifest.php';

		// Check if blocks have been built.
		if ( ! file_exists( $block_manifest_path ) ) {
			return;
		}

		wp_register_block_types_from_metadata_collection(
			$this->plugin_path . 'build',
			$block_manifest_path
		);

		/**
		 * Internationalization support for block scripts.
		 *
		 * Scripts using i18n functions should be registered here.
		 *
		 * Examples:
		 * - starter-plugin-custom-block-editor-script
		 * - starter-plugin-custom-block-view-script
		 *
		 * @link https://developer.wordpress.org/block-editor/how-to-guides/internationalization/
		 * @link https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
		 */
		$script_handles_requiring_i18n = array(
			// Add script handles here when blocks use i18n functions.
			// 'starter-plugin-custom-block-editor-script',
			// 'starter-plugin-custom-block-view-script',
		);

		// @phpstan-ignore foreach.emptyArray
		foreach ( $script_handles_requiring_i18n as $handle ) {
			wp_set_script_translations(
				$handle,
				'starter-plugin',
				$this->plugin_path . 'languages'
			);
		}
	}
}
