<?php //$this->load->view('common/jeasyui');  ?>


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
        create_btn(site_url('configuration/user_group/add'), 'Add', 'plus-circle2');
    }
    ?>
    <table id="grid" class="easyui-datagrid md-12" style="/**width:600px;height:250px**/"
           url="<?php echo site_url('configuration/user_group/getList'); ?>" toolbar="#tb"
           title="<?php echo $title; ?>" iconCls="fa fa-users"
           rownumbers="true" 
           pagination="true"
           fitColumns="true" 
           emptyMessage="No Records Found" 
           >
        <thead>
            <tr>
                <th field="group_name" width="80">Group Name</th>
                <th field="group_code" width="80">Group Code</th>
                <th field="action" width="200">Action</th>
            </tr>
        </thead>
    </table>
</div>


<script type="text/javascript">
    /**
    settingDefaultDatagrid()
    $(document).ready(function () {
        $('#grid').datagrid({
            url: '<?php echo site_url('configuration/user_group/getList'); ?>',
            pagination: true,
            rownumbers: true,
            columns: [[
                    {field: 'group_name', title: 'Group Name', width: 100, sortable: true},
                    {field: 'group_code', title: 'Group Code', width: 100, sortable: true},
                    {field: 'action', title: 'Action', sortable: true, halign: 'center', width: 100, align: "center"}
                ]],
        });
    });
    **/
    function edit_group(id) {
        $.magnificPopup.open({
            items: {
                src: "<?php echo site_url('configuration/user_group/edit/') ?>" + id,
            },
            modal: true,
            type: 'ajax',
            tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
            showCloseBtn: false,
        });
    }

    function delete_group(id) {
        url = "<?php echo site_url('configuration/user_group/delete/') ?>" + id;
        confirm_delete(url);
    }

    document.getElementById('search').onkeydown = function (e) {
        if (e.keyCode == 13 || e.which == 13) {
            searching(e);
        }
    }

    function searching()
    {
        $('#grid').datagrid('load', {search: $('#search').val()});
    }

    function validasi(msg, reload = ''){
        //alert(msg);
        Swal.fire({
        position: 'center',
        icon: 'warning',
        title: msg,
        showConfirmButton: false,
        timer: 1500                     
      });
        
    }
</script>