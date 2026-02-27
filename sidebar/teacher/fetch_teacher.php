<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Subject</th>
            <th>Salary</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="teacher_table_body">
    </tbody>
</table>


<!-- Toggle Status -->
 <script>
    $(document).on("click","toggleStatus",function(){
        var button = $(this);
        var teacher_id = button.data('id');
        var current_status = button.data('status');

        var newStatusText = current_status == 'active' ? 'Inactive' : 'Active';

        Swal.fire({
            title: "Are you sure? ",
            text: "Change status to " + newStatusText + "?",
            icon: "warning",
             confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Change it!'
        }).then((result)=>{
            if(result.isConfirmed){
                $.post("oops/teachers.php",{
                    toggle_status: true,
                    teacher_id: teacher_id,
                    current_status: current_status
                }, function(newStatus){
                    button.removeClass('badge-success btn-danger');
                    if(newStatus.trim() == 'active'){
                        button.addClass('badge-success');
                    }else{
                        button.addClass('btn-danger');
                    }
                    button.text(newStatus.charAt(0).toUpperCase()+ newStatus.slice(1));
                    button.data('status',newStatus);

                    Swal.fire(
                        'Updated!',
                        'Status change successfully!',
                        'success'
                    );
                    loadDashboradCounts();
                });
            }
        });
    });
 </script>