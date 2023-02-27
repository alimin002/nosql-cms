<?php //$this->load->view('common/jeasyui'); ?>
        <div class="col-md-6">
            <div class="input-group" align="right">
                
                
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
        create_btn(site_url('banner/add'),'Add','plus-circle2');
        } 
        ?>
        <table id="grid" class="easyui-datagrid md-12"
            url="<?php echo site_url('banner/getList'); ?>" toolbar="#tb"
            title="<?php echo $title; ?>" iconCls="fa fa-table"
            rownumbers="true" 
            pagination="true"
            fitColumns="true" 
            emptyMessage="No Records Found" 
            >
        <thead>
            <tr>
                <th field="kode_banner">Kode Banner</th>
                <th field="nama_banner">Nama Banner <br/>per 12 jam</th>               
                <th field="deskripsi">Deskripsi</th>
                <th field="gambar">Foto</th>
                <th field="action">Aksi</th>
            </tr>
        </thead>
        </table>
        </div>

<script> 
    function edit(id){
        $.magnificPopup.open({
            items: {
                src: "<?php echo site_url('banner/edit/') ?>"+id,
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
		url = "<?php echo site_url('banner/delete/') ?>"+id;
		data = {id : id};
		confirm_delete(url);
	}
</script>
