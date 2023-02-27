<div class="col-md-6 pull-right">
    <div class="input-group" align="right">
        <span class="input-group-addon">Search : </span>
        <input type="text" id="search" value="" class="form-control" placeholder="Search...">
        <div class="input-group-btn">
            <button type="submit" onclick="searching()" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
    </div>
</div>
<div class="col-md-12">
    <?php
    if ($add) {
        create_btn(site_url('configuration/menu_action/add'), 'Add', 'plus-circle2');
    }
    ?>
    <table id="grid" class="easyui-datagrid md-12" style="/**width:600px;height:250px**/"
           url="<?php echo site_url('configuration/menu_action/getList'); ?>" toolbar="#tb"
           title="<?php echo $title; ?>" iconCls=""
           rownumbers="true" 
           pagination="true"
           fitColumns="true" 
           emptyMessage="No Records Found" 
           >
        <thead>
            <tr>
                <th field="name" width="80">Name</th>
                <th field="action" width="200">Action</th>
            </tr>
        </thead>
    </table>
</div>
<script>
    function edit_menu(id){
		$.magnificPopup.open({
			items: {
				src: "<?php echo site_url('configuration/menu_action/edit/') ?>"+id,
			},
			modal: true,
			type: 'ajax',
			tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
			showCloseBtn: false,
		});
	}

	function delete_menu(id){
		url = "<?php echo site_url('configuration/menu_action/delete/') ?>"+id;
		data = {id : id};
		confirm_delete(url);
	}

	document.getElementById('search').onkeydown = function(e) {
		if (e.keyCode == 13 || e.which == 13) {
			searching(e);
		}
	}

	function searching()
	{
		$('#grid').datagrid('load',{search: $('#search').val()});
	}

	function validasi(msg,reload=''){
//	swal({
//		title:msg,
//		text: "",
//		type: "warning",
//		confirmButtonColor: "#EF5350",
//		});
        alert(msg);
	}
</script>