<?php
/**
 * Plugin uninstall script.
 *
 * @package StarterPlugin
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// For this minimal plugin, we don't need to clean up anything.
// In the future, you might want to:
// - Delete custom database tables
// - Remove plugin options
// - Clean up transients
// - Delete custom post types data (if desired)

// Example of cleaning up options (uncomment if needed):
// delete_option( 'starter_plugin_settings' );

// Example of cleaning up transients (uncomment if needed):
// delete_transient( 'starter_plugin_cache' );

// Note: WordPress automatically handles:
// - Removing the plugin directory
// - Cleaning up scheduled hooks
// - Removing the plugin from active plugins list
