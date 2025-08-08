# GRO - PHP DDD Library Suite

[![PHP Version](https://img.shields.io/badge/php-%5E8.0-blue)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

A comprehensive PHP library suite for building Domain-Driven Design (DDD) based applications by eliminating boilerplate code. GRO provides a set of modular packages that can be used independently or together to implement DDD patterns effectively.

## 🚀 Installation

### Install Complete Suite
```bash
composer require gro/gro
```

### Install Individual Packages
```bash
# Core components only
composer require gro/core

# Domain layer components
composer require gro/domain

# Application layer components  
composer require gro/application

# Infrastructure components
composer require gro/infrastructure

# Common utilities
composer require gro/common
```

## 📦 Available Packages

| Package | Description | Use Case |
|---------|-------------|----------|
| **gro/core** | Core interfaces and base classes | Foundation for all other packages |
| **gro/domain** | Domain entities, value objects, aggregates | Building rich domain models |
| **gro/application** | Application services, DTOs, CQRS components | Implementing use cases and application logic |
| **gro/infrastructure** | Repository implementations, adapters | Data persistence and external integrations |
| **gro/common** | Shared utilities and helpers | Cross-cutting concerns and utilities |

## 🏗️ Architecture

GRO follows Domain-Driven Design principles and provides building blocks for:

- **Entities** - Objects with identity
- **Value Objects** - Immutable objects without identity
- **Aggregates** - Consistency boundaries
- **Repositories** - Data access abstractions
- **Domain Services** - Business logic that doesn't fit in entities
- **Application Services** - Use case orchestration
- **Domain Events** - Communication between bounded contexts

## 💻 Quick Start

### Creating an Aggregate Root

```php
use Gro\Domain\Entity\AggregateRoot;

class Order extends AggregateRoot
{
    private OrderId $id;
    private CustomerId $customerId;
    private array $items = [];
    
    public function addItem(Product $product, int $quantity): void
    {
        $this->items[] = new OrderItem($product, $quantity);
        $this->recordDomainEvent(new ItemAddedToOrder($this->id, $product->getId(), $quantity));
    }
}
```

## 🛠️ Development

### Requirements

- PHP 8.0 or higher
- Composer

### Running Tests

```bash
composer test
```

### Code Quality

```bash
# Check code style
composer phpcs

# Run static analysis
composer phpstan

# Run all checks
composer check
```

## 📚 Documentation

- [Publishing Guide](PUBLISHING.md) - Instructions for maintainers
- [Architecture Guide](CLAUDE.md) - Detailed architecture documentation

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 👤 Author

**Ali Bodila**
- Email: bodila.ali@gmail.com
- GitHub: [@ali](https://github.com/ali)

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

Built with ❤️ for the PHP DDD community.
