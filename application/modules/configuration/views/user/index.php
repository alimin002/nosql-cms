<?php // $this->load->view('common/jeasyui'); ?>

       
        <div class="col-md-6">
            <div class="input-group" align="right">
                
                <select id="user_group" class="form-control">
                        <option value="">Select</option>
                        <?php foreach($user_group_data as $group_user) {?>
                        <option value="<?php echo encode($group_user->id_seq) ?>"><?php echo $group_user->group_name ?></option>
                        <?php } ?>
                </select>
            </div>		
        </div>
        <div class="col-md-6">
            <div class="input-group" align="right">               
                <input type="text" id="search" value="" class="form-control" placeholder="Search...">
                <div class="input-group-btn">
                        <button type="submit" onclick="searching()" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        
        <div class="col-md-12" id="main-content">
       
        <?php 
        if ($add) {
        create_btn(site_url('configuration/user/add'),'Add','plus-circle2');
        } 
        ?>
        <table id="grid" class="easyui-datagrid md-12" style="/**width:600px;height:250px**/"
            url="<?php echo site_url('configuration/user/getList'); ?>" toolbar="#tb"
            title="<?php echo $title; ?>" iconCls="fa fa-users"
            rownumbers="true" 
            pagination="true"
            fitColumns="true" 
            emptyMessage="No Records Found" 
            >
        <thead>
            <tr>
                <th field="username" width="80">Username</th>
                <th field="status" width="80">Status</th>
                <th field="action" width="200">Aksi</th>
            </tr>
        </thead>
        </table>
        </div>

<script> 
    $(document).ready(function(){
        $('.alert').alert();
    });
                function edit_user(id){
		$.magnificPopup.open({
			items: {
				src: "<?php echo site_url('configuration/user/edit/') ?>"+id,
			},
			modal: true,
			type: 'ajax',
			tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
			showCloseBtn: false,
		});
	}

	function change_password(id,reload='')
	{
		var url = "<?php echo site_url('configuration/user/update_password/') ?>"+id;
               
           
           Swal.fire({
                title: 'Are you sure?',
                text: 'want reset password?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reset it!'
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                            url: url,
                            type: "GET",
                            dataType: "json",
                            beforeSend: function(){
                                    blockUI();
                            },
                            success: function(json) {
                                    if (json.code == 200) {
                                            unblockUI();
                                            //notif(json.header,json.message,json.theme);
                                            Swal.fire(
                                                'Done!',
                                                json.message,
                                                'success'
                                              );
                                            $('#grid').datagrid('load');
                                    }else{
                                            unblockUI();
                                            //notif(json.header,json.message,json.theme);
                                            Swal.fire(
                                                'Warning!',
                                                json.message,
                                                'Error'
                                              );
                                            $('#grid').datagrid('load');
                                    }
                            },

                            error: function(){
                            },

                            complete: function(){
                                    unblockUI();
                            }
                    });
                  
                }
              })
           
	}

	// function delete_user(id){
	// 	url = "<?php echo site_url('configuration/user/delete/') ?>"+id;
	// 	confirm_delete(url);
	// }

	function disable_user(id,msgButton,msg,reload='')
	{
		var url="<?php echo site_url('configuration/user/delete/') ?>"+id+"/"+msg;
                /**
		swal({
			title: "Are you sure want "+msg+" this user?",
			text: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#EF5350",
			confirmButtonText: msgButton,
			cancelButtonText: "Cancel",
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					url: url,
					type: "GET",
					dataType: "json",
					beforeSend: function(){
						blockUI();
					},
					success: function(json) {
						if (json.code == 200) {
							unblockUI();
							notif(json.header,json.message,json.theme);
							$('#grid').datagrid('load');
						}else{
							unblockUI();
							notif(json.header,json.message,json.theme);
							$('#grid').datagrid('load');
						}
					},

					error: function(json){
					unblockID('#form_add');
					notif('Error','Error please contact admin','alert-styled-left bg-danger');
					},

					complete: function(){
						unblockUI();
					}
				});
			}
		});
                **/
                
//                var result = confirm("Are you sure want "+msg+" this user?");
//                if (result) {
//                   
//                }
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "want "+msg+" this user?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes,' +msg+ ' it!'
                  }).then((result) => {
                    if (result.value) {
                        
                       $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        beforeSend: function(){
                                blockUI();
                        },
                        success: function(json) {
                                if (json.code == 200) {
                                        unblockUI();
                                        //notif(json.header,json.message,json.theme);
                                        //alert(json.message);
                                        Swal.fire(
                                            'Done!',
                                            json.message,
                                            'success'
                                          )
                                        $('#grid').datagrid('load');
                                }else{
                                        unblockUI();
                                        //notif(json.header,json.message,json.theme);
                                       Swal.fire(
                                            'Done!',
                                            json.message,
                                            'error'
                                          )
                                        $('#grid').datagrid('load');
                                }
                        },

                        error: function(json){
                        unblockID('#form_add');
                        //notif('Error','Error please contact admin','alert-styled-left bg-danger');                      
                        Swal.fire(
                            'Done!',
                            'Error please contact admin',
                            'success'
                          )
                        },

                        complete: function(){
                                unblockUI();
                        }
                });
                      
                    }
                  })
                
	}


	document.getElementById('search').onkeydown = function(e) {
		if (e.keyCode == 13 || e.which == 13) {
			searching(e);
		}
	}

	$("#user_group").change(function(){
		searching();
	});

	function searching()
	{
            $('#grid').datagrid('load',{search: $('#search').val(),user_group: $('#user_group').val()});
            console.log("search");
               
	}
</script>
