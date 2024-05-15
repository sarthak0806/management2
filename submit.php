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
                exit(); // Exit script if file upload fails
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>File is not an image.</div>";
            exit(); // Exit script if file is not an image
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error uploading file: " . $_FILES['profile']['error'] . "</div>";
        exit(); // Exit script if file upload error occurs
    }

    // Get selected class from the form
    $className = isset($_POST['className']) ? $_POST['className'] : '';

    // Validate class name to prevent SQL injection
    if (!preg_match('/^class_\d+$/', $className)) {
        echo "<div class='alert alert-danger' role='alert'>Invalid class name</div>";
        exit(); // Exit script if invalid class name
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

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO $className (`Reg Id`, `First Name`, `Last Name`, `Father's Name`, profile) VALUES (?, ?, ?, ?, ?)");
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
} else {
    // Redirect back to the form page if accessed directly without form submission
    header("Location: form.php");
    exit();
}
?>
