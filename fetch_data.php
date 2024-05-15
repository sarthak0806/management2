<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "studentsdb";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Sorry, we failed to connect: " . mysqli_connect_error());
} else {
    echo "Connection was successful<br>";
}

// Assuming you have a valid database connection stored in $conn
$query = "SELECT * FROM class_1";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <table class="table table-success table-striped-columns">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Profile</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Father's Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Use a while loop to print all rows
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['Reg Id']; ?></td>
                    <td><img src="<?php echo $row['profile']; ?>" alt="Profile Image" style="max-width: 100px;"></td>
                    <td><?php echo $row['First Name']; ?></td>
                    <td><?php echo $row['Last Name']; ?></td>
                    <td><?php echo $row["Father's Name"]; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
