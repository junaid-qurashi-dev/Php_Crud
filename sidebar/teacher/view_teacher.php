<div class="modal fade" id="viewTeacherModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Teacher Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td id="view_name"></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td id="view_phone"></td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td id="view_subject"></td>
                    </tr>
                    <tr>
                        <th>Salary</th>
                        <td id="view_salary"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td id="view_status"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // View Teacher
$(document).ready(function(){
    $(document).on('click','.viewTeacher',function(){
        var teacher_id = $(this).val();

        $.post("oops/teachers.php",{
            view_teacher: true,
            teacher_id: teacher_id
        },function (response){
            var data = JSON.parse(response);

            $('#view_name').text(data.name);
            $('#view_phone').text(data.phone);
            $('#view_subject').text(data.subject);
            $('#view_salary').text(data.salary);
            $('#view_status').text(data.status);

            $("#viewTeacherModal").modal("show");
    });
    });
});
  
</script>