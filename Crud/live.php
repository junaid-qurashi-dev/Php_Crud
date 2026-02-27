<?php

$conn = mysqli_connect("localhost", "root", "", "phpcrud");
$search = isset($_POST['query']) ? $_POST['query'] : "";
$search = mysqli_real_escape_string($conn, $search);
if ($search != '') {
    $where = "WHERE CONCAT(id,fname,lname,class,section,status) LIKE '%$search%'";
} else {
    $where = "";
}

$query = "SELECT * FROM students $where ORDER BY id DESC";
$result = mysqli_query($conn, $query);

$output = "<table class='table table-bordered'>
<thead class='table-dark'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Last Name</th>
<th>Class</th>
<th>Section</th>
<th>Status</th>
</tr>
</thead>
<tbody>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<tr>
        <td>' . $row['id'] . '</td>
        <td>' . $row['fname'] . '</td>
        <td>' . $row['lname'] . '</td>
        <td>' . $row['class'] . '</td>
        <td>' . $row['section'] . '</td>
        <td>' . $row['status'] . '</td>
        </tr>';
    }
} else {
    $output .= " <tr><td colspan='5' class='text-center'>No Records</td></tr>";
}
$output .= "</tboody></table>";
echo $output;

?>