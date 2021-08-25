<!DOCTYPE html>
<html>
<head>
  <base href="<?php echo base_url("admin"); ?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $genraloptions['site_title']; ?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="libraries/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="libraries/admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="libraries/admin/plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!--<div class="login-logo"><b>Greycells</b>CMS</div>-->
  <div class="login-logo"><img src="<?php echo $genraloptions['site_logo']; ?>" style="height:100px;"></div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php if($error= $this->session->flashdata('login_failed')): ?>
    <div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Oh snap!</strong> <?= $error; ?>
    </div>
    <?php else: ?>
    <p class="login-box-msg">Login to start your session</p>
    <?php endif; ?>

    <?php echo form_open ('login/auth'); ?>
      <div class="form-group has-feedback">
        <?php echo form_input (['name'=>'username','class'=>'form-control','placeholder'=>'Username','value'=>set_value('username')]); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span><?php echo form_error('username','<p class="text-danger">','</p>'); ?></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo form_password (['name'=>'password','class'=>'form-control','placeholder'=>'Password']); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span><?php echo form_error('password','<p class="text-danger">','</p>'); ?></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <?php echo form_checkbox(['name'=>'remember','value'=>'remember']); ?>Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <?php echo form_submit(['name'=>'user_login','class'=>'btn btn-primary btn-block btn-flat','value'=>'Login']); ?>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="#">I forgot my password</a><br>
    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="libraries/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="libraries/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="libraries/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
