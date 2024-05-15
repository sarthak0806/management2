<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Admission Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col text-center">
                <h2>New Admission Form</h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6 offset-md-3">
                <form action="submit.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="regId" class="form-label">Reg Id</label>
                        <input type="text" class="form-control" id="regId" name="regId" required>
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="fathersName" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="fathersName" name="fathersName" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="profile" name="profile" required>
                    </div>
                    <div class="mb-3">
                        <label for="className" class="form-label">Class</label>
                        <select class="form-select" id="className" name="className" required>
                            <option value="" selected disabled>Select Class</option>
                            <?php
                            // Generate options for classes from 1 to 10
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<option value='class_$i'>Class $i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
