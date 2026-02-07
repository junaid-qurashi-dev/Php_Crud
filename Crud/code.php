<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");

/// ADD ///
if (isset($_POST['checking_add'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $class = $_POST['class'];
    $section = $_POST['section'];

    $query = "INSERT INTO students (fname,lname,class,section)
              VALUES ('$fname','$lname','$class','$section')";

    if (mysqli_query($conn, $query)) {
        echo "Successfully added";
    } else {
        echo "Something went wrong";
    }
    exit;
}

/// VIEW ///
if (isset($_POST['checking_view'])) {
    $stu_id = $_POST['stu_id'];

    $query = "SELECT * FROM students WHERE id='$stu_id'";
    $query_run = mysqli_query($conn, $query);
    $result_array = [];

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            $result_array[] = $row;
        }
        header("Content-type: application/json");
        echo json_encode($result_array);
    }
    exit;
}

/// EDIT ///
if (isset($_POST['checking_edit'])) {
    $stu_id = $_POST['stu_id'];

    $query = "SELECT * FROM students WHERE id='$stu_id'";
    $query_run = mysqli_query($conn, $query);
    $result_array = [];

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            $result_array[] = $row;
        }
        header("Content-type: application/json");
        echo json_encode($result_array);
    }
    exit;
}


if (isset($_POST['checking_update'])) {
    $id = $_POST['stu_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $class = $_POST['class'];
    $section = $_POST['section'];

    $query = "UPDATE students SET fname='$fname', lname='$lname', class='$class', section='$section' WHERE id='$id'";
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
} else {
    echo $return = "Something went wrong";
}