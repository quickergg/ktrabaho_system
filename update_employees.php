<?php

include 'db_connection.php';

$success_message = $error_message = "";

// Check if the employee ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing employee record
    $query = "SELECT * FROM employees WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $employee = $result->fetch_assoc();
    } else {
        $error_message = "Employee not found.";
    }
} else {
    $error_message = "No employee ID provided.";
}

// Handle the form submission for updating
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $course_name = $_POST['course_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $education = $_POST['education'];
    $civil_status = $_POST['civil_status'];
    $salary = $_POST['salary'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $hire_date = $_POST['hire_date'];
    $position = $_POST['position'];

    $query = "UPDATE employees SET 
        first_name = ?, 
        last_name = ?, 
        course_name = ?, 
        age = ?, 
        gender = ?, 
        education = ?, 
        civil_status = ?, 
        salary = ?, 
        address = ?, 
        contact_number = ?, 
        email = ?, 
        hire_date = ?, 
        position = ? 
        WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssisssdsssssi",
        $first_name,
        $last_name,
        $course_name,
        $age,
        $gender,
        $education,
        $civil_status,
        $salary,
        $address,
        $contact_number,
        $email,
        $hire_date,
        $position,
        $id
    );

    if ($stmt->execute()) {
        $success_message = "Employee updated successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Employee</title>
    <link rel="stylesheet" href="css/newstyle.css">
</head>

<body>
    <div class="form-container">
        <h1>Update Employee Info</h1>
        <?php if ($error_message) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <?php if ($success_message) { ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php } ?>
        <?php if (isset($employee)) { ?>
            <form method="POST" action="update_employees.php">
                <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo $employee['first_name']; ?>" required>
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo $employee['last_name']; ?>" required>
                <label for="course_name">Course Name:</label>
                <input type="text" name="course_name" id="course_name" value="<?php echo $employee['course_name']; ?>" required>
                <label for="age">Age:</label>
                <input type="number" name="age" id="age" value="<?php echo $employee['age']; ?>" required>
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" required>
                    <option value="Male" <?php echo $employee['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $employee['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo $employee['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
                <label for="education">Education:</label>
                <input type="text" name="education" id="education" value="<?php echo $employee['education']; ?>" required>
                <label for="civil_status">Civil Status:</label>
                <select name="civil_status" id="civil_status" required>
                    <option value="Single" <?php echo $employee['civil_status'] == 'Single' ? 'selected' : ''; ?>>Single</option>
                    <option value="Married" <?php echo $employee['civil_status'] == 'Married' ? 'selected' : ''; ?>>Married</option>
                    <option value="Divorced" <?php echo $employee['civil_status'] == 'Divorced' ? 'selected' : ''; ?>>Divorced</option>
                    <option value="Widowed" <?php echo $employee['civil_status'] == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                </select>
                <label for="salary">Salary:</label>
                <input type="number" step="0.01" name="salary" id="salary" value="<?php echo $employee['salary']; ?>" required>
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" value="<?php echo $employee['address']; ?>" required>
                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" id="contact_number" value="<?php echo $employee['contact_number']; ?>" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $employee['email']; ?>" required>
                <label for="hire_date">Hire Date:</label>
                <input type="date" name="hire_date" id="hire_date" value="<?php echo $employee['hire_date']; ?>" required>
                <label for="position">Position:</label>
                <input type="text" name="position" id="position" value="<?php echo $employee['position']; ?>" required>
                <br><br>
                <button type="submit" class="btn">Update Employee</button>
            </form>
        <?php } ?>
        <a href="read_employees.php" class="btn">Back to Employee List</a>
    </div>
</body>

</html>