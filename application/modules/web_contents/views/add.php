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
                                <label>Nama Konten <font color="red">*</font></label>
                                <input type="text" class="form-control" id="page_name" name="page_name">
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:10px">
                            <div class="col-sm-12 form-group" style="padding-bottom:5px">
                                <label>Konten <font color="red">*</font></label>                              
                                <textarea class="form-control" id="page_content" name="page_content"></textarea>
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
        // $('#page_content').summernote();
        CKEDITOR.replace('page_content', {
            filebrowserUploadUrl:'<?php echo site_url(); ?>web_contents/upload_ckeditor',
            filebrowserBrowseUrl: '<?php echo site_url(); ?>web_contents/file_browser',
            filebrowserUploadMethod: 'form'
        });
    });

    $("#form_add").submit(function (event) {
        event.preventDefault();
        //var textareaValue = $('#page_content').summernote('code');
        for ( instance in CKEDITOR.instances ) 
        CKEDITOR.instances[instance].updateElement();
        $.ajax({
            url: '<?php echo site_url(); ?>web_contents/action_add',
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
                   // unblockUI();
                     alert(json.message);
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

    /*
     $("#colUsername").hide();
     $("#colEmail").hide();
     $("#colPassword").hide();
     $("#colFirstName").hide();
     $("#colLastName").hide();
     $("#tombol").hide();
     
     $('#userGroup').on('change',function(){
     
     var userId=$('#userGroup').val();
     
     if(userId=='3' || userId=='6')
     {
     $("#colUsername").show();
     $("#colEmail").show();
     $("#colPassword").show();
     $("#colFirstName").show();
     $("#colLastName").show();
     $("#colSheter").show();
     $("#colLane").hide();
     $("#colDeviceTerminal").show();
     $("#colPo").hide();
     $("#colMerchant").hide();
     $("#colMerchantPassword").hide();
     $("#tombol").show();
     
     $("#userName").attr('required','required');
     // $("#email").attr('required','required');
     $("#password").attr('required','required');
     $("#firstName").attr('required','required');
     // $("#lastName").attr('required','required');
     
     $("#shelterId").attr('required','required');
     $("#deviceTerminal").attr('required','required');
     $("#po").removeAttr('required');
     $("#lane").removeAttr('required');
     $("#merchant").removeAttr('required');
     $("#generatePass").removeAttr('required');
     
     
     }
     else if (userId=='7')
     {
     $("#colUsername").show();
     $("#colEmail").show();
     $("#colPassword").show();
     $("#colFirstName").show();
     $("#colLastName").show();
     $("#colSheter").show();
     $("#colLane").show();
     $("#colDeviceTerminal").show();
     $("#colPo").hide()
     $("#colMerchant").hide();
     $("#colMerchantPassword").hide();
     $("#tombol").show();
     
     $("#userName").attr('required','required');
     // $("#email").attr('required','required');
     $("#password").attr('required','required');
     $("#firstName").attr('required','required');
     // $("#lastName").attr('required','required');
     
     $("#shelterId").attr('required','required');
     $("#deviceTerminal").attr('required','required');
     $("#po").removeAttr('required');
     $("#lane").attr('required','required');
     $("#merchant").removeAttr('required');
     $("#generatePass").removeAttr('required');
     }
     
     else if(userId=="")
     {
     $("#colUsername").hide();
     $("#colEmail").hide();
     $("#colPassword").hide();
     $("#colFirstName").hide();
     $("#colLastName").hide();
     $("#colSheter").hide();
     $("#colLane").hide();
     $("#colDeviceTerminal").hide();
     $("#colPo").hide();
     $("#colMerchant").hide();
     $("#colMerchantPassword").hide();
     $("#tombol").hide();			
     }
     
     else if(userId=='8' )
     {
     $("#colUsername").show();
     $("#colEmail").show();
     $("#colPassword").show();
     $("#colFirstName").show();
     $("#colLastName").show();
     $("#colSheter").hide();
     $("#colLane").hide();
     $("#colDeviceTerminal").show();
     $("#colPo").hide();
     $("#colMerchant").hide();
     $("#colMerchantPassword").hide();
     $("#tombol").show();
     
     $("#userName").attr('required','required');
     // $("#email").attr('required','required');
     $("#password").attr('required','required');
     $("#firstName").attr('required','required');
     // $("#lastName").attr('required','required');
     
     $("#shelterId").removeAttr('required');
     $("#deviceTerminal").attr('required','required');
     $("#po").removeAttr('required');
     $("#lane").removeAttr('required');
     $("#merchant").removeAttr('required');
     $("#generatePass").removeAttr('required');
     }
     else if (userId=='5')
     {
     $("#colUsername").show();
     $("#colEmail").show();
     $("#colPassword").show();
     $("#colFirstName").show();
     $("#colLastName").show();
     $("#colSheter").show();
     $("#colLane").hide();
     $("#colDeviceTerminal").hide();
     $("#colPo").show();
     $("#colMerchant").hide();
     $("#colMerchantPassword").hide();
     $("#tombol").show();
     
     
     $("#userName").attr('required','required');
     // $("#email").attr('required','required');
     $("#password").attr('required','required');
     $("#firstName").attr('required','required');
     // $("#lastName").attr('required','required');
     
     $("#shelterId").attr('required','required');
     $("#deviceTerminal").removeAttr('required');
     $("#po").attr('required','required');
     $("#lane").removeAttr('required');
     $("#merchant").removeAttr('required');
     $("#generatePass").removeAttr('required');
     }
     else if (userId=='4')
     {
     $("#colUsername").show();
     $("#colEmail").show();
     $("#colPassword").show();
     $("#colFirstName").show();
     $("#colLastName").show();
     $("#colSheter").hide();
     $("#colLane").hide();
     $("#colDeviceTerminal").show();
     $("#colPo").hide();
     $("#colMerchant").hide();
     $("#colMerchantPassword").hide();
     $("#tombol").show();
     
     $("#userName").attr('required','required');
     // $("#email").attr('required','required');
     $("#password").attr('required','required');
     $("#firstName").attr('required','required');
     // $("#lastName").attr('required','required');
     
     $("#shelterId").removeAttr('required');
     $("#deviceTerminal").attr('required','required');
     $("#po").removeAttr('required');
     $("#lane").removeAttr('required');
     $("#merchant").removeAttr('required');
     $("#generatePass").removeAttr('required');	
     
     getDevicePos();	
     
     }
     else if (userId=='9')
     {
     $("#colUsername").show();
     $("#colEmail").hide();
     $("#colPassword").hide();
     $("#colFirstName").hide();
     $("#colLastName").hide();
     $("#colSheter").hide();
     $("#colLane").hide();
     $("#colDeviceTerminal").hide();
     $("#colPo").hide();
     $("#colMerchant").show();
     $("#colMerchantPassword").show();
     $("#tombol").show();
     
     
     $("#userName").attr('required','required');
     // $("#email").removeAttr('required');
     $("#password").removeAttr('required');
     $("#firstName").removeAttr('required');
     // $("#lastName").removeAttr('required');
     
     $("#shelterId").removeAttr('required');
     $("#deviceTerminal").removeAttr('required');
     $("#po").removeAttr('required');
     $("#lane").removeAttr('required');
     $("#merchant").attr('required','required');
     $("#generatePass").attr('required','required');	
     
     
     $("#generatePass").keydown(function(e){
     e.preventDefault();
     });
     }
     
     else if (userId=='11')
     {
     $("#colUsername").show();
     $("#colEmail").hide();
     $("#colPassword").show();
     $("#colFirstName").show();
     $("#colLastName").show();
     $("#colSheter").hide();
     $("#colLane").hide();
     $("#colDeviceTerminal").hide();
     $("#colPo").show();
     $("#colMerchant").hide();
     $("#colMerchantPassword").hide();
     $("#tombol").show();
     
     
     $("#userName").attr('required','required');
     // $("#email").removeAttr('required');
     $("#password").attr('required','required');
     $("#firstName").attr('required','required');
     // $("#lastName").removeAttr('required');
     
     $("#shelterId").removeAttr('required');
     $("#deviceTerminal").removeAttr('required');
     $("#po").attr('required','required');
     $("#lane").removeAttr('required');
     $("#merchant").removeAttr('required');
     $("#generatePass").removeAttr('required');	
     
     }
     else
     {
     $("#colUsername").show();
     $("#colEmail").show();
     $("#colPassword").show();
     $("#colFirstName").show();
     $("#colLastName").show();
     $("#colSheter").hide();
     $("#colLane").hide();
     $("#colDeviceTerminal").hide();
     $("#colPo").hide();
     $("#colMerchant").hide();
     $("#colMerchantPassword").hide();
     $("#tombol").show();
     
     $("#userName").attr('required','required');
     // $("#email").attr('required','required');
     $("#password").attr('required','required');
     $("#firstName").attr('required','required');
     // $("#lastName").attr('required','required');
     
     $("#shelterId").removeAttr('required');
     $("#deviceTerminal").removeAttr('required');
     $("#po").removeAttr('required');
     $("#lane").removeAttr('required');
     $("#merchant").removeAttr('required');
     $("#generatePass").removeAttr('required');
     
     }
     
     $('#shelterId').on('change',function(){
     var id=$("#shelterId").val();
     $.ajax({
     type:"post",
     url:"<?php //echo site_url('web_contents/dataLane') ?>",
     dataType:"json",
     data:"id="+id,
     success:function(x)
     {
     var html="<option value=''>Select</option>";
     
     for(var i=0; i < x.length; i++)
     {
     
     html+="<option value='"+x[i].id_seq+"'>"+x[i].lane_name+"</option>";
     }
     
     $("#lane").html(html);
     }
     });
     
     });
     
     // getTerminalDevice();
     // function getTerminalDevice()
     // {
     // 	$.ajax({
     // 		type:"post",
     // 		url:"<?php //echo site_url('web_contents/getTerminalDevice');  ?>",
     // 		dataType:"json",
     // 		data:"id="+userId,
     // 		success:function(x)
     // 		{
     // 			// console.log(x);
     // 			var isi="<option value=''>Select</option>";
     // 			for(var i=0; i< x.length ; i++)
     // 			{
     // 				isi +="<option>"+x[i].terminal_name+"</option>";
     // 			}
     // 			 $("#deviceTerminal").html(isi);
     // 		}
     // 	});
     // }
     
     
     
     function getDevicePos()
     {
     $.ajax({
     type:"post",
     url:"<?php //echo site_url() ?>web_contents/getDevicePos",
     dataType:"json",
     success:function(x){
     // console.log(x);
     
     var isi="<option value=''>Select</option>";
     
     for(var i=0;i<x.length;i++)
     {
     isi +="<option value='"+x[i].id_seq+"'>"+x[i].terminal_name+"</option>"
     }
     
     $('#deviceTerminal').html(isi);
     
     // console.log(isi);
     
     }
     });	
     }
     
     });
     
     function generate()
     {	
     $.ajax({
     url:"<?php //echo site_url()  ?>web_contents/generateCode",
     dataType:"json",
     beforeSend: function(){
     blockID('#form_add');
     },
     success:function(x)
     {
     $("#generatePass").val(x);
     unblockID('#form_add');
     }
     });
     }
     
     $("#openPass").on("change",function(){
     if(this.checked)
     {
     $("#generatePass").attr('type','text');
     }
     else
     {
     $('#generatePass').attr('type','password');	
     }
     });
     
     $("#merchant").on("keyup",function(){
     
     // console.log($('#merchant').val());
     var x= $('#merchant').val();
     
     //remove space
     // var y=x.replace(/\s+/g, '');
     var y=x.replace(/\s+/g, '.');
     
     $("#userName").val(y.toLowerCase());
     
     });
     */

</script>