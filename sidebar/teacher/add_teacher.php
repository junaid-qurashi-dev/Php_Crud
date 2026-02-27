<div class="modal fade" id="teacher_AddModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Teacher</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control t_name">
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" class="form-control t_email">
                    </div>
                    <div class="col-md-6">
                        <label>Phone</label>
                        <input type="text" class="form-control t_phone">
                    </div>
                    <div class="col-md-6">
                        <label>Subject</label>
                        <input type="text" class="form-control t_subject">
                    </div>
                    <div class="col-md-6">
                        <label>Salary</label>
                        <input type="text" class="form-control t_salary">
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select class="form-control t_status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary teacher_add">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    function loadTeacher(){
        $.post("oops/teachers.php", {fetch:true}, function(response){
        $("#teacher_table_body").html(response);
        });
    }

    $(document).ready(function(){
        loadTeacher();
    });

    // Add Teachers //

    $(document).on('click','.teacher_add', function(){
        $.post("oops/teachers.php",{
            checking_add:true,
            name:$('.t_name').val(),
            email:$('.t_email').val(),
            phone:$('.t_phone').val(),
            subject:$('.t_subject').val(),
            salary:$('.t_salary').val(),
            status:$('.t_status').val()
        },
        function(response){
        $("#teacher_AddModal").modal('hide');
        Swal.fire({
            icon: 'success',
            title: 'Added',
            text: response,
        });
        loadTeacher();
        });
    });

    // Delete Teacher //

    $(document).on("click",".deleteTeacher",function(){
        var teacher_id = $(this).val();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able recover this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, Delete it!",
        }).then((result) => {
            if(result.isConfirmed){
                $.post("oops/teachers.php",{
                    delete_teacher: true,
                    teacher_id: teacher_id
                }, function(response){
                    Swal.fire(
                        'Deleted!',
                        response,
                        'success'
                    );
                    loadTeacher();
                })
            }
        })
    })
</script>