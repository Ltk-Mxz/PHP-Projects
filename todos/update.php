<?php
require "config.php";

if (isset($_GET['upd_id'])) {
    $id = filter_var($_GET['upd_id'], FILTER_VALIDATE_INT);

    if ($id === false) {
        header("Location: index.php?status=invalid_id");
        exit;
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$row) {
            header("Location: index.php?status=not_found");
            exit;
        }

        if (isset($_POST["submit"])) {
            $task = trim($_POST['mytask']);

            if (!empty($task)) {
                $update = $conn->prepare("UPDATE tasks SET name = :name WHERE id = :id");
                $update->execute([':name' => $task, ':id' => $id]);
                header("Location: index.php?status=success");
                exit;
            }else{
                header("Location: update.php?upd_id=$id&status=empty_task");
                exit;
            }
        }
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération/mise à jour : " . $e->getMessage());
        header("Location: index.php?status=error");
        exit;
    }
}else{
    header("Location: index.php");
    exit;
}
?>

<?php include "header.php"; ?>

<?php if (isset($row)): ?>

<form method="POST" action="update.php?upd_id=<?php echo htmlentities($id); ?>" class="form-inline" id="user_form">
    <div class="form-group mx-sm-3 mb-2">
        <label for="task" class="sr-only">Update</label>
        <input name="mytask" type="text" class="form-control" id="task" placeholder="Enter task" value="<?php echo htmlentities($row->name); ?>" required>
    </div>
    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
</form>

<?php else: ?>
<p class="text-center">Task not found.</p>
<?php endif; ?>

<?php include "footer.php"; ?>