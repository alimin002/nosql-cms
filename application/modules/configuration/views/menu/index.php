<?php // $this->load->view('common/jeasyui'); ?>
<?php  $lastweek = date('Y-m-d',strtotime("-7 days"));?>
<!--<script type="text/javascript" src="<?php// echo base_url(); ?>assets/common/toExcel.js"></script>-->
 <div class="col-md-12">
         <?php if ($add) {
              create_btn(site_url('configuration/menu/add'),'Add','plus-circle2');
        } ?>
         <table id="grid" title="Folder Browser" class="easyui-treegrid" style="width:100%;height:250px"
            data-options="
                url: '<?php echo site_url('configuration/menu/getList') ?>',
                    treeField : 'name',
                    idField : 'id_seq',
                    scrollbarSize: 0,
                    toolbar     : '#toolbar',
                    nowrap      : true,
                    height      : 'auto',
                    fitColumns  :true,
            ">
        <thead>
            <tr>
                <th data-options="field:'name'" width="220">Menu</th> 
                <th data-options="field:'action'" width="220">Action</th>          
            </tr>
        </thead>
    </table>
 </div>
 <!--<table id="grid" class="easyui-treegrid" singleSelect="true"></table>-->
<script type="text/javascript">
//    $(document).ready(function(){
//            $('#grid').treegrid({
//                    url:"<?php echo site_url('configuration/menu/getList') ?>",
//                    treeField : 'name',
//                    idField : 'id_seq',
//                    scrollbarSize: 0,
//                    toolbar     : '#toolbar',
//                    nowrap      : true,
//                    height      : 'auto',
//                    fitColumns  :true,
//                    columns:[[
//                            {title:'Menu',field:'name',width:180},
//                            // {title:'Order',field:'order',width:180},
//                            {title:'Action',field:'action',align:'center',width:180}
//                    ]],
//                    onLoadSuccess:function(row,data){
//
//                    }
//            });
//    })
</script>
