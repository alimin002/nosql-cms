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
                                <label>Nama Banner <font color="red">*</font></label>
                                <input value="<?php echo $data_row_banner->xid_seq; ?>" type="hidden" class="form-control" id="id_seq" name="id_seq">
                                <input value="<?php echo $data_row_banner->nama_banner; ?>" type="text" class="form-control" id="nama_banner" name="nama_banner">
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Deskripsi <font color="red">*</font></label>                              
                                <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo $data_row_banner->deskripsi; ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                                <label>Gambar:</label>
                                <div class="media no-margin-top">
                                    <div class="media-left">
                                        <a href="#"><img width="30" height="40" id="imgShow" src="<?php echo $data_row_banner->image_url;?>"></a>
                                    </div>

                                    <div class="media-body">
                                        <input id="imgInp" type="file" name="icon" class="file-styled">
                                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 1Mb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-link" onclick="close_modal()">Cancel</button> -->
                    <button type="submit" class="btn btn-success" id="tombol">Update</button>
                </div>
            </form>

        </div>
        </div>
</div>

<script type="text/javascript">

    $("#form_edit").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: '<?php echo site_url(); ?>banner/action_edit',
            type: "POST",          
            data:new FormData(this),
            dataType: 'json',
            processData:false,
            contentType:false,
            beforeSend: function () {
                blockID('#form_edit');
            },
            success: function (json) {
                console.log(json);
                if (json.code == 200) {
                    unblockID('#form_edit');
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
                //unblockID('#form_edit');
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
                unblockID('#form_edit');
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