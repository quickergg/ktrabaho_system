<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $job_name = $_POST['job_name'];

    $query = "INSERT INTO employees (first_name, last_name, job_name) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $first_name, $last_name, $job_name);

    if ($stmt->execute()) {
        $success_message = "Employee added successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add New Employee</title>
    <link rel="stylesheet" href="css/newstyle.css">
</head>

<body>
    <div class="form-container">
        <h1>Add New Employee</h1>
        <?php if (isset($success_message)) { ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="POST" action="create_employee.php">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required>
            <br><br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required>
            <br><br>
            <label for="job_name">Job Name:</label>
            <input type="text" name="job_name" id="job_name" required>
            <br><br>
            <button type="submit" class="btn">Add Employee</button>
        </form>
        <a href="manager_home.php" class="btn">Back to Manager Home</a>
        <?php
        echo '<br>';
        include 'read_employees.php' ?>
    </div>
</body>

</html>