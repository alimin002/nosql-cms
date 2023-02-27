<?php //$this->load->view('common/jeasyui'); ?>
        <div class="col-md-6">
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
        create_btn(site_url('web_contents/add'),'Add','plus-circle2');
        } 
        ?>
        <table id="grid" class="easyui-datagrid md-12"
            url="<?php echo site_url('web_contents/getList'); ?>" toolbar="#tb"
            title="<?php echo $title; ?>" iconCls="fa fa-table"
            rownumbers="true" 
            pagination="true"
            fitColumns="true" 
            emptyMessage="No Records Found" 
            >
        <thead>
            <tr>
                <th field="page_code" width="100">Kode Konten</th>
                <th field="page_name" width="100">Nama Konten</th>
                <th field="page_content" width="300">Konten</th>                
                <th field="action" width="200">Aksi</th>
            </tr>
        </thead>
        </table>
        </div>

<script> 
                function edit(id){
                    $.magnificPopup.open({
                        items: {
                            src: "<?php echo site_url('web_contents/edit/') ?>"+id,
                        },
                        modal: true,
                        type: 'ajax',
                        tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
                        showCloseBtn: false,
                    });
                }




	function searching()
	{
            $('#grid').datagrid('load',{search: $('#search').val(),user_group: $('#user_group').val()});
            console.log("search");
               
    }
    
    function deleteData(id){
		url = "<?php echo site_url('web_contents/delete/') ?>"+id;
		data = {id : id};
		confirm_delete(url);
	}
</script>
