<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");

$per_page = 5;
$start = 0;
$current_page = 1;
if (isset($_GET['start'])) {
    $start = $_GET['start'];
    if ($start <= 0) {
        $start = 0;
        $current_page = 1;
    } else {
        $current_page = $start;
        $start--;
        $start = $start * $per_page;
    }
}

$record = mysqli_num_rows(mysqli_query($conn, "SELECT id,fname from students"));
$page = ceil($record / $per_page);

$query = "SELECT id,fname from students limit $start,$per_page";
$sql = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container mt-100">
        <h2 class="mb-30">Pagination Example</h2>
        <ul class="list-group">
            <?php
            if (mysqli_num_rows($sql) > 0) {
                while ($row = mysqli_fetch_assoc($sql)) { ?>
                    <li class="list-group-item">
                        <?php echo $row['fname'] ?>
                    </li>
                <?php }
            } else { ?>
                No record found
            <?php } ?>
        </ul>
        <ul class="pagination mt-30">
            <?php

            for ($i = 1; $i <= $page; $i++) {
                $class = "";
                if ($current_page == $i) {
                    ?>
                    <li class="page-item active"><a href="Javascript:void(0)
                " class="page-link"><?php echo $i ?></a></li> <?php
                } else {
                    ?>
                    <li class="page-item"><a href="?start=<?php echo $i ?>
                        " class="page-link">
                            <?php echo $i ?>
                        </a></li>
                    <?php
                }
                ?>

            <?php } ?>
        </ul>
    </div>
</body>

</html>