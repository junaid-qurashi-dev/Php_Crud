<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Ajax Table</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
        }

        #main {
            width: 80%;
            margin: 40px auto;
            background: #fff;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #header {
            background: #0d6efd;
            color: white;
            padding: 15px;
            font-size: 20px;
            text-align: center;
            font-weight: bold;
        }

        #table-load {
            text-align: right;
            padding: 10px;
        }

        #load-button {
            padding: 8px 16px;
            background: #198754;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }

        #load-button:hover {
            background: #157347;
        }

        #table-data table {
            width: 100%;
            border-collapse: collapse;
        }

        #table-data th {
            background: #343a40;
            color: white;
            text-align: left;
            padding: 10px;
        }

        #table-data td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        #table-data tr:nth-child(even) {
            background: #f8f9fa;
        }

        #table-data tr:hover {
            background: #e9ecef;
        }
    </style>
</head>

<body>

    <table id="main">
        <tr>
            <td id="header">
                PHP with Ajax
            </td>
        </tr>
        <tr>
            <td id="table-load">
                <input type="button" id="load-button" value="Load Data">
            </td>
        </tr>
        <tr>
            <td id="table-data">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Class</th>
                    </tr>
                    <tr>
                        <td align="center">1</td>
                        <td>Junaid Quraishi</td>
                        <td>21</td>
                        <td>10th</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <script src="jquery/jquery.js"></script>

    <script>
        $(document).ready(function () {
            $("#load-button").on('click', function () {
                $.ajax({
                    url: "Crud/Yahoo.php",
                    type: "POST",
                    success: function (data) {
                        $('#table-data').html(data);
                    }
                });
            });
        });
    </script>

</body>

</html>