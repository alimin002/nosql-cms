function settingDefaultDatagrid(){
      
	$.extend($.fn.datagrid.defaults, {
		method      : 'POST',
		pageList    : [10,20,30,50,100,200],
		striped     : false,
		fitColumns  : true,
		// fit 		:true,
		rownumberWidth:'45',
		width       :'auto',
		rownumbers  : true,
		pagination  : true,
		height      : 'auto',
		toolbar     : '#tb',
		emptyMsg    : 'No Records Found.',
		loadMsg 	: 'Please wait...',
		minHeight   : '100px',
		// minWidth : '100px',
		scrollbarSize: 1,
		nowrap      : false,
		sortable    : false,
		singleSelect: true,
		// rowStyler:function(index,row){
        
  //           return $(".datagrid-btable tr:even" ).css('background-color','#0738622e');
        
  //   	},
	});
}

function open_modal(url)
{
	$.magnificPopup.open({
			items: {
				src: url,
			},
			modal: true,
			type: 'ajax',
			tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
			showCloseBtn: false,
		});
}

function open_modal_add(url)
{
	$.magnificPopup.open({
			items: {
				src: url,
			},
			modal: true,
			type: 'ajax',
			tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
			showCloseBtn: false,
		});
}

function close_modal()
{
	$.magnificPopup.close()
}

function master_edit(url)
{
	$.magnificPopup.open({
		items: {
			src: url,
		},
		modal: true,
		type: 'ajax',
		tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
		showCloseBtn: false,
	});
}

function masterDisable(url)
{
	swal({
		title: "Are you sure want to disable data?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Disable",
		cancelButtonText: "Cancel",
		closeOnConfirm: true,
		closeOnCancel: true
	},
	function(isConfirm){
		if (isConfirm) {
			blockUI();
			$.ajax({
				url: url,
				type: "POST",
				dataType: 'json',

				success: function(json) {
					unblockUI();
					ni_notif(json.code,json.message);
					$('#grid').datagrid('load');
				},

				error: function(){
					unblockUI();
				}
			});
		}
	});
}

function masterEnable(url)
{
	swal({
		title: "Are you sure want to enable data?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#48A64C",
		confirmButtonText: "Enable",
		cancelButtonText: "Cancel",
		closeOnConfirm: true,
		closeOnCancel: true
	},
	function(isConfirm){
		if (isConfirm) {
			blockUI();
			$.ajax({
				url: url,
				type: "POST",
				dataType: 'json',

				success: function(json) {
					unblockUI();
					ni_notif(json.code,json.message);
					$('#grid').datagrid('load');
				},

				error: function(){
					unblockUI();
				}
			});
		}
	});
}

function master_delete_menu(url){
        /**
	swal({
		title: "Are you sure want delete data?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Delete",
		cancelButtonText: "Cancel",
		closeOnConfirm: true,
		closeOnCancel: true
	},
	function(isConfirm){
		if (isConfirm) {
			blockUI();
			$.ajax({
				url: url,
				type: "POST",
				dataType: 'json',

				success: function(json) {
					unblockUI();
					ni_notif(json.code,json.message);
					$('#grid').treegrid('load');
				},

				error: function(){
					unblockUI();
				}
			});
		}
	});
    
    **/
    var result = confirm("Are you sure want delete data?");
    if (result) {
        //Logic to delete the item
        blockUI();
        $.ajax({
                url: url,
                type: "POST",
                dataType: 'json',

                success: function(json) {
                        unblockUI();
                        //ni_notif(json.code,json.message);
                        alert(json.message);
                        $('#grid').treegrid('load');
                },

                error: function(){
                        unblockUI();
                }
        });
    }
}

function alerts(title,text,color,type){
	swal({
		title: title,
		text: text,
		confirmButtonColor: color,
		type: type
	});
}

function noselectdata(){
	swal({
		title: "Error...",
		text: "Anda belum memilih data!",
		confirmButtonColor: "#EF5350",
		type: "error"
	});
}

function notif(header,message,theme){
	$.jGrowl(message, {
		header: header,
		theme: theme
	});
}

function ni_notif(code,message){
	if (code == 200) {
		$.jGrowl(message, {
			header: 'Success',
			theme: 'alert-styled-left bg-success',
		});
	}else{
		$.jGrowl(message, {
			header: 'Error',
			theme: 'alert-styled-left bg-danger',
		});
	}
}

function notif_new(header,message){
	if(header.toUpperCase() == 'SUCCESS'){
		theme = 'alert-styled-left bg-success';
	}else{
		theme = 'alert-styled-left bg-danger';
	}

	$.jGrowl(message, {
		header: header,
		theme: theme
	});
}

function blockUI(){
        //alert(7777);
	$.blockUI({ 
		message: '<i class="icon-spinner4 spinner"></i>',
	    // timeout: 2000, //unblock after 2 seconds
	    overlayCSS: {
	    	backgroundColor: '#1b2024',
	    	opacity: 0.8,
	    	cursor: 'wait'
	    },
	    css: {
	    	border: 0,
	    	color: '#fff',
	    	padding: 0,
	    	backgroundColor: 'transparent'
	    }
	});
}

function unblockUI(){
	$.unblockUI({ 
		message: '<i class="icon-spinner4 spinner"></i>',
	    // timeout: 2000, //unblock after 2 seconds
	    overlayCSS: {
	    	backgroundColor: '#1b2024',
	    	opacity: 0.8,
	    	cursor: 'wait'
	    },
	    css: {
	    	border: 0,
	    	color: '#fff',
	    	padding: 0,
	    	backgroundColor: 'transparent'
	    }
	});
}

