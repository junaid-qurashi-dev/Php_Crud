<?php

$conn = mysqli_connect("localhost", "root", "", "Yahoo");
$query = "SELECT * FROM students";
$query_run = mysqli_query($conn, $query);
$output = "";
if (mysqli_num_rows($query_run) > 0) {
    $output = '<table border="1" width="100%" cellpadding="10px" cellspacing="0">
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Age</th>
    <th>Class</th>
    </tr>';
    while ($row = mysqli_fetch_assoc($query_run)) {
        $output .= "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['age']}</td><td>{$row['class']}</td></tr>";
    }
    $output .= "</table>";
    mysqli_close($conn);
    echo $output;
} else {
    echo "<h2>No Record Found</h2>";
}