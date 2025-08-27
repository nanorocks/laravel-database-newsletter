# Laravel Database Newsletter

![Laravel](https://img.shields.io/badge/Laravel-^10.x%20-red?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-^8.1-blue?style=flat-square)
![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)

**Laravel Database Newsletter** is a simple and elegant package for managing newsletter subscribers directly in your database.  
Instead of relying on third-party services, it allows you to store, check, and manage subscribers locally inside your Laravel application.  

---

## ✨ Features

- 📦 Installable via Composer
- 🗄️ Store subscribers in your own database (MySQL, PostgreSQL, SQLite…)
- 🔐 Supports additional attributes (name, preferences, etc.)
- 📋 Easy subscription management (`subscribe`, `unsubscribe`, `isSubscribed`)
- 🔧 Configuration via `.env` and `config/newsletter.php`
- 🧪 Includes tests for stability and reliability

---

## 🚀 Installation

Require the package via Composer:

```bash
composer require nanorocks/laravel-database-newsletter
```

### Publish migrations and configuration:

```bash
php artisan vendor:publish --tag="newsletter-migrations"
php artisan vendor:publish --tag="newsletter-config"
php artisan migrate
```

## ⚙️ Configuration
Set the driver in your .env file:
```bash
NEWSLETTER_DRIVER=database
```
The configuration file config/newsletter.php can be customized to your needs.

## 📚 Usage

Subscribe a user:
```php
Newsletter::subscribe('john@example.com', ['name' => 'John']);
```

Check if a user is subscribed:
```php
Newsletter::isSubscribed('john@example.com'); // true/false
```

Unsubscribe a user:
```php
Newsletter::unsubscribe('john@example.com');
```

Retrieve subscriber details:

```php
$member = Newsletter::getMember('john@example.com');
```
## 🛠 Supported Versions

- PHP: ^8.1

- Laravel: 10.x, 11.x, 12.x

## 📖 Roadmap

- ✅ Database driver
- ⏳ Artisan commands for subscriber management
- ⏳ Laravel Notifications integration
- ⏳ Multi-list support

## 🤝 Contributing
Contributions are welcome! Feel free to submit a pull request or open an issue if you have ideas or find a bug.

## 📜 License
This package is released under the MIT License.
