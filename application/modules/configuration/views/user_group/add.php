 <div class="col-md-5 col-md-offset-4">
	
    <div class="panel panel-default">
             <div class="panel-heading">
            <?php echo $title ?>
            <button class='btn btn-default btn-xs pull-right' onclick="close_modal()">
                <i class="fa fa-times" aria-hidden="true"></i>
              
                </button>
            </div>
		<div class="panel-body">
			<form method="post" action="" id="form_add">
				<div class="modal-body">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-12 form-group">
								<label>Group Name <font color="red">*</font></label>
								<input type="text" name="group_name" placeholder="Group Name" id="group_name" autocomplete="off" class="form-control" required>
							</div>

							<div class="col-sm-12 form-group">
								<label>Group Code <font color="red">*</font></label>
								<input type="text" name="group_code" placeholder="Group Code" id="group_code" autocomplete="off" class="form-control" maxlength="20" required>
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
	$("#form_add").submit(function(event){
		blockID('#form_add');
		event.preventDefault();

		$.ajax({
			url: '<?php echo site_url(); ?>configuration/user_group/action_add',
			type: "POST",
			data: $("#form_add").serialize(),
			dataType: 'json',

			success: function(json) {
				if (json.code == 200){
					unblockID('#form_add');
					close_modal();
					alert(json.message);
                                        //alert(json.message);
					//notif(json.header,json.message,json.theme);
                                        //  Swal.fire({
                                        //     position: 'center',
                                        //     icon: 'success',
                                        //     title: json.message,
                                        //     showConfirmButton: false,
                                        //     timer: 1500                     
                                        //   });
					$('#grid').datagrid('load');
				}else{
					unblockUI();
					alert(json.message)
                                        // Swal.fire({
                                        //     position: 'center',
                                        //     icon: 'error',
                                        //     title: json.message,
                                        //     showConfirmButton: false,
                                        //     timer: 1500                     
                                        //   });
                                       // alert(json.message);
					//notif(json.header,json.message,json.theme);
				}
			},

			error: function(){
				//notif(json.header,json.message,json.theme);
                                alert(json.message);
			},

			complete: function(){
				unblockID('#form_add');
			}
		});
	});
</script>