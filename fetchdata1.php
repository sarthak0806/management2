<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "studentsdb";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Sorry, we failed to connect: " . mysqli_connect_error());
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
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 text-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">
                    + New Student
                </button>
            </div>
        </div>
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
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">New Student Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="studentForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="regId">Reg Id</label>
                            <input type="text" class="form-control" id="regId" name="regId" required>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="fathersName">Father's Name</label>
                            <input type="text" class="form-control" id="fathersName" name="fathersName" required>
                        </div>
                        <div class="form-group">
                            <label for="profile">Profile Image</label>
                            <input type="file" class="form-control" id="profile" name="profile" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('studentForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch('form.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Handle response and update table dynamically if needed
                console.log(data);
                location.reload(); // Reload the page to show the new student
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
