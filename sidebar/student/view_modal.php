<div class="modal fade modal-lg" id="ViewModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Student Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><b>ID:</b> <span class="id_view"></span></p>
                <p><b>Name:</b> <span class="fname_view"></span></p>
                <p><b>Last Name:</b> <span class="lname_view"></span></p>
                <p><b>Class:</b> <span class="class_view"></span></p>
                <p><b>Section:</b> <span class="section_view"></span></p>
                <p><b>Status:</b> <span class="status_view"></span></p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(document).on('click', '.viewbtn', function () {
            var stu_id = $(this).closest('tr').find('.stu_id').text();
            $.ajax({
                url: "Crud/code.php",
                type: "POST",
                dataType: "json",
                data: { checking_view: true, stu_id: stu_id },
                success: function (response) {
                    $('.id_view').text(response.id);
                    $('.fname_view').text(response.fname);
                    $('.lname_view').text(response.lname);
                    $('.class_view').text(response.class);
                    $('.section_view').text(response.section);
                    $('.status_view').html(response.status == 'active' ?
                        '<span class="badge bg-success">Active</span>' :
                        '<span class="badge bg-danger">InActive</span>'
                    );
                    $('#ViewModal').modal('show');
                }
            });
        });
    });
</script>