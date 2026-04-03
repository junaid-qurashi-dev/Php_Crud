<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");
$sql = "select * From students";
$result = mysqli_query($conn, $sql);
$finalData = array();
while ($data = mysqli_fetch_assoc($result)) {
    $finalData[] = $data;
}
// print_r($finalData);
if (isset($_POST['export'])) {
    $filename = "data" . date('Ymdhis') . ".xls";
    header("Content-Type:application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $firstrow = false;
    foreach ($finalData as $data) {
        if (!$firstrow) {
            echo implode("\t", array_keys($data)) . "\n";
            $firstrow = true;
        }
        echo implode("\t", array_values($data)) . "\n";
    }

    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <form method="post">
        <input type="submit" class="btn btn-success" name="export" value="Export to Excel">
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Class</th>
                <th>Section</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($finalData as $data) { ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['fname']; ?></td>
                    <td><?php echo $data['lname']; ?></td>
                    <td><?php echo $data['class']; ?></td>
                    <td><?php echo $data['section']; ?></td>
                    <td><?php echo $data['status']; ?></td>

                </tr>

            <?php   } ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>