<?php

$conn = mysqli_connect("localhost", "root", "", "login_register");

$limit = 5;
$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$offset = ($page - 1) * $limit;
$sql = mysqli_query($conn, "SELECT * FROM students LIMIT $offset,$limit");
?>
<ul>
    <?php
    while ($row = mysqli_fetch_assoc($sql)) {
        echo "<li>" . $row['name'] . "</li>";
    }
    ?>
</ul>

<?php
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"));
$total_page = ceil($total / $limit);
for ($i = 1; $i < $total_page; $i++) {
    echo "<a href='?page=$i' style='margin:5px'>$i </a>";
}