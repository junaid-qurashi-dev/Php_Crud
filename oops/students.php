<?php
header("Content-Type: application/json");
require_once "config.php";

class Student
{

    private $conn;
    private $limit = 4;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /* ================= FETCH WITH SEARCH + PAGINATION ================= */

    public function fetchStudents()
    {

        $page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
        if ($page < 1)
            $page = 1;

        $offset = ($page - 1) * $this->limit;

        $search = $_POST['query'] ?? '';
        $status = $_POST['status'] ?? '';

        $where = [];
        $params = [];
        $types = "";

        if (!empty($search)) {
            $where[] = "CONCAT(id,fname,lname,class,section,status) LIKE ?";
            $params[] = "%$search%";
            $types .= "s";
        }

        if (!empty($status)) {
            $where[] = "status = ?";
            $params[] = $status;
            $types .= "s";
        }

        $where_sql = !empty($where) ? " WHERE " . implode(" AND ", $where) : "";

        /* -------- Main Query -------- */
        $sql = "SELECT * FROM students $where_sql ORDER BY id DESC LIMIT ?, ?";
        $stmt = $this->conn->prepare($sql);

        $types .= "ii";
        $params[] = $offset;
        $params[] = $this->limit;

        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        /* -------- Table HTML -------- */
        $table_html = '<table class="table table-bordered table-hover w-100">
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

                $badge = $row['status'] == 'active'
                    ? "<span class='badge bg-success'>Active</span>"
                    : "<span class='badge bg-danger'>InActive</span>";

                $table_html .= "<tr>
                    <td class='stu_id'>{$row['id']}</td>
                    <td>{$row['fname']}</td>
                    <td>{$row['lname']}</td>
                    <td>{$row['class']}</td>
                    <td>{$row['section']}</td>
                    <td>$badge</td>
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

        $table_html .= "</tbody></table>";

        /* -------- Pagination -------- */
        $count_sql = "SELECT COUNT(*) as total FROM students $where_sql";
        $count_stmt = $this->conn->prepare($count_sql);

        if (!empty($where)) {
            $count_stmt->bind_param(substr($types, 0, strlen($types) - 2), ...array_slice($params, 0, -2));
        }

        $count_stmt->execute();
        $total = $count_stmt->get_result()->fetch_assoc()['total'];
        $total_pages = ceil($total / $this->limit);

        $pagination_html = "<ul class='pagination'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $page) ? 'active' : '';
            $pagination_html .= "<li class='page-item'>
                <a href='#' class='btn btn-primary $active page-link me-2' data-page='$i'>$i</a>
            </li>";
        }
        $pagination_html .= "</ul>";

        echo json_encode([
            "table" => $table_html,
            "pagination" => $pagination_html
        ]);
    }

    /* ================= ADD ================= */
    public function addStudent()
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO students (fname,lname,class,section,status) VALUES (?,?,?,?,?)"
        );
        $stmt->bind_param(
            "sssss",
            $_POST['fname'],
            $_POST['lname'],
            $_POST['class'],
            $_POST['section'],
            $_POST['status']
        );

        echo $stmt->execute()
            ? json_encode(["message" => "Successfully Added"])
            : json_encode(["message" => "Error"]);
    }

    /* ================= GET (VIEW / EDIT) ================= */
    public function getStudent($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode($stmt->get_result()->fetch_assoc());
    }

    /* ================= UPDATE ================= */
    public function updateStudent()
    {
        $stmt = $this->conn->prepare(
            "UPDATE students SET fname=?, lname=?, class=?, section=?, status=? WHERE id=?"
        );
        $stmt->bind_param(
            "sssssi",
            $_POST['fname'],
            $_POST['lname'],
            $_POST['class'],
            $_POST['section'],
            $_POST['status'],
            $_POST['stu_id']
        );

        echo $stmt->execute()
            ? json_encode(["message" => "Successfully Updated"])
            : json_encode(["message" => "Error"]);
    }

    /* ================= DELETE ================= */
    public function deleteStudent($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id=?");
        $stmt->bind_param("i", $id);

        echo $stmt->execute()
            ? json_encode(["message" => "Successfully Deleted"])
            : json_encode(["message" => "Error"]);
    }
}

/* ================= CONTROLLER ================= */

$db = new Database();
$student = new Student($db->conn);

if (isset($_POST['type']) && $_POST['type'] == 'fetch') {
    $student->fetchStudents();
} elseif (isset($_POST['checking_add'])) {
    $student->addStudent();
} elseif (isset($_POST['checking_view']) || isset($_POST['checking_edit'])) {
    $student->getStudent($_POST['stu_id']);
} elseif (isset($_POST['checking_update'])) {
    $student->updateStudent();
} elseif (isset($_POST['checking_delete'])) {
    $student->deleteStudent($_POST['stu_id']);
}
?>