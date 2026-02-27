<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Search Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <h3 class="mb-3">Student List (Live Search)</h3>
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="search_input" class="form-control mb-3" placeholder="Search here....">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" id="search_btn">Search</button>
            </div>
        </div>
    </div>
    <div class="table_data">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            load_data('');

            $("#search_btn").click(function () {
                var query = $("#search_input").val();
                load_data(query);
            });
            function load_data(query = '') {
                $.ajax({
                    url: "Crud/live.php",
                    method: "POST",
                    data: { query: query },
                    success: function (data) {
                        $(".table_data").html(data);
                    }
                });
            }
        });
    </script>
</body>

</html>