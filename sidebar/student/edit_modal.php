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
                    <div class="col-md-12">
                        <label>Status</label>
                        <select id="edit_status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">InActive</option>
                        </select>
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
<script>
    $(document).ready(function () {
        // Load student data into edit modal
        $(document).on('click', '.edit_btn', function () {
            var stu_id = $(this).closest('tr').find('.stu_id').text();
            $.ajax({
                url: "Crud/code.php",
                type: "POST",
                dataType: "json",
                data: { checking_edit: true, stu_id: stu_id },
                success: function (response) {
                    $('#edit_id').val(response.id);
                    $('#edit_fname').val(response.fname);
                    $('#edit_lname').val(response.lname);
                    $('#edit_class').val(response.class);
                    $('#edit_section').val(response.section);
                    $('#edit_status').val(response.status);
                    $('#EditModal').modal('show');
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to load student data!',
                    });
                    console.log("AJAX Error:", error);
                }
            });
        });

        // Update student
        $(document).off('click', '.student_update_ajax').on('click', '.student_update_ajax', function (e) {
            e.preventDefault();

            var stu_id = $('#edit_id').val();
            var fname = $('#edit_fname').val();
            var lname = $('#edit_lname').val();
            var stu_class = $('#edit_class').val();
            var section = $('#edit_section').val();
            var status = $('#edit_status').val();

            if (fname && lname && stu_class && section && status) {
                $.ajax({
                    type: "POST",
                    url: "Crud/code.php",
                    data: {
                        checking_update: true,
                        stu_id: stu_id,
                        fname: fname,
                        lname: lname,
                        class: stu_class,
                        section: section,
                        status: status
                    },
                    success: function (response) {
                        $('#EditModal').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: response,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        loaddata(1); // refresh table after update
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to update student!',
                        });
                        console.log("AJAX Error:", error);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Please fill all fields!',
                });
            }
        });
    });
</script>