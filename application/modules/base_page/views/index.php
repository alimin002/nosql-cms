<style>
    .datagrid-btable, .datagrid-header-inner, .datagrid-htable {
   width : 100%;
}
</style>

    <div id="tb" style="padding:3px">
       
        <span>Search</span>
        <input id="search" style="line-height:26px;border:1px solid #ccc">
        <a href="#" class="easyui-linkbutton" plain="true" onclick="searching()">Search</a>
    </div>
    <table id="grid" class="easyui-datagrid" style="width:1000px;height:auto"
            url="<?php echo site_url('configuration/user/getList'); ?>" toolbar="#tb"
            title="Load Data" iconCls="icon-save"
            rownumbers="true" pagination="true">
        <thead>
            <tr>
                <th field="username" width="80">Username</th>
                <th field="status" width="80">Status</th>
                <th field="action" width="200">Status</th>
            </tr>
        </thead>
    </table>

<script>
    function searching()
    {
        $('#grid').datagrid('load',{search: $('#search').val(),user_group: $('#user_group').val()});
        console.log("search");

    }
</script>