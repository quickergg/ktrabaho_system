<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    if ($role == 'employee') {
        $query = "SELECT * FROM employees WHERE first_name = ? AND last_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $first_name, $last_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: employee_home.php?first_name=$first_name&last_name=$last_name");
            exit;
        } else {
            $error = "Employee not found!";
        }
    } elseif ($role == 'manager') {
        $query = "SELECT * FROM manager WHERE first_name = ? AND last_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $first_name, $last_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: manager_home.php");
            exit;
        } else {
            $error = "Manager not found!";
        }
    } else {
        $error = "Invalid role!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/loginstyle.css">
</head>

<body>
    <div class="form-container">
        <h1>Login</h1>
        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="manager">Manager</option>
                <option value="employee">Employee</option>
            </select>
            <br><br>
            <label for="first_name">Username:</label>
            <input type="text" name="first_name" required>
            <br><br>
            <label for="last_name">Password:</label>
            <input type="password" name="last_name" required>
            <br><br>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>

</html>