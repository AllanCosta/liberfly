![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![PHP](https://img.shields.io/badge/php-%5E7.3.33-blueviolet.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

#Liberfly API Test for Laravel PHP

**Teste Liberfly**

This is a Laravel project. Follow the steps below to set up the project on your local machine.

## Requirements

1. **PHP:** 7.3.33
2. **Node.js:** 22.4.1
3. **npm:** 10.8.1
4. **Composer:** 2.0.9

## Getting Started:

### Clone the Repository

```bash
     git clone https://github.com/AllanCosta/liberfly.git
     cd liberfly
```

### Install PHP Dependencies

```bash
     composer install
```

### Environment Configuration

Copy the **'.env.example'** file to **'.env'**:

```bash
cp .env.example .env
```

Create a database in **mysql** with the name liberfly or another name of your choice:

```plaintext
CREATE DATABASE [IF NOT EXISTS] database_name
[CHARACTER SET charset_name]
[COLLATE collation_name];
```

Edit the **'.env'** file with your preferred settings. Update the database configuration:

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=liberfly
DB_USERNAME=root
DB_PASSWORD=root
```

Generate the JWT secret key:

```bash
php artisan jwt:secret
```

This command will create a key and automatically add it to the **'.env'** file as **JWT_SECRET**.

### Generate Application Key

```bash
php artisan key:generate
```

This command will create a key and automatically add it to the **'.env'** file as **APP_KEY**.

### Run Migrations and Seeders

```bash
php artisan migrate --seed
```

## Running the Application

### Start the Local Development Server

```bash
php artisan serve
```

Your application should now be running on http://localhost:8000.

## API Documentation

This project uses Swagger Lume for API documentation. You can access the API documentation at http://localhost:8000/api/documentation.

## Troubleshooting

For any issues, refer to the Laravel documentation or the project's issue tracker on GitHub.
