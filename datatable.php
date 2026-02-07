<?php
$con = mysqli_connect("localhost", "root", "", "login_register");
$res = mysqli_query($con, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Students</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS (jQuery stable) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-dt@1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container mt-5">
        <table class="table table-striped datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Marks</th>
                    <th style="display:none;">Email</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= $row['marks'] ?></td>
                        <td style="display:none;"><?= $row['email'] ?></td>
                        <td>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.datatable').DataTable();
        });
    </script>

</body>

</html>