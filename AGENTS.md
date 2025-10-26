# AI Agent Instructions

## Repository Overview

**Starter Plugin** is a modern WordPress plugin template built with PHP 8.1+ and WordPress 6.8+. The repository provides a foundation for creating WordPress plugins with custom post types, taxonomies, and multilingual support via Polylang integration.

### Project Type & Languages
- **Type**: WordPress plugin
- **PHP Version**: 8.1+ (strict requirement)
- **WordPress Version**: 6.8+ minimum
- **Node.js Version**: 20 (see .nvmrc)
- **Languages**: PHP (backend), JavaScript (frontend), CSS (styles)
- **Build System**: WordPress Scripts (wp-scripts) for frontend assets
- **Dependencies**: Composer (PHP), npm (JavaScript)

### Repository Size & Structure
- **Size**: Small to medium (~30 PHP files, standard WordPress plugin structure)
- **Architecture**: Object-oriented PHP with singleton pattern, modern PHP 8.1 features
- **Framework**: WordPress plugin architecture with PSR-4 autoloading

## Build & Validation Workflow

### Prerequisites
**ALWAYS run these commands in this exact order before any development work:**

```bash
# 1. Install PHP dependencies (REQUIRED)
composer install

# 2. Install JavaScript dependencies (REQUIRED)
npm install

# 3. Generate autoloader (REQUIRED after adding new classes)
composer dump-autoload
```

### Development Commands

#### PHP Quality Checks (MUST pass for CI)
```bash
# Check coding standards (WordPress Coding Standards)
composer run phpcs

# Fix coding style issues automatically
composer run phpcbf

# Run static analysis (PHPStan level 8) - uses 512M memory limit
composer run phpstan

# Check PHP compatibility (PHP 8.1+)
composer run phpcompat

# Validate composer.json structure
composer validate --no-check-publish
```

#### JavaScript Quality Checks
```bash
# Check Node.js engine compatibility
npm run check-engines

# Lint JavaScript files
npm run lint:js

# Build frontend assets (Gutenberg blocks)
npm run build

# Development mode with watch
npm start

# Create a new Gutenberg block (interactive)
npm run create-block
```

#### Local Development Environment
```bash
# Start local WordPress environment (requires Docker)
npx @wordpress/env start

# Stop local WordPress environment
npx @wordpress/env stop

# Clean/reset local environment
npx @wordpress/env clean
```

### Critical Validation Notes

1. **PHPStan Memory**: Always uses 512M memory limit (`php -d memory_limit=512M`) to prevent memory exhaustion
2. **Composer Validation**: Use `--no-check-publish` flag as this is not a publishable package
3. **PHPCS Cache**: Uses `.cache/phpcs.json` for faster subsequent runs
4. **Empty Build**: `npm run build` will show "No entry file discovered in src directory" - this is expected as no blocks are implemented yet

### GitHub Actions CI Pipeline

The repository has automated CI that runs on every push/PR:

#### PHP Code Quality (.github/workflows/php-code-quality.yml)
- **Triggers**: Push to main, PRs, PHP file changes, config changes
- **PHP Version**: 8.4 (for testing compatibility)
- **Jobs**:
  - Coding standards (PHPCS)
  - PHP compatibility (PHPCompatibility)
  - Static analysis (PHPStan)
- **Timeout**: 5 minutes per job
- **Cache**: Composer cache, PHPCS cache, PHPStan cache

#### JavaScript Code Quality (.github/workflows/js-code-quality.yml)
- **Triggers**: JavaScript file changes, config changes
- **Node Version**: From .nvmrc (20)
- **Jobs**: ESLint, engine compatibility check
- **Timeout**: 5 minutes

### Common Build Issues & Solutions

1. **PHPStan Memory Errors**: Already configured with 512M limit in composer.json scripts
2. **Missing Autoloader**: Run `composer install` before any PHP commands
3. **npm vulnerabilities**: Expected with @wordpress/scripts; run `npm audit fix` if needed
4. **PHPCS Warning Severity**: CI ignores warnings (ignore_warnings_on_exit=1)

## Project Architecture & Layout

