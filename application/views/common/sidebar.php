<div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url() ?>assets/images/user_default.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo base_url('profile'); ?>" class="d-block"><?php echo $this->session->userdata('full_name'); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <?php
                $listMenu = listMenu($menu);
                echo $listMenu;
        ?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>