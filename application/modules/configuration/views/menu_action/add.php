<div class="col-md-5 col-md-offset-4">
    <div class="panel panel-default">
        <div class="panel-heading">          
                <?php echo $title ?>
                <button class='btn btn-default btn-xs pull-right' onclick="close_modal()">
                    <i class="fa fa-times" aria-hidden="true"></i>

                </button>          
        </div>
        <div class="panel-body">
            <form id="form_add" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Action Name <font color="red">*</font></label>
                        <input type="text" class="form-control" autocomplete="off" placeholder="Name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-link" onclick="close_modal()">Cancel</button> -->
                    <button type="submit" class="btn bg-angkasa2">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#form_add").submit(function (event) {
            blockID('#form_add');
            event.preventDefault();

            $.ajax({
                url: '<?php echo site_url(); ?>configuration/menu_action/action_add',
                type: "POST",
                data: $("#form_add").serialize(),
                dataType: 'json',
                success: function (json) {
                    if (json.code == 200) {
                        unblockID('#form_add');
                        close_modal();
                        alert(json.message);
                        //notif(json.header, json.message, json.theme);
                        $('#grid').datagrid('load');
                    } else {
                        unblockID('#form_add');
                        alert(json.message);
                        //notif(json.header, json.message, json.theme);
                    }
                },
                error: function () {
                    unblockID('#form_add');
                },
                complete: function () {
                    unblockID('#form_add');
                }
            });
        });
    });
</script>