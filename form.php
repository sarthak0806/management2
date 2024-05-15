<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-5">Registration Form</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $regId = htmlspecialchars($_POST['regId']);
                    $firstName = htmlspecialchars($_POST['firstName']);
                    $lastName = htmlspecialchars($_POST['lastName']);
                    $fathersName = htmlspecialchars($_POST['fathersName']);
                    $profileImage = "";

                    // File upload handling
                    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
                        $targetDir = "uploads/";
                        if (!file_exists($targetDir)) {
                            mkdir($targetDir, 0777, true);
                        }
                        $targetFile = $targetDir . basename($_FILES["profile"]["name"]);
                        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["profile"]["tmp_name"]);
                        if ($check !== false) {
                            if (move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFile)) {
                                $profileImage = $targetFile;
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>Sorry, there was an error uploading your file.</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>File is not an image.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Error uploading file: " . $_FILES['profile']['error'] . "</div>";
                    }

                    // Debugging: Output the profile image path
                    echo "<pre>Profile Image Path: $profileImage</pre>";

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

                    // Prepare and bind
                    $stmt = $conn->prepare("INSERT INTO class_1 (`Reg Id`, `First Name`, `Last Name`, `Father's Name`, profile) VALUES (?, ?, ?, ?, ?)");
                    if ($stmt === false) {
                        die("Prepare failed: " . htmlspecialchars($conn->error));
                    }

                    $bind = $stmt->bind_param("sssss", $regId, $firstName, $lastName, $fathersName, $profileImage);
                    if ($bind === false) {
                        die("Bind failed: " . htmlspecialchars($stmt->error));
                    }

                    $execute = $stmt->execute();
                    if ($execute) {
                        echo "<div class='alert alert-success' role='alert'>";
                        echo "<h4 class='alert-heading'>Form Submission Details</h4>";
                        echo "<p>Reg Id: " . $regId . "</p>";
                        echo "<p>First Name: " . $firstName . "</p>";
                        echo "<p>Last Name: " . $lastName . "</p>";
                        echo "<p>Father's Name: " . $fathersName . "</p>";
                        if ($profileImage) {
                            echo "<p>Profile Image: <img src='" . $profileImage . "' alt='Profile Image' style='max-width: 100px;'></p>";
                        }
                        echo "<hr>";
                        echo "<p class='mb-0'>Your data has been successfully saved.</p>";
                        echo "</div>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "Error: " . htmlspecialchars($stmt->error);
                        echo "</div>";
                    }

                    $stmt->close();
                    $conn->close();
                }
                ?>
                <form action="form.php" method="post" enctype="multipart/form-data">
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
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
