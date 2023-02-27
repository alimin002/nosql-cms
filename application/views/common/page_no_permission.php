<?php
getSession();
// $access_url = checkUrlAccess($menu, $this->uri->uri_string());

// if ($access_url == 0) {
//     show_404();
//     return false;
// }
?>
<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('common/head'); ?>


    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
<!--                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="../../index3.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>-->
                </ul>

                <!-- SEARCH FORM -->
<!--                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>-->

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->

                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-user"></i>

                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">&nbsp;</span>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo base_url('login/logout') ?>" class="dropdown-item">
                                <i class="fas fa-power-off mr-2"></i>Logout            
                            </a>
                            <div class="dropdown-divider"></div>

                        </div>
                    </li>
                    <!--      <li class="nav-item">
                            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                              <i class="fas fa-th-large"></i>
                            </a>
                          </li>-->
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <!--    <a href="../../index3.html" class="brand-link">
                      <img src="<?php //echo base_url(); ?>assets/admin-lte/dist/img/AdminLTELogo.png"
                           alt="AdminLTE Logo"
                           class="brand-image img-circle elevation-3"
                           style="opacity: .8">
                      <span class="brand-text font-weight-light">Admin system </span>
                    </a>-->

                <!-- Sidebar -->
                <?php $this->load->view('common/sidebar'); ?>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                <?php $this->load->view($content); ?>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Evaluation Version</b>
                </div>
                <strong>Copyright &copy; 2020-2021 #8UserTeam</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        
        <script src="<?php echo base_url(); ?>assets/metronik/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/metronik/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url(); ?>assets/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>assets/admin-lte/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url(); ?>assets/admin-lte/dist/js/demo.js"></script>
        <!---plugin core--->
        <script src="<?php echo base_url(); ?>assets/metronik/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/metronik/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/metronik/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/metronik/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/magnific-popup/magnific-popup.min.js"></script>
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/selects/select2.min.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/common/global.js"></script>



        <link href=" https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/notifications/jgrowl.min.js"></script>
        <!--perubahan urutan penulisan bisa membuat treeview macet-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jeasyui/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jeasyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jeasyui/themes/color.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/jeasyui/jquery.easyui.min.js"></script>
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/common/global.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/jeasyui/plugins/datagrid-export/datagrid-export.js"></script>
        

        <!-- include summernote css/js -->

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js">
        <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert2@9.js" type="text/javascript"></script>
        

       
    </body>
</html>