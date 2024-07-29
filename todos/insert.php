<?php
require "config.php";

if (isset($_POST["submit"])) {
    $task = trim($_POST['mytask']);

    if (!empty($task)) {
        try {
            $insert = $conn->prepare("INSERT INTO tasks (name) VALUES (:name)");
            $insert->execute([':name' => $task]);

            header("Location: index.php?status=success");
            exit;
        } catch (PDOException $e) {
            error_log("Erreur lors de l'insertion : " . $e->getMessage());
            header("Location: index.php?status=error");
            exit;
        }
    } else {
        header("Location: index.php?status=empty_task");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>