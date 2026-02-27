<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

$search_value = "";

// Agar search button click hua
if (isset($_POST['filter_btn'])) {
    $search_value = mysqli_real_escape_string($conn, $_POST['filter_value']);

    $query = "SELECT * FROM students 
              WHERE CONCAT(fname,' ',lname,' ',class,' ',section) 
              LIKE '%$search_value%'";
} else {
    // Default page load par sab data show kare
    $query = "SELECT * FROM students";
}

$query_run = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Students</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header">
                <h4>Search Students</h4>
            </div>

            <div class="card-body">

                <!-- Search Form -->
                <form method="POST">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="filter_value" value="<?= $search_value ?>" class="form-control"
                                placeholder="Search by name, class, section">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="filter_btn" class="btn btn-primary">
                                Search
                            </button>
                            <a href="search.php" class="btn btn-secondary">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                <table class="table table-bordered table-striped mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Class</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $row['id']; ?>
                                    </td>
                                    <td>
                                        <?= $row['fname']; ?>
                                    </td>
                                    <td>
                                        <?= $row['lname']; ?>
                                    </td>
                                    <td>
                                        <?= $row['class']; ?>
                                    </td>
                                    <td>
                                        <?= $row['section']; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center text-danger'>No Record Found</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>