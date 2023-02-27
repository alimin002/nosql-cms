<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
       
            <div class="panel-heading">

                <?php echo $title ?>
                <button class='btn btn-default btn-xs pull-right' onclick="close_modal()">
                    <i class="fa fa-times" aria-hidden="true"></i>

                </button>


            </div>
            <div class="panel-body">

                <form method="post" id="form_edit">
                    <div class="modal-body">
                        <div class="form-group">

                            <div class="row" style="padding-bottom:10px">
                                <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                    <label>User Group <font color="red">*</font> </label><input type="text" name="user_group" placeholder="User Group" autocomplete="off" class="form-control" disabled value="<?php echo $user->group_name ?>" >
                                    <input type="hidden" name="groupId" id="groupId" value="<?php echo $user->user_group_id ?>">
                                    <input type="hidden" name="id" id="id" value="<?php echo encode($user->id_seq) ?>">
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-sm-3 form-group" id='colUsername' >
                                    <label>Username <font color="red">*</font></label><input type="text" name="userName" placeholder="Username" autocomplete="off" class="form-control" required value="<?php echo $user->username ?>" disabled> 
                                </div>

                                <div class="col-sm-3 form-group" id='colEmail' >
                                    <label>Email</label><input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control"  value="<?php echo $user->email ?>" >
                                </div> 

                                <div class="col-sm-3 form-group" id='colFirstName' >
                                    <label>First Name <font color="red">*</font></label><input type="text" name="firstName" placeholder="First Name" autocomplete="off" class="form-control" required value="<?php echo $user->first_name ?>" >
                                </div>

                                <div class="col-sm-3 form-group" id="colLastName" >
                                    <label>Last Name</label><input type="text" id="lastName" name="lastName" placeholder="Last Name" autocomplete="off" class="form-control"  value="<?php echo $user->last_name ?>">
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
            url: '<?php echo site_url(); ?>configuration/user/update',
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
                    //notif(json.header,json.message,json.theme);
                    alert(json.message);
                    // Swal.fire({
                    //     position: 'center',
                    //     icon: 'error',
                    //     title: json.message,
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                }
            },
            error: function (json) {
                unblockID('#form_edit');
                //notif('Error','Error','alert-styled-left bg-danger');
                alert("gagal update data");
                // Swal.fire({
                //     position: 'center',
                //     icon: 'error',
                //     title: "Error",
                //     showConfirmButton: false,
                //     timer: 1500
                // });
            },
            complete: function () {
                unblockID('#form_edit');
            }
        });
    });

</script>