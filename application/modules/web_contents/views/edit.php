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
                                <label>Nama Konten <font color="red">*</font></label>
                                <input type="hidden" value="<?php echo $data_row_pagecontent->id_seq; ?>" class="form-control" id="id_seq" name="id_seq">
                                <input type="text" value="<?php echo $data_row_pagecontent->page_name; ?>" class="form-control" id="page_name" name="page_name">
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Konten <font color="red">*</font></label>                              
                                <textarea class="form-control" id="page_content" name="page_content"><?php echo $data_row_pagecontent->page_content; ?></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="tombol">Simpan</button>
                </div>
            </form>

        </div>
        </div>
</div>

<script type="text/javascript">
   
    $(document).ready(function() {
        //$('#page_content').summernote();
        CKEDITOR.replace('page_content', {
            filebrowserUploadUrl:'<?php echo site_url(); ?>web_contents/upload_ckeditor',
            filebrowserBrowseUrl: '<?php echo site_url(); ?>web_contents/file_browser',
            filebrowserUploadMethod: 'form'
        });
    });

    $("#form_edit").submit(function (event) {
        event.preventDefault();
        for ( instance in CKEDITOR.instances ) 
        CKEDITOR.instances[instance].updateElement();
        //var textareaValue = $('#page_content').summernote('code');
        $.ajax({
            url: '<?php echo site_url(); ?>web_contents/action_edit',
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
                    alert(json.message);
                    close_modal();
                  
                    //    Swal.fire({
                    //     position: 'center',
                    //     icon: 'success',
                    //     title: json.message,
                    //     showConfirmButton: false,
                    //     timer: 1500                     
                    //   });
                   
                } else {
                    alert(json.message);
                   // unblockUI();
                   
                    //  Swal.fire({
                    //     position: 'center',
                    //     icon: 'error',
                    //     title: json.message,
                    //     showConfirmButton: false,
                    //     timer: 1500                     
                    //   });
                }
            },
            error: function (json) {
                //unblockID('#form_edit');
                //console.log(json);
                alert(json.message);
               
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
</script>