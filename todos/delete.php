<?php
require "config.php";

if (isset($_GET['del_id'])) {
    $id = filter_var($_GET['del_id'], FILTER_VALIDATE_INT);

    if ($id !== false) {
        try {
            $delete = $conn->prepare("DELETE FROM tasks WHERE id = :id");
            $delete->execute([':id' => $id]);

            if ($delete->rowCount() > 0) {
                header("Location: index.php?status=success");
                exit;
            } else {
                header("Location: index.php?status=not_found");
                exit;
            }
        }catch (PDOException $e) {
            error_log("Erreur lors de la suppression : " . $e->getMessage());
            header("Location: index.php?status=error");
            exit;
        }
    }else{
        header("Location: index.php?status=invalid_id");
        exit;
    }
}else{
    header("Location: index.php");
    exit;
}
?>