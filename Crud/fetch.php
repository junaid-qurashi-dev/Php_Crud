<?php
// 🔹 Database connection banaya
$conn = new mysqli("localhost", "root", "", "phpcrud");

// 🔹 Ek page par kitne records dikhane hain
$limit = 5;

// 🔹 Page number check kar rahe hain (AJAX se aa raha hai)
// Agar page set nahi hai to default page = 1
$page = isset($_POST['page']) ? $_POST['page'] : 1;

// 🔹 Offset calculate kar rahe hain
// Formula: (current page - 1) * limit
$offset = ($page - 1) * $limit;

// 🔹 Database se limited data fetch kar rahe hain
// LIMIT offset se start karke limit tak data laata hai
$result = $conn->query("SELECT * FROM students LIMIT $offset, $limit");
?>
<!-- // 🔹 Loop chala kar data show kar rahe hain -->
<table class="table table-bordered table-hover datatable w-100">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Class</th>
            <th>Section</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
            <td>{$row['fname']}</td>
            <td>{$row['lname']}</td>
            <td>{$row['class']}</td>
            <td>{$row['section']}</td>
            </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>NO Record Found</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- // ================= PAGINATION LOGIC ================= // -->
<?php
// 🔹 Table me total kitne records hain, ye count kar rahe hain
$total = $conn->query("SELECT COUNT(*) as total FROM students")
    ->fetch_assoc()['total'];

// 🔹 Total pages calculate kar rahe hain
// ceil() isliye use hota hai taaki decimal na aaye
$total_pages = ceil($total / $limit);

// 🔹 Pagination buttons print kar rahe hain
echo "<ul class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    $active = ($i == $page) ? 'active' : "";
    // 🔹 data-page attribute me page number bhej rahe hain
    // AJAX isi value se data load karega
    echo "<li class='page-item'><a href='#' class='btn btn-primary $active page-link d-inline-block me-2' data-page='$i'>$i</a></li>";
}
echo "</ul>";
?>