function blockID(id){
	$(id).block({
		 message: '<span class="text-semibold">Please wait...</span>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
	});
}

function unblockID(id){
	$(id).unblock({
		message: '<i class="icon-spinner spinner"></i>',
		overlayCSS: {
			backgroundColor: '#1B2024',
			opacity: 0.85,
			cursor: 'wait'
		},
		css: {
			border: 0,
			padding: 0,
			backgroundColor: 'none',
			color: '#fff'
		}
	});
}

function confirm_delete_old(row,url,data){
	swal({
		title: "Hapus data?",
		text: "Data yang sudah dihapus tidak dapat dikembalikan!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		closeOnConfirm: true,
		closeOnCancel: true
	},
	function(isConfirm){
		if (isConfirm) {
			blockUI();
			$.ajax({
				url: url,
				type: "POST",
				data: data,
				dataType: 'json',

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

				error: function(){
					unblockUI();
					alerts("Error","Ada kendala saat menghapus data","#EF5350","error");
					$('#grid').datagrid('load');
				}
			});
		}
	});
}

function confirm_delete(url,reload=''){
       //dimodifikasi
       /**
	swal({
		title: "Are you sure want delete data?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Delete",
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
				notif('Error','error failed delete','alert-styled-left bg-danger');
				},

				complete: function(){
					unblockUI();
				}
			});
		}
	});
        **/
       
        var result = confirm("Are you sure want delete data?");
        if (result) {
            //Logic to delete the item
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
                                    alert(json.message);
                                    $('#grid').datagrid('load');
                            }else{
                                    unblockUI();
                                    //notif(json.header,json.message,json.theme);
                                    alert(json.message);
                                    $('#grid').datagrid('load');
                            }
                    },

                    error: function(json){
                    unblockID('#form_add');
                    //notif('Error','error failed delete','alert-styled-left bg-danger');
                    alert("error failed delete");
                    },

                    complete: function(){
                            unblockUI();
                    }
            });
        }
}

function disable(url,reload=''){
	swal({
		title: "Are you sure want disable data?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Disable",
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
				notif('Error','error failed disable','alert-styled-left bg-danger');
				},

				complete: function(){
					unblockUI();
				}
			});
		}
	});
}

function enable(url,reload=''){
	swal({
		title: "Are you sure want enable data?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Enable",
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
				notif('Error','error failed disable','alert-styled-left bg-danger');
				},

				complete: function(){
					unblockUI();
				}
			});
		}
	});
}

function confirm_clear(url,reload=''){
	swal({
		title: "Are you sure want force exit?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Force Exit",
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

				error: function(){
				},

				complete: function(){
					unblockUI();
				}
			});
		}
	});
}

function global_confirm(url,title,text){
	swal({
		title: title,
		text: text,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "OK",
		cancelButtonText: "Batal",
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
						ni_notif(json.code,json.message);
						$('#grid').datagrid('load');
					}else{
						unblockUI();
						ni_notif(json.code,json.message);
					}
				},

				error: function(){
					unblockUI();
				},

				complete: function(){
					unblockUI();
				}
			});
		}
	});
}

function confirm_delete_menu(url,data){	
	swal({
		title: "Hapus data?",
		text: "Data yang sudah dihapus tidak dapat dikembalikan",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		closeOnConfirm: true,
		closeOnCancel: true
	},
	function(isConfirm){
		if (isConfirm) {
			$.ajax({
				url: url,
				type: "POST",
				dataType: "json",
				data: data,

				beforeSend: function(){
					blockUI();
				},

				success: function(json) {
					if (json.code == 200) {
						unblockUI();
						notif_new(json.header,json.message);
						close_modal();
						$('#grid').treegrid('load');
					}else{
						notif_new(json.header,json.message);
					}
				},

				error: function(){
					unblockUI();
				},

				complete: function(){
					unblockUI();
				}
			});
		}
	});
}

function noselectdata(){
	swal({
		title: "Warning",
		text: "No selected data",
		confirmButtonColor: "#FF5722",
		type: "warning"
	});
}

function confirm_whitelist(url,data){
	swal({
		title: "Update Data?",
		text: "Data yang ini akan ini akan diupdate !",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Update",
		cancelButtonText: "Batal",
		closeOnConfirm: true,
		closeOnCancel: true
	},
	function(isConfirm){
		if (isConfirm) {
			blockUI();
			$.ajax({
				url: url,
				type: "POST",
				data: data,

				success: function(json) {
					notif("Update!","Data berhasil diupdate","bg-success");
					unblockUI();
					$('#grid').datagrid('load');
				},

				error: function(){
					unblockUI();
					alerts("Error...","Ada kendala saat mengupdate data","#EF5350","error");
					$('#grid').datagrid('load');
				}
			});
		}
	});
}

function privilege_update(url,data){
	blockUI();
	$.ajax({
		url: url,
		type: "POST",
		data: data,
		success: function(json) {
			//notif("Success","Success edit privilege","alert-styled-left bg-success");
                        unblockUI();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title:'Success edit privilege',
                            showConfirmButton: false,
                            timer: 1500                     
                          });
			
			$('#grid').treegrid('load');
		},

		error: function(){
			unblockUI();
					// alerts("Error...","Ada kendala saat mengupdate data","#EF5350","error");
				//notif("Error","Failed edit privilege","alert-styled-left bg-danger");
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title:'Failed edit privilege',
                                    showConfirmButton: false,
                                    timer: 1500                     
                                  });
					$('#grid').treegrid('load');
			}
		});
}
function numberWithDots(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
edit_image_caption ='';
edit_image_url ='';
