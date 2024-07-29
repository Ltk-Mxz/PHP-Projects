<?php
require "config.php";

try {
    $stmt = $conn->prepare("SELECT * FROM tasks");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php include "header.php"; ?>
<div class="container">
    <form method="POST" action="insert.php" class="form-inline" id="user_form">
        <div class="form-group mx-sm-3 mb-2">
            <label for="task" class="sr-only">Create</label>
            <input name="mytask" type="text" class="form-control" id="task" placeholder="Enter task" required>
        </div>
        
        <input type="submit" name="submit" class="btn btn-primary" value="Insert">
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Task Name</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rows)): ?>
                <?php foreach($rows as $row): ?>   
                    <tr>
                        <td><?php echo htmlentities($row->id); ?></td>
                        <td><?php echo htmlentities($row->name); ?></td>
                        <td><a href="delete.php?del_id=<?php echo urlencode($row->id); ?>" class="btn btn-danger">Delete</a></td>
                        <td><a href="update.php?upd_id=<?php echo urlencode($row->id); ?>" class="btn btn-warning">Update</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No tasks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>