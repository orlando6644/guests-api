# 🎉 Guest Management API

A RESTful API built with **CodeIgniter 4** to manage event guests.

---

## 🚀 Features

- Create, list, retrieve, update, and delete guests
- Input validation (name and email)
- Database: MySQL
- JSON responses

---

## 🧱 Requirements

- PHP 8.x
- Composer
- MySQL 5.7+
- CodeIgniter 4.x

---

## ⚙️ Installation

1. Clone the repository:
  ```bash
    git clone https://github.com/orlando6644/guests-api.git
    cd guests-api
  ```
2. Install dependencies:
  ```bash
    composer install
  ```
3. Configure environment:
- Copy env example file to .env and set your database credentials:
  ```bash
    database.default.hostname = localhost
    database.default.database = guests_db
    database.default.username = root
    database.default.password = root
    database.default.DBDriver = MySQLi
  ```
4. Run migrations:
  ```bash
  php spark migrate
  ```
5. Start the local development server:
  ```bash
    php spark serve
  ```

## 📌 API Endpoints

- `GET /api/guests` — List all guests
- `GET /api/guests/{id}` — Retrieve a guest by ID
- `POST /api/guests` — Create a new guest
- `PUT /api/guests/{id}` — Update an existing guest
- `DELETE /api/guests/{id}` — Soft delete a guest

### Example request to create a guest

```json
POST /api/guests
{
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "555-1234"
}
```
### Example request to retrieve a guest by ID

```http
GET /api/guests/1
```

### Example request to update a guest

```json
PUT /api/guests/1
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "phone": "555-5678"
}
```

### Example request to soft delete a guest

```http
DELETE /api/guests/1
```

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
