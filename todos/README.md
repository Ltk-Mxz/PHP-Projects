# PHP Task Management Project

This project is a simple task management application built with PHP and MySQL, showcasing secure and robust CRUD operations.

## Features

- **Create, Read, Update, Delete (CRUD)** operations for tasks.
- **Input Validation and Sanitization**: Ensuring all input data is valid and safe using `filter_var`.
- **Prepared Statements**: Using PDO prepared statements to prevent SQL injection.
- **Error Handling**: Implementing try-catch blocks for robust error management.
- **User Feedback**: Adding status parameters to provide meaningful feedback to users.

## Getting Started

1. Clone the repository:
    ```bash
    git clone 
    ```

2. Navigate to the project directory:
    ```bash
    cd todos
    ```

3. Set up the database:
    - Import the `tasks.sql` file into your MySQL database.

4. Update the `config.php` file with your database credentials:
    ```php
    <?php
    $host = 'your_host';
    $db = 'your_database';
    $user = 'your_username';
    $pass = 'your_password';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    ?>
    ```

5. Run the application on a local server using XAMPP or similar.

## Usage

- **Create a Task**: Fill in the task form and submit.
- **Read Tasks**: View the list of tasks.
- **Update a Task**: Click the update button next to a task, modify the task, and submit.
- **Delete a Task**: Click the delete button next to a task.

## Contributing

Feel free to submit pull requests and issues. Contributions are welcome!
