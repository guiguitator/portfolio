# portfolio

My personal portfolio showcasing all my public projects as well as my professional experience.

All texts displayed are written in French, my native language. The code, file names, etc. are written in English for the sake of clarity.

## Build with

### Technologies

- PHP
- Symfony
- Composer
- MariaDB
- CSS & JavaScript

### Libraries

In addition to Symfony's “Web App” package (which includes Twig, PHPUnit, etc.), I used various other libraries, such as EasyAdmin to manage the site's admin panel. This allows me to dynamically add content, such as descriptions of new projects in the form of articles.

## Installation

### Requirements

- PHP >= 8.2
- Symfony 7.4
- Composer
- MySQL, MariaDB or PostgreSQL
- Symfony CLI (optional)

### Getting Started

Here's how to set up the project for development:

```bash
# 1. Clone the repository
git clone https://github.com/guiguitator/portfolio.git
cd portfolio

# 2. Install PHP dependencies
composer install

# 3. Copy the example environment file
cp .env .env.local

# 4. Edit .env with your own database credentials
# (see below)

# 5. Create the database
php bin/console doctrine:database:create

# 6. Create the tables and load the fixtures
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

#### `.env.local` example (for MariaDB)

```
DATABASE_URL="mysql://username:password@127.0.0.1:3306/portfolio?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
```

## Production deployment

For production deployment, please refer to [this](docs/production_deployment.md) document.
