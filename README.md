# Starter Plugin

A modern WordPress plugin built with PHP 8.1+ and following WordPress coding standards.

## Features

- **Custom Post Type**: `custom_post` with full WordPress admin integration
- **Custom Taxonomy**: `custom_category` for organizing custom posts
- **Polylang Integration**: Automatic translation support when Polylang is active
- **Modern PHP**: Built with PHP 8.1+ features (readonly properties, strict types)
- **Code Quality**: PHPStan level 8 static analysis and WordPress Coding Standards

## Requirements

- **PHP**: 8.1 or higher
- **WordPress**: 6.8 or higher
- **Composer**: For dependency management

## Installation

1. Clone this repository
2. Run `composer install` to install dependencies
3. Activate the plugin in WordPress admin

## Development

### Setup

```bash
# Install dependencies
composer install

# Generate autoloader
composer dump-autoload
```

### Code Quality

```bash
# Check code style
composer run phpcs

# Fix code style issues
composer run phpcbf

# Run static analysis (automatically uses 512M memory limit)
composer run phpstan

# Check PHP compatibility
composer run phpcompat
```

**Note**: PHPStan is configured to use 512M memory limit to avoid memory exhaustion issues. The configuration also uses single-process mode for better memory efficiency.

### Project Structure

```
includes/
├── Plugin.php                     # Main plugin class
├── PostTypes/
│   └── CustomPostType.php        # Custom post type registration
├── Taxonomies/
│   └── CustomTaxonomy.php        # Custom taxonomy registration
└── Integrations/
    └── PolylangIntegration.php    # Polylang multilingual support
```

**Note**: We use `includes/` instead of `src/` to reserve the `src/` directory for Gutenberg blocks and frontend assets that require build processes.

## Architecture

This plugin follows a simplified Object-Oriented approach:

- **Singleton Pattern**: Main Plugin class for WordPress hooks
- **Dependency Injection**: Services passed via constructor
- **Single Responsibility**: Each class has one clear purpose
- **Modern PHP**: Readonly properties, strict typing, and PHP 8.1+ features

## Development Commands

### NPM scripts
- `npm run start` - Start development mode with hot reload
- `npm run build` - Build all blocks for production
- `npm run lint:js` - Lint JavaScript files
- `npm run format` - Format code
- `npm run create-block` - Create a new block with guided setup

### Composer scripts
- `composer run phpcs` - Check PHP coding standards
- `composer run phpcbf` - Fix PHP coding standards
- `composer run phpcompat` - Check PHP compatibility
- `composer run phpstan` - Run static analysis on PHP files

## GitHub workflows

| Workflow                | Trigger                                       | Actions                                                                                                         |
|-------------------------|-----------------------------------------------|-----------------------------------------------------------------------------------------------------------------|
| PHP Code Quality        | Push/PR to main, PHP file changes             | • Coding standards (PHPCS)<br>• Compatibility checks<br>• Static analysis (PHPStan)                             |
| JavaScript Code Quality | Push/PR to main, JS file changes              | • Linting (ESLint)<br>• Node.js compatibility checks                                                            |
| Validate JSON files     | Push/PR to main, theme.json or styles changes | • JSON syntax validation<br>• theme.json schema validation<br>• Block styles validation                         |
| Build                   | Push/PR to main, build-related changes        | • Build theme assets<br>• Run unit tests<br>• Generate language files<br>• Create distributable archive         |
| Release                 | New version tag                               | • Build theme<br>• Create GitHub release<br>• Upload theme archive                                              |
| Deployment              | Manual trigger                                | • Verify PHP compatibility<br>• Validate JSON schema<br>• Build theme assets<br>• Deploy to staging environment |

## Deployment configuration

The deployment workflow requires the following configuration in your GitHub repository.

### Environment variables
- `URL`: The URL of your environment (e.g., `https://staging.example.com`)

### Environment secrets
- `SSH_KEY`: Your private SSH key for server authentication
- `SSH_CONFIG`: SSH configuration for your server. The `Host` need to be derived from the `URL` variable while `HostName` is the actual server IP or domain name:
  ```
  Host staging.example.com
    HostName 123.123.123.123
    User deploy
    Port 22
  ```

- `KNOWN_HOSTS`: SSH known hosts entries for your server (use the server address)
  ```bash
  # Get the known hosts entry
  ssh-keyscan -H staging.example.com
  ```

- `DEPLOY_PATH`: Path to the plugin directory
  ```
  /var/www/staging.example.com/wp-content/plugins/starter-blocks
  ```

### Server requirements
- SSH access configured with the deployment public key in `~/.ssh/authorized_keys`
- Write permissions on the theme directory for the SSH-authenticated user
