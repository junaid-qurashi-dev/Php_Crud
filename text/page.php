<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-dark text-white">

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-atuo mt-5">
                <h3 class="mb-4">Pagination in Php & MySQL</h3>
                <table class="table table-white table-striped">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>VALUES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "phpcrud");
                        $query = "SELECT * FROM students";
                        $result = mysqli_query($conn, $query);
                        $total_records = mysqli_num_rows($result);
                        if ($total_records == 0) {
                            echo "<tr><td colspan='2'>No Records Found!</td></tr>";
                            exit;
                        }

                        $limit = 3;
                        $page = 1;

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        }

                        $start = ($page - 1) * $limit;
                        $query_limit = "SELECT * FROM students limit $start,$limit ";
                        $result_limit = mysqli_query($conn, $query_limit);

                        $i = $start + 1;
                        while ($data = mysqli_fetch_assoc($result_limit)) {
                            echo "<tr>
                            <th>$i</th>
                            <td>$data[fname]</td>
                            </tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                $total_pages = ceil($total_records / $limit);
                echo "<h4>$page/$total_pages</h4>";
                $disabled = ($page == 1) ? "disabled" : "";
                $pre = $page - 1;
                $pagination = "<nav>
                <ul class='pagination'>";
                if ($total_records > $limit) {
                    $pagination .= "<li class='page-item'><a class='page-link    $disabled' href='?page=1'>First</a></li>";
                    $pagination .= "<li class='page-item'><a class='page-link    $disabled' href='?page=$pre'>Pre</a></li>";
                    $disabled = ($page == $total_pages) ? "disabled" : "";
                    $next = $page + 1;
                    $pagination .= "<li class='page-item $disabled'><a class='page-link ' href='?page=$next'>Next</a></li>";
                    $pagination .= "<li class='page-item $disabled'><a class='page-link' href='?page=$total_pages'>Last</a></li>";
                }
                $pagination .= "</ul></nav>";
                echo $pagination;
                ?>
            </div>
        </div>
    </div>

</body>

</html>