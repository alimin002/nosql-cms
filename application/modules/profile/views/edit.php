<div class="col-md-5 col-md-offset-4">
	<div class="modal-header bg-astra" style="padding:2px">
		<div class="panel-heading bg-angkasa2">
			<h5 class="panel-title" style="color: white;font-weight: normal !important;">
				<?php echo $title ?>
                                <button class='btn btn-default btn-xs pull-right' onclick="close_modal()">
                                <i class="fa fa-times" aria-hidden="true"></i>

                                </button>
			</h5>
			
		</div>
		<div class="panel-body">
			<form method="post" id="form_edit">
				<div class="modal-body">
					<div class="form-group">
						<div class="row" >
							<div class="col-sm-12 form-group">
								<label>User Name <font color="red">*</font></label>
								<input type="text" name="username" placeholder="username" autocomplete="off" class="form-control" required value="<?php echo $profile->username ?>" disabled>
								<input type="hidden" name="id" value="<?php echo encode($profile->id_seq); ?>">
							</div>

							<div class="col-sm-12 form-group">
								<label>First Name <font color="red">*</font></label>
								<input type="text" name="firstName" placeholder="First Name" autocomplete="off" class="form-control" required value="<?php echo $profile->first_name ?>" >
							</div>

							<div class="col-sm-12 form-group">
								<label>Last Name</label>
								<input type="text" name="lastName" placeholder="Last Name" autocomplete="off" class="form-control"  value="<?php echo $profile->last_name ?>">
							</div>

							<div class="col-sm-12 form-group">
								<label>Email</label>
								<input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control"  value="<?php echo $profile->email ?>">
							</div>

						</div>
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
			url: '<?php echo site_url(); ?>profile/action_edit',
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
					notif(json.header,json.message,json.theme);
					userData();

					// setTimeout(location.reload(), 50000);
					// location.reload();
					// setInterval(location.reload(), 50000);
					// setTimeout(location.reload(), 50000);
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