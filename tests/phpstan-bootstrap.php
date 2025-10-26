<?php
/**
 * PHPStan bootstrap file.
 *
 * Minimal bootstrap since WordPress stubs and extensions handle most setup.
 * Only defines plugin-specific constants and loads autoloader.
 *
 * @package StarterPlugin
 */

declare(strict_types=1);

// Load Composer autoloader for the plugin classes.
$autoloader_path = dirname( __DIR__ ) . '/vendor/autoload.php';
if ( file_exists( $autoloader_path ) ) {
	require_once $autoloader_path;
}
