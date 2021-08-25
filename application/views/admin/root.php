<!--//IMPORT HEADER -->
<?php 
  include('coredata.php');
  include('main_head.php');
?>
  
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!--//IMPORT HEADER -->
  <?php include('header.php'); ?>

  <!--//IMPORT NAVIGATION -->
  <?php include('navigation.php'); ?>

  <div class="content-wrapper">
    <!-- Main content over-->
	<?php include $page . ".php"; ?>
    <!-- //Main content over-->
  </div>

<?php include('footer.php'); ?>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.6 -->
<script src="libraries/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="libraries/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="libraries/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="libraries/admin/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="libraries/admin/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="libraries/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="libraries/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="libraries/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="libraries/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="libraries/admin/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="libraries/admin/dist/js/demo.js"></script>
<!-- SWEET ALERT2 -->
<script src="libraries/admin/sweetalert/sweetalert2.js"></script>
<!-- MOMENT FOR TIME CONVERT -->
<script src="libraries/admin/momentjs.js"></script>
</body>
</html>