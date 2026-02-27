<!DOCTYPE html>
<html>

<head>
    <title>AJAX Pagination</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <h2>Posts</h2>

    <div id="data"></div>
    <div id="pagination"></div>

    <script>
        // function loadData(page) {
        //     $.ajax({
        //         url: "Crud/fetch.php",
        //         type: "POST",
        //         data: { page: page },
        //         success: function (response) {
        //             $("#data").html(response);
        //         }
        //     });
        // }

        // first load
        loadData(1);

        // pagination click
        $(document).on("click", ".page-link", function (e) {
            e.preventDefault();
            var page = $(this).data("page");
            loadData(page);
        });
    </script>

</body>

</html>