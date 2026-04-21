# AI Agent Instructions

## Repository Overview

A modern WordPress plugin with custom post types, taxonomies, blocks, and multilingual support via Polylang.

## Build Commands

**Composer:**
- `composer run phpcs` — PHP CodeSniffer
- `composer run phpcbf` — auto-fix PHP coding standards
- `composer run phpstan` — static analysis (PHPStan level 8, 512M memory limit)
- `composer run phpcompat` — PHP 8.1+ compatibility checks
- `composer validate --no-check-publish` — validate composer.json

**npm:**
- `npm run build` — compile frontend assets (expected output: "No entry file discovered" until blocks are added)
- `npm run start` — watch mode for development
- `npm run lint:js` — lint JavaScript
- `npm run create-block` — scaffold a new Gutenberg block in `/src/`
- `npm run check-engines` — verify Node.js engine compatibility

## Directory Structure

```
├── starter-plugin.php         # Main plugin file with activation hooks
├── uninstall.php              # Plugin cleanup on uninstall
├── includes/                  # Core plugin classes (PSR-4: StarterPlugin\)
│   ├── Plugin.php             # Main singleton, initializes all components
│   ├── PostTypes/
│   │   └── CustomPostType.php
│   ├── Taxonomies/
│   │   └── CustomTaxonomy.php
│   ├── Integrations/
│   │   └── PolylangIntegration.php
│   └── Blocks/
│       └── BlockRegistry.php
├── src/                       # Frontend block source files
├── build/                     # Compiled frontend assets (auto-generated)
├── languages/                 # Translation files
├── tests/
│   └── phpstan-bootstrap.php
└── vendor/                    # Composer dependencies
```

## Key Architectural Patterns

**Singleton + PSR-4**: `Plugin.php` uses `get_instance()`; all classes live under `StarterPlugin\` mapped to `includes/`.

**Strict PHP**: Always declare `strict_types=1`, use readonly properties, and add PHPDoc blocks to all methods.

**Optional integrations**: Polylang is auto-detected at runtime. Gutenberg block support is wired via `BlockRegistry.php`.

## Verifying Changes

Run the tools relevant to the files you changed:

- PHP files: `composer run phpcs`, `composer run phpstan`
- JS/CSS files: `npm run lint:js`, `npm run build`
- After adding new classes: `composer dump-autoload`

## Development Guidelines

**Adding a New Class**: place it in the appropriate `/includes/` subdirectory, use the `StarterPlugin\` namespace, run `composer dump-autoload`, then wire it in `Plugin::__construct()` and `Plugin::init()`.

**Adding a Custom Block**: run `npm run create-block`, then develop the block. It is automatically registered via `blocks-manifest.php` in `BlockRegistry.php`.
