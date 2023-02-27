<div class="col-md-5 col-md-offset-4">
	<div class="panel panel-default">
		<div class="panel-heading bg-angkasa2">
			
                            <?php echo $title ?>
                            <button class='btn btn-default btn-xs pull-right' onclick="close_modal()">
                            <i class="fa fa-times" aria-hidden="true"></i>
              
                            </button>
			
			
		</div>
		<div class="panel-body">
			<form id="form_edit" action="">
				<div class="modal-body">
					<div class="form-group">
						<label>Action Name <font color="red">*</font> </label>
						<input type="text" class="form-control" value="<?php echo $action_name ?>" autocomplete="off" placeholder="Name" name="name" required>
						<input type="hidden" name="id" value="<?php echo $id ?>">
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
	
	$("#form_edit").submit(function(event){
		event.preventDefault();

		$.ajax({
			url: '<?php echo site_url(); ?>configuration/menu_action/action_edit',
			type: "POST",
			data: $("#form_edit").serialize(),
			dataType: 'json',

			beforeSend: function(){
				blockID('#form_edit');
			},

			success: function(json) {
				if (json.code == 200){
					unblockID('#form_edit');
					close_modal();
					alert(json.message);
					//notif(json.header,json.message,json.theme);
					$('#grid').datagrid('load');
				}
				else
				{
					unblockID('#form_edit');
					notif(json.header,json.message,json.theme);
				}
			},

			error: function(){
				unblockID('#form_edit');
			},

			complete: function(){
				unblockID('#form_edit');
			}
		});
	});
</script>