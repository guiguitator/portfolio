# portfolio

My personal portfolio website describing my current academic background and highlighting all my public projects.

All texts displayed are written in French, my native language. The code, file names, etc. are written in English for the sake of clarity. 

## Build with

### Technologies

- **PHP** 8.3
- **Composer** 2.9
- **MySQL** 9.1
- **CSS** & **JavaScript**

### Librairies

- **[parsedown](https://github.com/erusev/parsedown)** 1.7
- **[phpdotenv](https://github.com/vlucas/phpdotenv)** 5.6
- **[simple-php-router](https://github.com/skipperbent/simple-php-router)** 5.4

## Installation

### Requirements

- PHP ≥ 8.3
- Composer
- MySQL or MariaDB
- Web server

### Getting Started

```bash
# 1. Clone the repository
git clone https://github.com/guiguitator/portfolio.git
cd portfolio

# 2. Install PHP dependencies
composer install

# 3. Copy the example environment file
cp .env.example .env

# 4. Edit .env with your own database credentials
```

#### `.env` example

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=portfolio_db
DB_USER=root
DB_PASS=
```

### Database Setup

1. Create a new database (e.g. *portfolio_db*)
2. Import `database.sql` file:
```bash
mysql -u your_username -p your_database < database.sql
```

## Contributing

Feel free to open an issue or submit a pull request if you find a bug or want to suggest an improvement.

## License

This project is licensed under the **MIT License**. See the [LICENSE](LICENSE.txt) file for details.