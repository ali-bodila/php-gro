# Publishing GRO to Packagist

This guide explains how to publish the GRO library suite to Packagist, allowing users to install either the complete suite or individual packages.

## Prerequisites

1. Create a [Packagist](https://packagist.org) account if you don't have one
2. Ensure you have push access to the GitHub repository
3. Configure your email in the composer.json files (replace `your-email@example.com`)

## Repository Structure

The GRO library is organized as a monorepo with the following packages:

- **gro/gro** - Meta-package that installs all GRO components
- **gro/core** - Core components and interfaces
- **gro/domain** - Domain layer components (entities, value objects, aggregates)
- **gro/application** - Application layer components (use cases, DTOs, CQRS)
- **gro/infrastructure** - Infrastructure components (repositories, adapters)
- **gro/common** - Common utilities and helpers

## Initial Setup

### 1. Initialize Git and Push to GitHub

```bash
git add .
git commit -m "Initial monorepo structure for GRO library suite"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/php-gro.git
git push -u origin main
```

### 2. Create Git Tags for Each Package

For the initial release, create version tags:

```bash
# Tag the main package
git tag -a v1.0.0 -m "Release v1.0.0"

# For monorepo packages, you can use the same version
git push --tags
```

## Publishing to Packagist

### Method 1: Publish Individual Packages (Recommended)

1. **Submit each package to Packagist:**
   - Go to https://packagist.org/packages/submit
   - Submit the repository URL: `https://github.com/YOUR_USERNAME/php-gro`
   - For each package, specify the path:
     - `gro/core` → path: `packages/core`
     - `gro/domain` → path: `packages/domain`
     - `gro/application` → path: `packages/application`
     - `gro/infrastructure` → path: `packages/infrastructure`
     - `gro/common` → path: `packages/common`

2. **Configure Packagist webhook** (for automatic updates):
   - In your GitHub repository settings, add a webhook
   - URL: `https://packagist.org/api/github`
   - Content type: `application/json`
   - Select "Just the push event"

### Method 2: Using Subtree Split (Advanced)

For better package isolation, you can use subtree splits:

```bash
# Install splitsh-lite
brew install splitsh-lite  # macOS
# or download from https://github.com/splitsh/lite/releases

# Create subtree splits for each package
splitsh-lite --prefix=packages/core --target=refs/heads/core
splitsh-lite --prefix=packages/domain --target=refs/heads/domain
splitsh-lite --prefix=packages/application --target=refs/heads/application
splitsh-lite --prefix=packages/infrastructure --target=refs/heads/infrastructure
splitsh-lite --prefix=packages/common --target=refs/heads/common

# Push to separate repositories (optional)
git push https://github.com/YOUR_USERNAME/gro-core.git core:main
git push https://github.com/YOUR_USERNAME/gro-domain.git domain:main
# ... repeat for other packages
```

## Installation Instructions for Users

Once published, users can install packages in several ways:

### Install Complete Suite
```bash
composer require gro/gro
```

### Install Individual Packages
```bash
# Install only what you need
composer require gro/domain
composer require gro/infrastructure

# Or specific combination
composer require gro/core gro/domain gro/application
```

## Version Management

### Releasing New Versions

1. **Update version constraints** in package composer.json files if needed
2. **Create a new tag:**
   ```bash
   git tag -a v1.1.0 -m "Release v1.1.0"
   git push --tags
   ```
3. **Packagist will automatically detect** the new release via webhook

### Versioning Strategy

- Use [Semantic Versioning](https://semver.org/)
- All packages in the monorepo share the same version number
- Breaking changes require a major version bump
- New features require a minor version bump
- Bug fixes require a patch version bump

## Development Workflow

### Local Development
```bash
# Install dependencies
composer install

# Run tests for all packages
composer test

# Run code quality checks
composer check
```

### Testing Package Installation Locally
```bash
# In a test project
composer config repositories.gro path /path/to/php-gro/packages/core
composer require gro/core:@dev
```

## Troubleshooting

### Package Not Found on Packagist
- Ensure the repository is public on GitHub
- Check that composer.json has valid JSON
- Verify the package name matches the submission

### Autoloading Issues
- Run `composer dump-autoload` after changes
- Check PSR-4 namespace configuration

### Version Conflicts
- Use `composer why-not gro/package-name` to debug
- Check version constraints in dependent packages

## Maintenance

### Regular Tasks
- Keep dependencies updated: `composer update`
- Monitor Packagist for indexing issues
- Respond to security advisories promptly
- Tag releases consistently

### Security Releases
For security fixes:
1. Fix the vulnerability
2. Tag a new patch release immediately
3. Consider adding a security advisory on GitHub

## Support

- Report issues: https://github.com/YOUR_USERNAME/php-gro/issues
- Documentation: See README.md and CLAUDE.md
- Packagist page: https://packagist.org/packages/gro/gro