<?php
header('Content-Type: application/json'); // JSON response

$conn = mysqli_connect("localhost", "root", "", "phpcrud");

$limit = 4;
$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
if ($page < 1)
    $page = 1;

$offset = ($page - 1) * $limit;

$search = isset($_POST['query']) ? $_POST['query'] : '';
$search = mysqli_real_escape_string($conn, $search);

$status = isset($_POST['status']) ? $_POST['status'] : '';
$status = mysqli_real_escape_string($conn, $status);

$where = [];
if ($search != '') {
    $where[] = "CONCAT(id,fname,lname,class,section,status) LIKE '%$search%'";
}
if ($status != '') {
    $where[] = "status = '$status'"; 
}

$where_sql = "";
if (!empty($where)) {
    $where_sql = " WHERE " . implode(" AND ", $where);
}

// Fetch data
$result = $conn->query("SELECT * FROM students $where_sql ORDER BY id DESC LIMIT $offset,$limit");

// Build table HTML
$table_html = '<table class="table table-bordered table-hover datatable w-100">
<thead class="bg-dark text-white">
<tr>
<th>ID</th>
<th>FIRST NAME</th>
<th>LAST NAME</th>
<th>CLASS</th>
<th>SECTION</th>
<th>STATUS</th>
<th>ACTION</th>
</tr>
</thead>
<tbody>';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // toggle checked property based on database
        $checked = $row['status'] == 'active' ? 'checked' : '';

        $status_toggle = "
        <div class='form-check form-switch'>
            <input class='form-check-input status-toggle' 
                   type='checkbox' 
                   data-id='{$row['id']}' 
                   $checked>
        </div>";

        $table_html .= "<tr>
            <td class='stu_id'>{$row['id']}</td>
            <td>{$row['fname']}</td>
            <td>{$row['lname']}</td>
            <td>{$row['class']}</td>
            <td>{$row['section']}</td>
            <td>$status_toggle</td>
            <td>
                <a href='#' class='btn badge btn-info viewbtn'><i class='bi bi-eye'></i></a>
                <a href='#' class='btn badge btn-primary edit_btn'><i class='bi bi-pencil-square'></i></a>
                <a href='#' class='btn badge btn-danger delete_btn'><i class='bi bi-trash'></i></a>
            </td>
        </tr>";
    }
} else {
    $table_html .= "<tr><td colspan='7'>No Record Found</td></tr>";
}

$table_html .= '</tbody></table>';

// Pagination HTML
$total = $conn->query("SELECT COUNT(*) as total FROM students $where_sql")->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);

$pagination_html = "<ul class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    $pagination_html .= "<li class='page-item'>
        <a href='#' class='btn btn-primary $active page-link d-inline-block me-2' data-page='$i'>$i</a>
    </li>";
}
$pagination_html .= "</ul>";

// Send JSON
echo json_encode([
    'table' => $table_html,
    'pagination' => $pagination_html
]);
