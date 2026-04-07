<?php
session_start();
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!isset($_SESSION['user'])) {
    header("Location: Validation/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Php Ajax Crud</title>
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: #f4f6f9;
        }

        body.modal-open {
            padding-right: 0 !important;
            overflow: hidden;
        }

        html {
            overflow-y: scroll;
        }

        table.dataTable td {
            vertical-align: middle;
        }

        .modal-title {
            font-weight: 600;
        }

        .content,
        .teacher-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php include "sidebar/sidebar.php"; ?>

    <?php $page = $_GET['page'] ?? 'students'; ?>

    <div id="content">
        <?php if ($page == 'teacher') { ?>

            <!-- ================= TEACHER UI ================= -->
            <div class="container mt-5">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Teacher Management</h4>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#teacher_AddModal">
                            + Add Teacher
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-7">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" id="teacher_search_input" class="form-control" placeholder="Search here...">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <select id="teacher_status_filter" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-success w-100" id="teacher_search_btn">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </div>

                        <div id="teacher_data">
                            <?php include __DIR__ . "/sidebar/teacher/fetch_teacher.php"; ?>
                        </div>
                        <div id="teacher_pagination"></div>
                    </div>
                </div>
            </div>

            <?php include __DIR__ . "/sidebar/teacher/add_teacher.php"; ?>
            <?php include __DIR__ . "/sidebar/teacher/view_teacher.php"; ?>


        <?php } else { ?>

            <!-- ================= STUDENT UI ================= -->
            <div class="container mt-5">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Student Management</h4>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#student_AddModal">
                            + Add Student
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" id="search_input" class="form-control" placeholder="Search here...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <form method="post" action="crud/export.php">
                                    <button type="submit" class="btn btn-success" name="export">
                                        <i class="bi bi-download"></i> Export
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <select id="status_filter" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100" id="search_btn">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </div>
                        <div id="data"></div>
                        <div id="pagination"></div>
                    </div>
                </div>
            </div>

            <?php include __DIR__ . "/sidebar/student/add_student.php"; ?>
            <?php include __DIR__ . "/sidebar/student/view_modal.php"; ?>
            <?php include __DIR__ . "/sidebar/student/edit_modal.php"; ?>
            <?php include __DIR__ . "/sidebar/student/delete_modal.php"; ?>

        <?php } ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/customJS.js"></script>
    <script src="sidebar/script.js"></script>
</body>

</html>