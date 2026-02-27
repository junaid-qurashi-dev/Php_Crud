<?php
require_once "config.php";

class Teacher {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // Add Teacher //
    public function addTeacher(){
        $stmt = $this->conn->prepare(
            "INSERT INTO teachers (name,email,phone,subject,salary,status)
             VALUES (?,?,?,?,?,?)"
        );

        $stmt->bind_param(
            "ssssss",
            $_POST['name'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['subject'],
            $_POST['salary'],
            $_POST['status']
        );
        if($stmt->execute()){
            echo "Teacher Added Successfully!";
        }else{

        echo "Teacher Added";
        }
    }


    // Fetch Teacher Data //
    public function fetchTeachers(){

        $query = "SELECT * FROM teachers ORDER BY id DESC";
        $result = $this->conn->query($query);

        while($row = $result->fetch_assoc()){
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['subject']}</td>
                <td>{$row['salary']}</td>
                        <td>
                            <button class='badge btn-sm toggleStatus 
                    ".($row['status']=='active' ? "badge bg-success" : "badge bg-danger")."'
                    data-id='{$row['id']}'
                    data-status='{$row['status']}'>
                    ".ucfirst($row['status'])."
                </button>
               </td>
                <td>
                <button class='btn btn-info btn-sm viewTeacher' value='{$row['id']}' title='View'>
                    <i class='bi bi-eye'></i>
                </button>

                <button class='btn btn-warning btn-sm editTeacher' value='{$row['id']}' title='Edit'>
                    <i class='bi bi-pencil-square'></i>
                </button>

                <button class='btn btn-danger btn-sm deleteTeacher' value='{$row['id']}' title='Delete'>
                    <i class='bi bi-trash'></i>
                </button>
            </td>
            </tr>
            ";
        }
    }
    

    // View Teacher Data //
    public function viewTeacher(){
        $id = $_POST['teacher_id'];
        $query = "SELECT * FROM teachers WHERE id='$id' LIMIT 1";
        $result = $this->conn->query($query);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            echo json_encode($row);
        }
    }

    // Update Teacher Data //
    public function updateTeacher(){
        $stmt = $this->conn->prepare("UPDATE teachers SET name=?, email=?, phone=?, subject=?, salary=?, status=? WHERE id=?");

        $stmt->bind_param(
            "ssssssi",
            $_POST['name'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['subject'],
            $_POST['salary'],
            $_POST['status'],
            $_POST['teacher_id']
        );

        if($stmt->execute()){
            echo "Teacher Updated Successfully! ";
        }else{
            echo "Updated Failed";
        }
    }

    // Delete Teacher //

    public function deleteTeacher(){
        $id = $_POST['teacher_id'];

        $stmt = $this->conn->prepare("DELETE FROM teachers WHERE id=?");
        $stmt->bind_param("i",$id);

        if($stmt->execute()){
            echo "Teacher Deleted Successfully!";
        }else{
            echo "Delteed Failed";
        }
    }


    // Toggle Status //
    public function toggleStatus(){
        $id = $_POST['teacher_id'];
        $currentStatus = $_POST['current_status'];

        $newStatus = ($currentStatus == 'active') ? 'inactive' : 'active';

        $stmt = $this->conn->prepare("UPDATE teachers SET status=? WHERE id=?");
        $stmt->bind_param("si",$newStatus,$id);
        if($stmt->execute()){
            echo $newStatus;
        }
    }

    // Dashboard Counts
public function dashboardCounts(){

    $total = $this->conn->query("SELECT COUNT(*) as total FROM teachers")->fetch_assoc()['total'];
    $active = $this->conn->query("SELECT COUNT(*) as active FROM teachers WHERE status='active'")->fetch_assoc()['active'];
    $inactive = $this->conn->query("SELECT COUNT(*) as inactive FROM teachers WHERE status='inactive'")->fetch_assoc()['inactive'];

    echo json_encode([
        'total' => $total,
        'active' => $active,
        'inactive' => $inactive
    ]);
}
}

$db = new Database();
$teacher = new Teacher($db->conn);

if(isset($_POST['checking_add'])){
    $teacher->addTeacher();
}

if(isset($_POST['fetch'])){
    $teacher->fetchTeachers();
}

if(isset($_POST['view_teacher'])){
    $teacher->viewTeacher();
}

if(isset($_POST['update_teacher'])){
    $teacher->updateTeacher();
}

if(isset($_POST['delete_teacher'])){
    $teacher->deleteTeacher();
}

if(isset($_POST['toggle_status'])){
    $teacher->toggleStatus();
}

if(isset($_POST['dashboard_counts'])){
    $teacher->dashboardCounts();
}