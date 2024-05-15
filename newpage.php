<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col text-center">
                <h2>School Dashboard</h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col text-center">
                <?php
                // Generate buttons for each class
                for ($i = 1; $i <= 10; $i++) {
                    echo "<button class='btn btn-primary m-2' onclick='fetchData(\"class_$i\")'>Class $i</button>";
                }
                ?>
                <button class="btn btn-success" onclick="openForm()">New Admission</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function fetchData(className) {
            // Redirect to fetch page with selected class
            window.location.href = "fetchdata2.php?class=" + className;
        }

        function openForm() {
            // Open form page for new admission
            window.open("form2.php", "_blank", "width=600,height=600");
        }
    </script>
</body>
</html>
