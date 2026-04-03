<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");
$sql = "select * from students limit 5";
$result = mysqli_query($conn, $sql);
$finalData = array();
while ($data = mysqli_fetch_array($result)) {
    $finalData[] = $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Name</th>
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
                    <th><?php echo $data[1] ?></th>
                    <th><?php echo $data['lname'] ?></th>
                    <th><?php echo $data[3] ?></th>
                    <th><?php echo $data[4] ?></th>
                    <th><?php echo $data['status'] ?></th>

                </tr>
            <?php }  ?>

        </tbody>
    </table>
</body>

</html>