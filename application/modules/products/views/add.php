<div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $title ?>
            <button class='btn btn-default btn-xs pull-right' onclick="close_modal()">
                <i class="fa fa-times" aria-hidden="true"></i>
              
                </button>
        </div>
        <div class="panel-body">
            
            <form method="post" id="form_add">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Product Name<font color="red">*</font></label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Varietas<font color="red">*</font></label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Photo<font color="red">*</font></label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Photo<font color="red">*</font></label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Price<font color="red">*</font></label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Stock<font color="red">*</font></label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Description<font color="red">*</font></label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                        </div>
                    
                        </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-link" onclick="close_modal()">Cancel</button> -->
                    <button type="submit" class="btn btn-success" id="tombol">Simpan</button>
                </div>
            </form>

        </div>
        </div>
</div>

<script type="text/javascript">

    $("#form_add").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: '<?php echo site_url(); ?>users/action_add',
            type: "POST",          
            data:new FormData(this),
            dataType: 'json',
            processData:false,
            contentType:false,
            beforeSend: function () {
                blockID('#form_add');
            },
            success: function (json) {
                console.log(json);
                if (json.code == 200) {
                    unblockID('#form_add');
                    $('#grid').datagrid('load');
                    close_modal();
                    alert(json.message);
                  
                    //    Swal.fire({
                    //     position: 'center',
                    //     icon: 'success',
                    //     title: json.message,
                    //     showConfirmButton: false,
                    //     timer: 1500                     
                    //   });
                   
                } else {
                   // unblockUI();
                   
                    //  Swal.fire({
                    //     position: 'center',
                    //     icon: 'error',
                    //     title: json.message,
                    //     showConfirmButton: false,
                    //     timer: 1500                     
                    //   });
                    alert(json.message);
                }
            },
            error: function (json) {
                //unblockID('#form_add');
                console.log(json);
               
                //  Swal.fire({
                //         position: 'center',
                //         icon: 'error',
                //         title: json.message,
                //         showConfirmButton: false,
                //         timer: 1500                     
                //       });
            },
            complete: function () {
                unblockID('#form_add');
            }
        });
    });

    function readURL(input)
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader();

                reader.onload = function (e)
                {
                    $('#imgShow').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });

    

</script>