<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Php Ajax Crud</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.6/css/dataTables.bootstrap5.min.css"
        rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        table.dataTable td {
            vertical-align: middle;
        }

        .modal-title {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Student Management (AJAX CRUD)</h4>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#student_AddModal">
                    + Add Student
                </button>
            </div>

            <div class="card-body">
                <div class="message-show mb-3"></div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover datatable w-100" id="StudentTable">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="studentdata"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="student_AddModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Student</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" class="form-control fname">
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control lname">
                        </div>
                        <div class="col-md-6">
                            <label>Class</label>
                            <input type="text" class="form-control class">
                        </div>
                        <div class="col-md-6">
                            <label>Section</label>
                            <input type="text" class="form-control section">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary student_add">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW MODAL -->
    <div class="modal fade modal-lg" id="ViewModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Student Details</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><b>ID:</b> <span class="id_view"></span></p>
                    <p><b>Name:</b> <span class="fname_view"></span> <span class="lname_view"></span></p>
                    <p><b>Class:</b> <span class="class_view"></span></p>
                    <p><b>Section:</b> <span class="section_view"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="EditModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Student</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" id="edit_fname" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" id="edit_lname" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Class</label>
                            <input type="text" id="edit_class" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Section</label>
                            <input type="text" id="edit_section" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary student_update_ajax">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="DeleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Confirm Delete</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <input type="hidden" id="delete_id">
                    <p>Are you sure you want to delete?</p>
                    <button class="btn btn-danger student_delete_ajax">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // $(document).ready(function () {
        //     $('#StudentTable').DataTable();
        // });
    </script>
    <script>
        $(document).ready(function () {
            getdata();

            $('.student_delete_ajax').click(function (e) {
                e.preventDefault();
                var stu_id = $('#delete_id').val();
                $.ajax({
                    url: "Crud/code.php",
                    type: "POST",

                    data: {
                        'checking_delete': true,
                        'stu_id': stu_id,
                    },
                    success: function (response) {
                        console.log(response);
                        // var data = json.parse(response);
                        $('#DeleteModal').modal('hide');
                        $('.message-show').append('\
                                <div class="alert alert-success alert-dismissible fade show" role="alert">\
                  <strong>Hey!</strong> '+ response + '.\
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\
                </div>\
                ');
                        $('.studentdata').html("");
                        getdata();
                    }
                });
            });
            $(document).on('click', '.delete_btn', function () {
                var stu_id = $(this).closest('tr').find('.stu_id').text();
                $('#delete_id').val(stu_id);
                $('#DeleteModal').modal('show');
                // $.ajax({
                //     url: "Crud/code.php",
                //     type: "POST",
                //     dataType: "json",
                //     data: {
                //         'checking_delete': true,
                //         'stu_id': stu_id,
                //     },
                //     success: function (response) {
                //         console.log(response);
                //         // var data = json.parse(response);

                //         $('.message-show').append('\
                //                 <div class="alert alert-success alert-dismissible fade show" role="alert">\
                //   <strong>Hey!</strong> '+ response + '.\
                //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\
                // </div>\
                // ');
                //         $('.studentdata').html("");
                //         getdata();
                //     }
                // });
            });

            $('.student_update_ajax').click(function (e) {
                e.preventDefault();
                var stu_id = $('#edit_id').val();
                var fname = $('#edit_fname').val();
                var lname = $('#edit_lname').val();
                var stu_class = $('#edit_class').val();
                var section = $('#edit_section').val();
                // console.log(fname);

                if (fname != '' && lname != '' && stu_class != '' && section != '') {
                    $.ajax({
                        type: "POST",
                        url: "Crud/code.php",

                        data: {
                            'checking_update': true,
                            'stu_id': stu_id,
                            'fname': fname,
                            'lname': lname,
                            'class': stu_class,
                            'section': section,
                        },
                        success: function (response) {
                            // console.log(response);
                            $('#EditModal').modal('hide');
                            $('.message-show').append('\
                <div class="alert alert-success alert-dismissible fade show" role="alert">\
  <strong>Hey!</strong> '+ response + '.\
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\
</div>\
');
                            $('.studentdata').html("");
                            getdata();
                        }
                    });
                } else {
                    $('.error-message-update').append('\
                <div class="alert alert-warning alert-dismissible fade show" role="alert">\
  <strong>Hey!</strong> Please enter all fields.\
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\
</div>\
');
                }
            });
            /// View Student Data //
            $(document).on('click', '.viewbtn', function () {
                var stu_id = $(this).closest('tr').find('.stu_id').text();
                // alert(stu_id);
                $.ajax({
                    url: "Crud/code.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'checking_view': true,
                        'stu_id': stu_id,
                    },
                    success: function (response) {
                        // console.log(response);
                        // var data = json.parse(response);
                        $.each(response, function (key, stuview) {
                            // console.log(stuview['fname']);
                            $('.id_view').text(stuview['id']);
                            $('.fname_view').text(stuview['fname']);
                            $('.lname_view').text(stuview['lname']);
                            $('.class_view').text(stuview['class']);
                            $('.section_view').text(stuview['section']);
                        });
                        $('#ViewModal').modal('show');
                    }
                })
            });

            /// Update Student Data //
            $(document).on('click', '.edit_btn', function () {
                var stu_id = $(this).closest('tr').find('.stu_id').text();
                // alert(stu_id);
                $.ajax({
                    url: "Crud/code.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'checking_edit': true,
                        'stu_id': stu_id,
                    },
                    success: function (response) {
                        console.log(response);
                        // var data = json.parse(response);
                        $.each(response, function (key, stuedit) {
                            console.log(stuedit);
                            $('#edit_id').val(stuedit['id']);
                            $('#edit_fname').val(stuedit['fname']);
                            $('#edit_lname').val(stuedit['lname']);
                            $('#edit_class').val(stuedit['class']);
                            $('#edit_section').val(stuedit['section']);
                        });
                        $('#EditModal').modal('show');
                    }
                })
            });


            // Student Add Data //
            $('.student_add').click(function (e) {
                e.preventDefault();
                var fname = $('.fname').val();
                var lname = $('.lname').val();
                var stu_class = $('.class').val();
                var section = $('.section').val();
                // console.log(fname);

                if (fname != '' && lname != '' && stu_class != '' && section != '') {
                    $.ajax({
                        type: "POST",
                        url: "Crud/code.php",
                        data: {
                            'checking_add': true,
                            'fname': fname,
                            'lname': lname,
                            'class': stu_class,
                            'section': section,
                        },
                        success: function (response) {
                            // console.log(response);
                            $('#student_AddModal').modal('hide');
                            $('.message-show').append('\
                <div class="alert alert-success alert-dismissible fade show" role="alert">\
  <strong>Hey!</strong> '+ response + '.\
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\
</div>\
');
                            $('.studentdata').html("");
                            getdata();
                            $('.fname').val("");
                            $('.lname').val("");
                            $('.class').val("");
                            $('.section').val("");
                        }
                    });
                } else {
                    $('.error-message').append('\
                <div class="alert alert-warning alert-dismissible fade show" role="alert">\
  <strong>Hey!</strong> Please enter all fields.\
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\
</div>\
');
                }
            });
        });

        /// Student Data Show //
        function getdata() {
            $.ajax({
                type: "GET",
                url: "Crud/ajax-load.php",
                success: function (response) {
                    var jsonData = JSON.parse(response)
                    // console.log(response);
                    $.each(jsonData, function (key, value) {

                        $('.studentdata').append('<tr>' +
                            '<td class="stu_id">' + value['id'] + '</td>\
                            <td>'+ value['fname'] + '</td>\
                            <td>'+ value['lname'] + '</td>\
                            <td>'+ value['class'] + '</td>\
                            <td>'+ value['section'] + '</td>\
                          <td>\
                                <a href="#"class="btn badge btn-info viewbtn">View</a>\
                                <a href="#"class="btn badge btn-primary edit_btn">EDIT</a>\
                                <a href="#"class="btn badge btn-danger delete_btn">Delete</a>\
                            </td>\
                        </tr>');
                    });
                    $('#StudentTable').DataTable({
                        columnDefs: [
                            { target: 5, orderable: false }
                        ]
                    });
                }
            });

        }
    </script>

</body>

</html>