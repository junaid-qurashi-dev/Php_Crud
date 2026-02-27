<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");

/// ADD ///
if (isset($_POST['checking_add'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $status = $_POST['status'];

    $query = "INSERT INTO students  (fname,lname,class,section,status)
              VALUES  ('$fname','$lname','$class','$section','$status')";

    if (mysqli_query($conn, $query)) {
        echo "Successfully added";
    } else {
        echo "Something went wrong";
    }
    exit;
}
if (isset($_POST['status_update'])) {
    $id = $_POST['stu_id'];
    $status = $_POST['status']; // active / inactive

    $query = "UPDATE students SET status='$status' WHERE id='$id'";
    mysqli_query($conn, $query);

    echo "success";
    exit;
}



/// VIEW ///
if (isset($_POST['checking_view'])) {
    $stu_id = $_POST['stu_id'];

    $query = "SELECT * FROM students WHERE id='$stu_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        header("Content-type: application/json");
        echo json_encode($row);
    }
    exit;
}



/// EDIT ///
if (isset($_POST['checking_edit'])) {
    $stu_id = $_POST['stu_id'];

    $query = "SELECT * FROM students WHERE id='$stu_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        header("Content-type: application/json");
        echo json_encode($row);
    }
    exit;
}


if (isset($_POST['checking_update'])) {
    $id = $_POST['stu_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $status = $_POST['status'];

    $query = "UPDATE students SET fname='$fname', lname='$lname', class='$class', section='$section', status='$status' WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        echo $return = "Successfully Update";
    } else {
        echo $return = "Something Went Wrong.!";
    }

}

if (isset($_POST['checking_delete'])) {
    $id = $_POST['stu_id'];
    $query = "DELETE FROM students WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo $return = "Successfully Deleted";
    }
}
exit;