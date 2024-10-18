# Library Management System

A simple Library Management System built with Laravel that allows admins, librarians, and students to manage books, borrowing, and user activities. The system is built to follow the MVC architecture and adheres to SOLID principles and design patterns.

## Table of Contents
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Database](#database)
- [Usage](#usage)
- [Testing](#testing)

## Features
- **Admin Panel**
  - Manage users (add, edit, delete)
  - Manage books (add, edit, delete)
  
- **Librarian**
  - Manage books (borrow and return)
  - View book borrowing history
  
- **Students**
  - Search books by title, author, or genre
  - Borrow and return books
  - View borrowed books history

- **Penalty System**
  - Automatically calculate overdue penalties
  - Notifications for overdue books

## Requirements
- PHP >= 8.0
- Composer
- MySQL or PostgreSQL
- Laravel 9.x
- Node.js & NPM (for front-end assets)

## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/your-username/library-management-system.git
    cd library-management-system
    ```

2. **Install dependencies**:
    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Create a copy of the `.env` file**:
    ```bash
    cp .env.example .env
    ```

4. **Configure your database in the `.env` file**:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=library_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Generate the application key**:
    ```bash
    php artisan key:generate
    ```

6. **Run database migrations**:
    ```bash
    php artisan migrate
    ```

7. **Seed the database** (optional):
    ```bash
    php artisan db:seed
    ```

8. **Run the application**:
    ```bash
    php artisan serve
    ```

Visit the application in your browser at `http://localhost:8000`.

## Database

The database structure:

- **Users**: Stores user information (admin, librarian, student).
- **Books**: Stores book information (title, author, genre, etc.).
- **Borrowed Books**: Tracks books borrowed by students, with due dates and return status.
- **Penalties**: Tracks penalties for overdue books.

Refer to the ER Diagram and use case diagrams for more details on relationships.

## Usage

1. **Admin**:
    - Add, edit, and remove users.
    - Add, edit, and remove books.
  
2. **Librarian**:
    - Borrow books for students.
    - Return borrowed books.
  
3. **Student**:
    - Search and view available books.
    - Borrow and return books.

## Testing

Manual testing has been conducted to verify core functionalities, including:

- User and book management by admin
- Book borrowing and returning by librarians and students
- Notifications for overdue books and penalties

To run automated tests:
```bash
php artisan test
