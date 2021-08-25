<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('coredata.php');
include_once('header.php');
include_once('easebuzz/easebuzz-lib/easebuzz_payment_gateway.php');

$status = $this->input->post('status');
$order_id = $this->input->post('txnid');
$order_status = 5;
if($status === 'success'){ $order_status = 4; }

if(!empty($order_id)){
  $response = $this->restModel->confirm_order($current_user_id, $order_id, $order_status);
  $plan_details = $this->restModel->add_plan($order_id);
}

?>
	<div class="my-3 my-md-5">
	  <div class="container">
		<div class="page-header">
		  <h1 class="page-title"><?php echo $title; ?></h1>
		</div>
		<div class="row">
		  <div class="col-lg-12">
			<h2>Order Status: <?php echo $status; ?></h2>
			<?php if($status === 'success'){ ?>
			  <p>Page will redirect soon...</p>
			<?php } ?>
		  </div>
		</div>
	  </div>
	</div>
	<?php if($status === 'success'){ ?>
	<script>
	 setTimeout(function(){ window.location = '<?php echo $siteurl; ?>'; }, 3000);
	</script>
	<?php } ?>
<?php include_once('footer.php'); ?>