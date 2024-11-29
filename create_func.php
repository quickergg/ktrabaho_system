<?php
include 'db_connection.php';
include 'create_employee.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $job_name = $_POST['job_name'];

    $query = "INSERT INTO employees (first_name, last_name, job_name) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $first_name, $last_name, $job_name);

    if ($stmt->execute()) {
        $success_message = "Employee added successfully!";
        // header('Location: ' . read_employees.php);
    } else {
        $error_message = "Error: " . $stmt->error;
    }
}
