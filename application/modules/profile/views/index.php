<?php $this->load->view('common/jeasyui'); ?>
<?php $lastweek = date('Y-m-d', strtotime("-7 days")); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/common/toExcel.js"></script>
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="index.html">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active"><?php echo $title ?></span>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<div class="note note-info">

    <div class="col col-md-6" style="padding: 5px 15px" >
        <center>
            <div class="icon-object border-blue-800 bg-angkasa2">
                <i class="icon-reading">
                </i>
            </div> 
        </center>
        <table class="table table-striped">
            <tr>
                <td>User Name</td>
                <td align="center">:</td>
                <td id='username'></td>
            </tr>
            <tr>
                <td>Name</td>
                <td align="center">:</td>
                <td id="name"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td align="center">:</td>
                <td id="email"></td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <?php $id = $this->session->userdata('user_id'); ?>
                    <button onClick="edit('<?php echo $id ?>')" class="updated btn bg-angkasa2 btn-icon btn-xs btn-dtgrid" title="Edit">Edit</button>

                    <button onClick="change_password('<?php echo $id ?>')" class="updated btn bg-angkasa2 btn-icon btn-xs btn-dtgrid" title="change_password">Change Password</button>
                </td>
            </tr>
        </table>
    </div>
</div>
<script type="text/javascript">

    function userData()
    {
        $.ajax({
            dataType: "json",
            url: "<?php echo site_url('profile/getProfile/') ?>",
            success: function (x)
            {
                // console.log(x);

                $("#username").html(x.username);
                $("#name").html(x.full_name);
                $("#email").html(x.email);
            }

        });
    }

    userData();

    function edit(id) {
        $.magnificPopup.open({
            items: {
                src: "<?php echo site_url('profile/edit/') ?>" + id,
            },
            modal: true,
            type: 'ajax',
            tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
            showCloseBtn: false,
        });

    }

    function change_password(id) {

        $.magnificPopup.open({
            items: {
                src: "<?php echo site_url('profile/change_password/') ?>" + id,
            },
            modal: true,
            type: 'ajax',
            tLoading: '<i class="fa fa-refresh fa-spin"></i> Loading...',
            showCloseBtn: false,
        });
    }




</script>