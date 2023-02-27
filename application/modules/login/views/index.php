<!DOCTYPE html>
<html>
<?php $this->load->view('common/head_login'); ?>    
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!-- <img src="https://sewamobiljogjakarta.org/wp-content/uploads/2016/12/logo-1.png" width="200"></img> -->
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form class="login-form" id="form_login" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" id="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="niPassword" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- <div class="input-group mb-3">
         
          <div class="input-group-append">
           
            <br>
            <img id="captchaImage" src="<?php //echo base_url(); ?>login/captcha">
            <br>
            <a  href="#" class="loadCaptcha text-black" title="Refresh Captcha">change captcha</a>
          </div>
        </div> -->
        <!-- <div class="input-group mb-3">
          <input class="form-control placeholder-no-fix" type="text" id="captcha" autocomplete="off" placeholder="Captcha" name="captcha" /> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-font"></span>
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <!-- <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label> -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" id="btn-login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>    
      <!-- /.social-auth-links -->
<!--      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>    -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/admin-lte/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin-lte/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/metronik/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/notifications/noty.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/notifications/jgrowl.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/components_notifications_other.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/notifications/pnotify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/components_notifications_pnotify.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/magnific-popup/magnific-popup.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/common/global.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->

<script type="text/javascript">
    url_login = "<?php echo site_url(); ?>login/do_login";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/common/login.js"></script>
<script>   
    $(document).ready(function(){
       $('.loadCaptcha').on('click', function(evt){
        $( "#captchaImage" ).attr("src", '<?php echo base_url(); ?>login/captcha/' + new Date().getTime());
       });
    });       
</script>
</body>
</html>
