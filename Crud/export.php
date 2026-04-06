<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");
$sql = "Select * From students";
$result = mysqli_query($conn, $sql);
$finalData = array();
while ($data = mysqli_fetch_assoc($result)) {
    $finalData[] = $data;
}
if (isset($_POST['export'])) {
    $filename = "StuDentReport" . date('Ymdhis') . ".xls";
    header("Content-Type:application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $firstrow = false;
    // $customeheader = [
    //     "id" => "ID",
    //     "fname" => "First Name",
    //     "lname" => "Last Name",
    //     "class" => "Class",
    //     "section" => "Section",
    //     "status" => "Status",
    // ];
    echo "ID\tFisrt Name\tLast Name\tClass\tsection\tStatus\n";
    foreach ($finalData as $data) {
        if (!$firstrow) {
            // echo implode("\t", $customeheader) . "\n";   
            $firstrow = true;
        }
        echo implode("\t", array_values($data)) . "\n";
    }
    exit;
}
