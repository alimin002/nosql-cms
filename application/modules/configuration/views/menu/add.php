
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading ">
            
                <?php echo $title ?>
                <button class='btn btn-default btn-xs pull-right' onclick="close_modal()">
                <i class="fa fa-times" aria-hidden="true"></i>
              
                </button>
          
        </div>
        <div class="panel-body">
            <form method="post" action="" id="form_add">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Menu Name <font color="red">*</font></label>
                                <input type="text" name="name" class="form-control required" placeholder="Menu Name" id="name" required>
                            </div>
                            <div class="col-sm-3">
                                <label>Icon</label>
                                <input type="text"  name="icon" class="form-control" placeholder="Icon" id="icon" aria-required="true" >
                            </div>
                            <div class="col-sm-3">
                                <label>Order <font color="red">*</font></label>
                                <input type="number" min="1" name="order" class="form-control required" placeholder="Order" id="order_int" aria-required="true" required>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>URL</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><?php echo base_url() ?></span>
                                    <input type="text" name="slug" class="form-control" placeholder="URL" id="slug">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label>Parent</label>
                                <input name="parent" id="parent" class="form-control easyui-combotreegrid" singleSelect="true"style="width: 100%;"></input>

                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Menu Action <font color="red">*</font></label>
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select a State"
                                        style="width: 100%;" name="menu_action[]" required>
                                            <?php
                                            foreach ($menu_action as $key => $value) {
                                                $selected = '';
                                                if ($value->id_seq == 1) {
                                                    $selected = "selected";
                                                }
                                                ?>
                                        <option <?php echo $selected ?> value="<?php echo $value->id_seq ?>"><?= $value->name ?></option>

                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                 
                    <button type="submit" class="btn bg-angkasa2">Submit</button><button type="button" class="btn bg-angkasa">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function iconFormat(icon) {
        return "<i class='icon-" + icon.text + "'></i> " + icon.text;
    }

   
//     $("#icon").select2({
//     		dropdownParent: $('#form_add'),
//                templateResult: iconFormat,
//                templateSelection: iconFormat,
//                escapeMarkup: function(m) { return m; }
//            });

    $("#form_add").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: '<?php echo site_url(); ?>configuration/menu/action_add',
            type: "POST",
            data: $("#form_add").serialize(),
            dataType: 'json',
            beforeSend: function () {
                blockID('#form_add');
            },
            success: function (json) {
                if (json.code == 200) {
                    unblockID('#form_add');
                    close_modal();
                    //notif(json.header, json.message, json.theme);
                    alert(json.message);
                    // Swal.fire({
                    //     position: 'center',
                    //     icon: 'success',
                    //     title: json.message,
                    //     showConfirmButton: false,
                    //     timer: 1500                     
                    //   });
                    $('#grid').treegrid('load');
                } else {
                    unblockUI();
                    //alert(json.message);
                    //  Swal.fire({
                    //     position: 'center',
                    //     icon: 'error',
                    //     title: json.message,
                    //     showConfirmButton: false,
                    //     timer: 1500                     
                    //   });
                    //notif(json.header, json.message, json.theme);
                }
            },
            error: function () {
                unblockID('#form_add');
                //notif('Error', 'error failed insert data', 'alert-styled-left bg-danger');
                alert('error failed insert data');
                // Swal.fire({
                //         position: 'center',
                //         icon: 'warning',
                //         title:'error failed insert data',
                //         showConfirmButton: false,
                //         timer: 1500                     
                //       });
            },
            complete: function () {
                unblockID('#form_add');
               
            }
        });
    });

    $(document).ready(function () {
        
         $(".select2").select2({
             theme: "bootstrap"
         });
        $('#parent').combotreegrid({
            url: "<?php echo site_url('configuration/menu/getList') ?>",
            treeField: 'name',
            idField: 'id_seq',
            scrollbarSize: 0,
            nowrap: true,
            height: 'auto',
            fitColumns: true,
            columns: [[
                    {title: 'Menu', field: 'name', width: 180}
                ]],
            loadFilter: function (data) {
                data.rows.push({id_seq: 0, name: "No Parent"})
                return data;
            }
        });
    })


</script>
 