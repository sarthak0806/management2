<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Display</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
// Get class name from query parameter
$className = isset($_GET['class']) ? $_GET['class'] : '';

// Validate class name to prevent SQL injection
if (!preg_match('/^class_\d+$/', $className)) {
    die("Invalid class name");
}

// Database connection
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "studentsdb"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the selected class table
$query = "SELECT * FROM $className";
$result = $conn->query($query);

// Display data in a table
if ($result->num_rows > 0) {
    echo "<table class='table table-striped table-bordered'>";
    echo "<thead><tr><th>Reg Id</th><th>Profile</th><th>First Name</th><th>Last Name</th><th>Father's Name</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Reg Id'] . "</td>";
        echo "<td><img src='" . $row['profile'] . "' alt='Profile Image' style='max-width: 100px;'></td>";
        echo "<td>" . $row['First Name'] . "</td>";
        echo "<td>" . $row['Last Name'] . "</td>";
        echo "<td>" . $row["Father's Name"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No data available";
}

$conn->close();
?>
</body>
</html>