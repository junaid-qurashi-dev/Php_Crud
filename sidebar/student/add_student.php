<!-- ADD STUDENT MODAL -->
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
                    <div class="col-md-12">
                        <label>Status</label>
                        <select class="form-control status">
                            <option value="active">Active</option>
                            <option value="inactive">InActive</option>
                        </select>
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

<!-- ADD STUDENT AJAX -->
<script>
    $(document).ready(function() {
        $('.student_add').click(function(e) {
            e.preventDefault();

            var fname = $('.fname').val();
            var lname = $('.lname').val();
            var stu_class = $('.class').val();
            var section = $('.section').val();
            var status = $('.status').val();

            if (fname && lname && stu_class && section && status) {
                $.ajax({
                    type: "POST",
                    url: "oops/students.php",
                    data: {
                        checking_add: true,
                        fname: fname,
                        lname: lname,
                        class: stu_class,
                        section: section,
                        status: status
                    },
                    success: function(response) {
                        // hide modal

                        let res = response
                        $('#student_AddModal').modal('hide');

                        // show SweetAlert2
                        Swal.fire({
                            icon: 'success',
                            title: 'Added!',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // reload table top page
                        // loaddata(1);
                        // clear modal inputs
                        $('.fname').val('');
                        $('.lname').val('');
                        $('.class').val('');
                        $('.section').val('');
                        $('.status').val('active'); // ya default value


                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                        console.log(error);
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
        $('#export').click(function() {
            window.location.href = "/Ajax/Crud/export.php";
        });
    });
</script>