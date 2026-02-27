<div class="modal fade" id="EditTeacherModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Edit Teacher</h5>
                <button class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="edit_id">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="">Name</label>
                        <input type="text" class="form-control edit_name">
                    </div>
                    <div class="col-md-6">
                        <label for="">Email</label>
                        <input type="text" class="form-control edit_email">
                    </div>
                    <div class="col-md-6">
                        <label for="">Phone</label>
                        <input type="text" class="form-control edit_phone">
                    </div>
                    <div class="col-md-6">
                        <label for="">Subject</label>
                        <input type="text" class="form-control edit_subject">
                    </div>
                    <div class="col-md-6">
                        <label for="">Salary</label>
                        <input type="text" class="form-control edit_salary">
                    </div>
                    <div class="col-md-6">
                        <label for="">Status</label>
                        <select class="form-control edit_status">
                            <option value="active">Active</option>
                            <option value="inactive">InActive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning updateTeacher">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click','.editTeacher',function(){
        var teacher_id = $(this).val();

        $.post("oops/teachers.php",{
            view_teacher: true,
            teacher_id: teacher_id,
        }, function(response){

        var data = JSON.parse(response);
        $(".edit_id").val(data.id);
        $(".edit_name").val(data.name);
        $(".edit_email").val(data.email);
        $(".edit_phone").val(data.phone);
        $(".edit_subject").val(data.subject);
        $('.edit_salary').val(data.salary);
        $('#EditTeacherModal').modal('show');
        });

        $(document).on('click','.updateTeacher',function(){
            $.post("oops/teachers.php",{
                update_teacher: true,
                teacher_id: $('.edit_id').val(),
                name: $('.edit_name').val(),
                email: $('.edit_email').val(),
                phone: $('.edit_phone').val(),
                subject: $('.edit_subject').val(),
                salary: $('.edit_salary').val(),
                status: $('.edit_status').val()
            }, function(response){
                $('#EditTeacherModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text:response
                });
                console.log($('.edit_status').val());
                loadTeacher();
            })
        })
    });
</script>