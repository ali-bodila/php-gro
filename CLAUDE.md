# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

GRO is a PHP library suite designed to simplify building Domain-Driven Design (DDD) based applications by abstracting boilerplate code into reusable library components. It's organized as a monorepo where users can install either the complete suite (`gro/gro`) or individual packages (`gro/core`, `gro/domain`, etc.).

## Repository Structure

```
php-gro/
├── packages/           # Individual package directories
│   ├── core/          # Core components (gro/core)
│   ├── domain/        # Domain layer (gro/domain)
│   ├── application/   # Application layer (gro/application)
│   ├── infrastructure/# Infrastructure layer (gro/infrastructure)
│   └── common/        # Common utilities (gro/common)
├── tests/             # Global test suite
├── composer.json      # Root composer configuration
└── monorepo-builder.php # Monorepo management config
```

## Development Setup

### Prerequisites
- PHP 8.0 or higher
- Composer for dependency management

### Initial Setup Commands
```bash
# Install all dependencies
composer install

# Run tests for all packages
composer test

# Code quality checks
composer phpcs       # Check code style
composer phpstan     # Static analysis
composer check       # Run all checks

# Fix code style issues
composer phpcbf
```

## Architecture Guidelines

### DDD Structure
When implementing DDD patterns in this library, follow this organization:
- **Domain Layer**: Core business logic, entities, value objects, domain services
- **Application Layer**: Application services, DTOs, command/query handlers
- **Infrastructure Layer**: Repository implementations, external service adapters
- **Presentation Layer**: Controllers, presenters, view models (if applicable)

### Key Design Principles
1. Keep domain logic pure and framework-agnostic
2. Use interfaces for repositories and external services
3. Implement value objects for domain concepts that don't require identity
4. Use aggregates to maintain consistency boundaries
5. Apply CQRS pattern where appropriate for read/write separation

## Package Development

### Package Structure
Each package in `packages/` follows this structure:
```
package-name/
├── src/           # Source code (PSR-4: Gro\PackageName\)
├── tests/         # Tests (PSR-4: Gro\PackageName\Tests\)
├── composer.json  # Package-specific dependencies
└── README.md      # Package documentation
```

### Adding New Components
When creating new DDD building blocks:
1. Determine the appropriate package (core, domain, application, infrastructure, or common)
2. Place code in the package's `src/` directory with proper namespace
3. Add unit tests in the package's `tests/` directory
4. Update package's composer.json if new dependencies are needed
5. Run `composer dump-autoload` to update autoloading

### Testing Strategy
- Unit tests for domain logic (no external dependencies)
- Integration tests for infrastructure components
- Use test doubles for external dependencies
- Maintain high code coverage for domain layer

## Code Standards
- Follow PSR-12 coding standards
- Use strict typing (`declare(strict_types=1);`)
- Document complex domain logic with PHPDoc
- Use meaningful names that reflect domain language
- All classes should be under the `Gro\` namespace
- Package namespaces: `Gro\Core\`, `Gro\Domain\`, `Gro\Application\`, `Gro\Infrastructure\`, `Gro\Common\`

## Publishing and Versioning
- See PUBLISHING.md for detailed instructions on publishing to Packagist
- All packages share the same version number in the monorepo
- Use semantic versioning (major.minor.patch)
- The main package `gro/gro` is a meta-package that includes all sub-packages