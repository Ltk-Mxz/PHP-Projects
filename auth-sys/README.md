### Updated README.md

```markdown
# Secure User Authentication System

This project is a secure user authentication system built using PHP, MySQL, and styled with Tailwind CSS. The system focuses on implementing robust security measures such as CSRF protection, password hashing, and session management.

## Key Features

- **Secure Login and Registration:**
  - Passwords are hashed using `password_hash()` to ensure secure storage.
  - User input is validated and sanitized to prevent SQL injection.

- **CSRF Protection:**
  - Unique CSRF tokens are generated for each form submission to protect against Cross-Site Request Forgery attacks.

- **Session Management:**
  - User sessions are securely managed to maintain authentication state.

- **Tailwind CSS Styling:**
  - The user interface is styled using Tailwind CSS for a modern and responsive design.

## Getting Started

### Prerequisites

- PHP 8.3 or higher
- MySQL
- Composer (for dependency management)

### Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/Ltk-Mxz/PHP-Projects/tree/main/auth-sys
    cd auth-sys
    ```

2. **Install dependencies:**

    ```sh
    composer install
    ```

3. **Set up the database:**

    - Create a new database called `auth_sys`.
    - Import the provided SQL file to set up the necessary tables.

    ```sql
    CREATE DATABASE auth_sys;
    USE auth_sys;
    SOURCE path/to/your/database.sql;
    ```

4. **Configure the application:**

    - Update the database credentials in the `config.php` file.

    ```php
    <?php
    $host = "localhost";
    $dbname = "auth_sys";
    $user = "root";
    $pass = "blabla";

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $conn = new PDO($dsn, $user, $pass, $options);

    // Uncomment below for debugging purposes
    // try {
    //     $conn = new PDO($dsn, $user, $pass, $options);
    // } catch (PDOException $e) {
    //     echo $e->getMessage();
    // }
    ?>
    ```

5. **Run the application:**

    - Start the PHP built-in server:

    ```sh
    php -S localhost:8000
    ```

    - Open your browser and navigate to `http://localhost:8000`.

## Usage

### Registration

- Fill out the registration form with your email, username, and password.
- Submit the form to create a new account.

### Login

- Fill out the login form with your registered email and password.
- Submit the form to log in to your account.

## Security Measures

- **Password Hashing:**
  - Passwords are hashed using the `password_hash()` function with the default algorithm (currently bcrypt).

- **CSRF Protection:**
  - Each form includes a unique CSRF token that is validated on submission to prevent CSRF attacks.

- **Session Management:**
  - User sessions are managed securely to maintain authentication state.

## Contributing

Contributions are welcome! Please fork this repository and submit pull requests.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgements

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
```
