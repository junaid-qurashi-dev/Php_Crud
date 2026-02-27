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
<script>
    $(document).ready(function () {
        $(document).on('click', '.delete_btn', function () {
            var stu_id = $(this).closest('tr').find('.stu_id').text();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "Crud/code.php",
                        type: "POST",
                        data: { checking_delete: true, stu_id: stu_id },
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // Redraw table after SweetAlert closes
                                if (typeof loaddata === "function") loaddata(1);
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Failed to delete student!',
                            });
                            console.log("AJAX Error:", error);
                        }
                    });
                }
            });
        });
    });
</script>