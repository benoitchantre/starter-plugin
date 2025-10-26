<?php
/**
 * Plugin Name: Starter Plugin
 * Description: Custom WordPress plugin with post type, taxonomy, and Polylang integration
 * Author: Benoît Chantre
 * Author URI: https://benoitchantre.com
 * Requires at least: 6.8
 * Requires PHP: 8.1
 * Version: 0.0.1
 * Updater URI: false
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: starter-plugin
 * Domain Path: /languages
 */

declare( strict_types=1 );

namespace StarterPlugin;

use function add_action;
use function register_activation_hook;
use function register_deactivation_hook;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load Composer autoloader.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
} else {
	// Fallback error if Composer autoload is missing.
	add_action(
		'admin_notices',
		static function (): void {
			echo '<div class="notice notice-error"><p>';
			echo esc_html__( 'Starter Plugin: Composer autoload file is missing. Please run "composer install".', 'starter-plugin' );
			echo '</p></div>';
		}
	);
	return;
}

// Initialize plugin.
add_action(
	'plugins_loaded',
	static function (): void {
		Plugin::get_instance()->init();
	}
);

// Activation hook.
register_activation_hook(
	__FILE__,
	static function (): void {
		Plugin::get_instance()->activate();
	}
);

// Deactivation hook.
register_deactivation_hook(
	__FILE__,
	static function (): void {
		Plugin::get_instance()->deactivate();
	}
);
