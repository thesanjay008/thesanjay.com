<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('coredata.php');
include_once('header.php');

$cart_data = $this->restModel->get_cart_products($current_user_id);
?>
	<div class="my-3 my-md-5">
	  <div class="container">
		<div class="card">
		  <div class="card-header">
			<h3 class="card-title">CART</h3>
			<div class="card-options">
			  <?php if(!empty($cart_data)){ ?>
			  <a class="btn btn-primary" href="javascript:void(0);" onclick="create_order();"> Check out</a>
			  <?php } ?>
			</div>
		  </div>
		  <div class="card-body">
			<div class="table-responsive push">
			  <table class="table table-bordered table-hover">
				<?php if(!empty($cart_data)){ ?>
				<tbody>
					<tr>
					  <th class="text-center" style="width: 1%"></th>
					  <th>Product</th>
					  <th class="text-center" style="width: 1%">Qnt</th>
					  <th class="text-right" style="width: 1%">Unit</th>
					  <th class="text-right" style="width: 1%">Amount</th>
					</tr>
					<?php foreach($cart_data['list'] as $key => $list){ ?>
					<tr>
						<td class="text-center"><?php echo $key + 1; ?></td>
						<td><p class="font-w600 mb-1"><?php echo $list['product_title']; ?></p><div class="text-muted"><?php echo $list['product_description']; ?></div></td>
						<td class="text-center"><?php echo $list['qty']; ?></td>
						<td class="text-right"><?php echo $list['price']; ?></td>
						<td class="text-right"><?php echo $list['gross_total']; ?></td>
					</tr>
					<?php } ?>
					<tr>
					  <td colspan="4" class="font-w600 text-right">Subtotal</td>
					  <td class="text-right"><?php echo $cart_data['subtotal']; ?></td>
					</tr>
					<!--<tr>
					  <td colspan="4" class="font-w600 text-right">Vat Rate</td>
					  <td class="text-right">20%</td>
					</tr>
					<tr>
					  <td colspan="4" class="font-w600 text-right">Vat Due</td>
					  <td class="text-right">$5.000,00</td>
					</tr>-->
					<tr>
					  <td colspan="4" class="font-weight-bold text-uppercase text-right">Total Due</td>
					  <td class="font-weight-bold text-right"><?php echo $cart_data['subtotal']; ?></td>
					</tr>
				</tbody>
				<?php } ?>
			  </table>
			</div>
			<?php if(empty($cart_data)){ ?>
			<h3 class="text-muted text-center">Cart is empty</h3>
			<p class="text-muted text-center">Looks like you have no items in your shopping cart.<br/>Click <a href="plans">here</a> to continue shopping.</p>
			<?php }else{ ?>
			<p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
			<?php } ?>
		  </div>
		</div>
	  </div>
	</div>

	<script>
		var create_order = (function () {
			var data = new FormData();
			data.append('visit_from', 'web');
			data.append('user_id', '<?php echo $current_user_id; ?>');
			
			$.ajax({
				url: "restapis/create_order",
				type: 'POST',
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				data: data,
				cache: false,
				success: function (response) {
					var htmlData = '';
					if (response.status == 'ok') {
						window.location.href = "<?php echo $siteurl.'/checkout';?>";
					}else{
						/*swal.fire({
							title: response.message,
							type: 'error',
						});
						return false;*/
					}
				}
			});
			return false;
		});
	</script>
<?php include_once('footer.php'); ?>