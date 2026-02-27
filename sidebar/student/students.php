<h2>Student Management</h2>

<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Students</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#student_AddModal">
            + Add Student
        </button>
    </div>

    <div class="card-body">

        <div class="row mb-3">
            <div class="col-md-7">
                <input type="text" id="search_input" class="form-control" placeholder="Search here...">
            </div>
            <div class="col-md-3">
                <select id="status_filter" class="form-select">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success w-100" id="search_btn">Search</button>
            </div>
        </div>

        <div id="data"></div>
        <div id="pagination"></div>

    </div>
</div>

<?php include "add_student.php"; ?>
<?php include "edit_modal.php"; ?>
<?php include "delete_modal.php"; ?>
<?php include "view_modal.php"; ?>