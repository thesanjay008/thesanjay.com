<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <base href="<?php echo base_url(); ?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?> | <?php echo $genraloptions['site_title']; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--//IMPORT CSS -->
  <?php include('style.php'); ?>
  <script src="libraries/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
  
  <!-- CUSTOM -->
  <link rel="stylesheet" href="libraries/admin/jQalertbox/jQalertbox.css">
  <script type="text/javascript" src="libraries/admin/jQalertbox/jQalertbox.min.js"></script>

</head>