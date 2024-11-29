<?php
include 'db_connection.php';

$error_message = $success_message = "";

// Check if the Employee ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the record if confirmed
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        $query = "DELETE FROM employees WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $success_message = "Employee record deleted successfully!";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }
} else {
    $error_message = "No employee ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Delete Employee</title>
    <link rel="stylesheet" href="css/newstyle.css">
</head>

<body>
    <div class="form-container">
        <h1>Delete Employee</h1>
        <?php if ($error_message) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } elseif ($success_message) { ?>
            <p class="success"><?php echo $success_message; ?></p>
            <a href="read_employees.php" class="btn">Back to Employee List</a>
        <?php } else { ?>
            <p>Are you sure you want to delete this employee?</p>
            <a href="delete_employee.php?id=<?php echo $id; ?>&confirm=yes" class="btn">Yes, Delete</a>
            <a href="read_employees.php" class="btn">Cancel</a>
        <?php } ?>
    </div>
</body>

</html>