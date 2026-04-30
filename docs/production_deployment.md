# Production deployment

Here are the steps to follow to deploy the portfolio in a production environment.

This is an example for a Debian VPS server.

## Requirements

- Web server (*Apache* or *Nginx* for example)
- PHP >= 8.2
- Composer
- MySQL, MariaDB or PostgreSQL
- Git

> In this documentation, Apache and MariaDB are used as examples.

## Deployment

### 1. Setup

Go to the folder where you want to place the website (for example, `/var/www/`)

```bash
git clone https://github.com/guiguitator/portfolio.git
cd portfolio
```

### 2. Set the environment variables

Create a `.env.local` file in the project root directory containing the following variables:

```bash
DATABASE_URL="mysql://user:password@127.0.0.1:3306/portfolio?serverVersion=10.11.14-MariaDB&charset=utf8mb4"
APP_ENV=prod
APP_DEBUG=0
```

> Use your personal database credentials and adjust the values according to the DBMS you are using (examples can be found in the `.env` file).

### 3. Installing dependencies

```bash
composer install --no-dev --optimize-autoloader
```

### 4. Create the database

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Create an admin user for content management

The portfolio does not provide a way to create users other than through a command:

```bash
php bin/console app:create-user {email} {password} --admin
```

> Replace {*email*} with a valid email address and {*password*} with a password of at least 8 characters (though I encourage you to use a longer one).

### 6. Asset compilations

```bash
php bin/console importmap:install
php bin/console asset-map:compile

# This command is required for the EasyAdmin panel to work
php bin/console assets:install public --symlink --relative

php bin/console cache:clear --env=prod
php bin/console cache:warmup
```

---

If you have followed the instructions above, the website has been successfully deployed to production.

If you encounter any errors or feel that this documentation is incomplete, please don't hesitate to contact me.

> Try restarting your server if the changes don't take effect immediately (for Apache: `systemctl restart apache2`).
