<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");
if (!$conn) {
    die("Conncetion Failed: " . mysqli_connect_error());
}
$search = "";
if (isset($_POST['filter_btn'])) {
    $search = mysqli_real_escape_string($conn, $_POST['filter_value']);
    $query = "SELECT * FROM students WHERE CONCAT(fname,'',lname,'',class,'',section) LIKE '%$search%'";
} else {
    $query = "SELECT * FROM students";
}
$query_run = mysqli_query($conn, $query);
