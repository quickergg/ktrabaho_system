<?php
include 'db_connection.php';

// Get employee information from URL parameters
$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];

// Fetch employee details
$query = "SELECT * FROM employees WHERE first_name = ? AND last_name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $first_name, $last_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $employee = $result->fetch_assoc();
    $employee_id = $employee['id'];
    $job_name = $employee['job_name'];
} else {
    die("Student not found!");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Home</title>
    <link rel="stylesheet" href="css/newstyle.css">
</head>

<body>
    <div class="employee-home">
        <h1>Welcome, <?php echo $first_name . ' ' . $last_name; ?>!</h1>
        <p><strong>Applied Jobs:</strong> <?php echo $job_name; ?></p>
        <p>Hi to our <?php echo $job_name ?>. See you there, kaTrabaho! </p>
        <a href="login.php" class="btn">Logout</a>
    </div>
</body>

</html>