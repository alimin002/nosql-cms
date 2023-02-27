<?php //$this->load->view('common/jeasyui'); ?>
        <div class="col-md-6  ">
            <div class="input-group" >    
                
                <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div> 
                <input type="text" id="start_date" value="" class="datepicker form-control field-filter" readonly>    
                <div class="input-group-addon">
                    s/d
                </div>           
                <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div> 
                <input type="text" id="end_date" value="" class="datepicker form-control field-filter" readonly>                        
            </div>
        </div>  
        <div class="col-md-6">
            <div class="input-group" align="right">               
                <input type="text" id="search" value="" class="form-control field-filter" placeholder="Search..." >
                <div class="input-group-btn">
                        <button type="submit" onclick="searching()" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        
        <div class="col-md-12" style="margin-top:10px;">
            <button class="btn btn-warning pull-right" onclick="clearFilter()">Clear Filter</button>
        </div>
        
        <div class="col-md-12" id="main-content">
       
        <?php 
        // if ($add) {
        // create_btn(site_url('pembelian_bahan_baku/add'),'Add','plus-circle2');
        // } 
       
        ?>
         <button class="btn btn-success" onClick=open_modal(<?php echo "'". base_url().'users/add'."'" ?>)>Add</Button>
        <table id="grid">

        </table>
        </div>
        <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
        <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="https://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
<script> 

        function clearFilter(){
            $(".field-filter").each(function( index ) {
               this.value="";
            });
        }

        $("document").ready(function(){
            // $('#start_date').datepicker({
            // format: 'yyyy-mm-dd'
            // }).on('changeDate', function(ev){
            //     $(this).datepicker('hide');
            // });

            // $('#end_date').datepicker({
            // format: 'yyyy-mm-dd'
            // }).on('changeDate', function(ev){
            //     $(this).datepicker('hide');
            // });

            $('#grid').datagrid({
            url:"<?= site_url() ?>users/getList",
            queryParams: {
                search: $(`#search`).val()
            },
            iconCls:"fa fa-table", 
            rownumbers:"true", 
            pagination:"true",
            fitColumns:"true" ,
            striped:true,
            emptyMessage:"No Records Found",
            toolbar:"#tb",  
            columns:[
                [
                    {field:'username',title:'Username',width:100, sortable:true},
                    {field:'first_name',title:'First Name',width:100, sortable:true},
                    {field:'last_name',title:'Last Name',width:100, sortable:true},
                    {field:'action',title:'Action',width:100, sortable:true},
                    ]
            ] ,
			onLoadSuccess: function(row) {
            
                $(window).resize(function() {
					setTimeout(function() {
						$('#grid').datagrid('resize');
					}, 400);
				});

				$(".nav").click(function() {
					setTimeout(function() {
						$('#grid').datagrid('resize');
					}, 400);
				});
            }                 
            });
        });

      

    function edit(id){
        $.magnificPopup.open({
            items: {
                src: "<?php echo site_url('users/edit/') ?>"+id,
            },
            modal: true,
            type: 'ajax',
            tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
            showCloseBtn: false,
        });
    }

    function detail(id){
        $.magnificPopup.open({
            items: {
                src: "<?php echo site_url('pembelian_bahan_baku/detail/') ?>"+id,
            },
            modal: true,
            type: 'ajax',
            tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
            showCloseBtn: false,
        });
    }




	function searching()
	{
            $('#grid').datagrid('load',{
                search: $('#search').val(),
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
            });
            console.log("search");
               
    }
    
    function deleteData(id){
        // alert(123);
		var url = "<?php echo site_url('users/delete/') ?>"+id;
        // alert(url);
		data = {id : id};
		confirm_delete(url);
	}
</script>
