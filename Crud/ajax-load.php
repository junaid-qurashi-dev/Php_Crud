<?php

$conn = mysqli_connect("localhost", "root", "", "phpcrud");
$query = "SELECT * FROM students ORDER BY id DESC";
$query_run = mysqli_query($conn, $query);
$result_array = [];
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $item) {
        array_push($result_array, $item);
    }
    header("Content-type: application/JSON");
}
echo json_encode($result_array);