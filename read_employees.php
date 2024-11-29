<?php
include 'db_connection.php';

$query = "SELECT * FROM employees";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Employees</title>
    <link rel="stylesheet" href="css/newstyle.css">
</head>

<body>
    <div class="table-container">
        <h1>All Employees</h1>
        <?php if ($result->num_rows > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Job</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['job_name']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['education']; ?></td>
                            <td><?php echo $row['civil_status']; ?></td>
                            <td><?php echo $row['salary']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['contact_number']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['hire_date']; ?></td>
                            <td><?php echo $row['position']; ?></td>
                            <td>
                                <a href="update_employees.php?id=<?php echo $row['id']; ?>" class="edit-btn">Update</a>
                                <a href="delete_employee.php?id=<?php echo $row['id']; ?>" class="edit-btn">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No employees found.</p>
        <?php } ?>
        <a href="manager_home.php" class="btn">Back to Manager Home</a>
    </div>
</body>

</html>