<?php foreach ($group_name as $key => $value) {
    
} ?>
<div class="col-md-5 col-md-offset-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $title ?>
            <button class='btn btn-default btn-xs pull-right' onclick="close_modal()">
                <i class="fa fa-times" aria-hidden="true"></i>

            </button>
        </div>
        <div class="panel-body">
            <form method="post" action="" id="form_edit">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Group Name <font color="red">*</font> </label>
                                <input type="text" name="group_name" value="<?php echo $value->group_name ?>" placeholder="Group Name" autocomplete="off" class="form-control" required>
                                <input type="hidden" value="<?php echo $id ?>" name="id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-angkasa2">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script type="text/javascript">
    $("#form_edit").submit(function (event) {
        blockID('#form_edit');
        event.preventDefault();

        $.ajax({
            url: '<?php echo site_url(); ?>configuration/user_group/update',
            type: "POST",
            data: $("#form_edit").serialize(),
            dataType: 'json',
            success: function (json) {
                if (json.code == 200) {
                    unblockID('#form_edit');
                    close_modal();
                    //notif(json.header,json.message,json.theme);
                    // Swal.fire({
                    //     position: 'center',
                    //     icon: 'success',
                    //     title: json.message,
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                    alert(json.message);
                    $('#grid').datagrid('load');
                } else {
                    unblockUI();
                    alert(json.message);
                    //notif(json.header,json.message,json.theme);
                    // Swal.fire({
                    //     position: 'center',
                    //     icon: 'error',
                    //     title: json.message,
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                }
            },
            error: function () {
                unblockID('#form_edit');
            },
            complete: function () {
                unblockID('#form_edit');
            }
        });
    });
</script>