### Directory Structure
```
starter-plugin/
├── starter-plugin.php          # Main plugin file with activation hooks
├── uninstall.php              # Plugin cleanup on uninstall
├── includes/                  # Core plugin classes (PSR-4: StarterPlugin\)
│   ├── Plugin.php             # Main singleton plugin class
│   ├── PostTypes/
│   │   └── CustomPostType.php # Custom post type registration
│   ├── Taxonomies/
│   │   └── CustomTaxonomy.php # Custom taxonomy registration
│   ├── Integrations/
│   │   └── PolylangIntegration.php # Polylang multilingual support
│   └── Blocks/
│       └── BlockRegistry.php  # Gutenberg blocks registration
├── src/                       # Frontend block source files (empty)
├── build/                     # Compiled frontend assets (empty)
├── languages/                 # Translation files
│   └── starter-plugin.pot     # Translation template
├── tests/
│   └── phpstan-bootstrap.php  # PHPStan analysis bootstrap
└── vendor/                    # Composer dependencies
```

### Configuration Files

#### PHP Configuration
- **phpcs.xml.dist**: WordPress Coding Standards, excludes vendor/, uses .cache/
- **phpcompat.xml.dist**: PHP 8.1+ compatibility checking
- **phpstan.neon.dist**: Level 8 static analysis, 512M memory, excludes vendor/
- **composer.json**: PSR-4 autoloading (StarterPlugin\ → includes/)

#### JavaScript Configuration
- **package.json**: WordPress Scripts, Prettier config
- **.nvmrc**: Node.js version 20
- **.eslintrc.js**: ESLint rules (exists but not shown)

#### WordPress Environment Configuration
- **.wp-env.json**: Local development environment (PHP 8.4, plugin development mode)

#### WordPress Plugin Configuration
- **Text Domain**: `starter-plugin`
- **Namespace**: `StarterPlugin`

### Key Architectural Patterns

1. **Singleton Pattern**: Main Plugin class uses get_instance()
2. **Dependency Injection**: Services passed via constructor
3. **Modern PHP**: Readonly properties, strict types, PHP 8.1+ features
4. **WordPress Standards**: Full WordPress Coding Standards compliance
5. **Autoloading**: PSR-4 with composer autoloader

### Core Classes Overview

- **Plugin.php**: Main orchestrator, initializes all components
- **CustomPostType.php**: Registers 'custom_post' post type with full WordPress integration
- **CustomTaxonomy.php**: Registers 'custom_category' hierarchical taxonomy
- **PolylangIntegration.php**: Adds multilingual support when Polylang is active
- **BlockRegistry.php**: Handles Gutenberg block registration (ready for future blocks)

### Dependencies & Integrations

#### Runtime Dependencies
- WordPress 6.8+
- PHP 8.1+
- Composer autoloader (critical - plugin fails gracefully if missing)

#### Optional Integrations
- **Polylang**: Automatically detected and integrated for multilingual support
- **Gutenberg**: Block registry prepared for custom blocks

#### Development Dependencies
- PHPStan with WordPress stubs and extensions
- WordPress Coding Standards
- PHP Compatibility checker
- WordPress Scripts for frontend builds

## File Change Guidelines

### When Adding New Classes
1. Place in appropriate `/includes/` subdirectory
2. Use `StarterPlugin\` namespace with PSR-4 structure
3. Run `composer dump-autoload` after adding
4. Add initialization to `Plugin::__construct()` and `Plugin::init()`

### When Modifying PHP Files
1. **ALWAYS** maintain strict types: `declare(strict_types=1);`
2. Use readonly properties where applicable
3. Follow WordPress Coding Standards exactly
4. Add proper PHPDoc blocks for all methods
5. Run full validation suite before committing

### When Adding Frontend Assets
1. Create new blocks using `npm run create-block` (interactive scaffold)
2. Place source files in `/src/` directory
3. Use `npm run start` for development
4. Run `npm run build` for production builds
5. Output goes to `/build/` directory
6. Update BlockRegistry.php to register new blocks

## Validation Checklist

Before submitting any changes, ALWAYS run this complete validation sequence:

```bash
# 1. PHP validation
composer install
composer run phpcs
composer run phpstan
composer run phpcompat
composer validate --no-check-publish

# 2. JavaScript validation (if applicable)
npm install
npm run check-engines
npm run lint:js
npm run build

# 3. Test plugin loading
# Option A: Local wp-env testing (requires Docker)
npx @wordpress/env start
# Visit http://localhost:8888/wp-admin to test plugin activation

# Option B: Verify no fatal errors when activated in WordPress
```

**Trust these instructions** - they are comprehensive and tested. Only search for additional information if these instructions are incomplete or incorrect. The build process is well-established and documented above.
