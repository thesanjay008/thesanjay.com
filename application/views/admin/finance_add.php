<!-- Main content -->
	<section class="content">
		<form id="add_finance" method="POST" name="add_finance" action="#">
			<div class="row">
				<div class="box-body">
					<div class="col-md-3">
						<div class="form-group">
							<label>Select Member</label>
							<select class="form-control" id="member" name="member" style="width: 100%;">
							 <option value="">Select</option>
							 <?php foreach($members as $member){ ?>
							 <option value="<?php echo $member['ID']; ?>"><?php echo $member['fname'] ." ".$member['lname']; ?></option>
							 <?php } ?>
							</select>
						</div>
					</div>
					<div class="clearfix"></div>
					
					<div class="col-md-3">
						<div class="form-group">
							<label>Loan Amount</label>
							<input type="text" id="loan_amount" name="loan_amount" class="form-control" placeholder="Enter ..."/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>No of Instalments</label>
							<input type="text" id="instalments" name="instalments" class="form-control" placeholder="Enter ..."/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Down Payment</label>
							<input type="text" id="down_payment" name="down_payment" class="form-control" placeholder="Enter ..."/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Interest rate (%)</label>
							<input type="text" id="interest_rate" name="interest_rate" class="form-control" placeholder="Enter ..."/>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Start Date</label>
							<input type="text" id="start_date" name="start_date" class="form-control" placeholder="Enter ..."/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>End Eate</label>
							<input type="text" id="end_date" name="end_date" class="form-control" placeholder="Enter ..."/>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Remarks</label>
							<textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder="Enter ..."></textarea>
						</div>
					</div>
					<div class="clearfix"></div>
					
					<div class="col-md-3">
						<div class="form-group">							
							<button type="submit" name="submit" id="submitBtn" class="btn btn-primary">Add <?php echo $finance_type; ?> Loan</button>								
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
    <!-- //Main content over-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(e) {
			$('.finance_list').addClass('active');
			$('.finance_<?php echo$finance_type; ?>').addClass('active');
			
			$("#add_finance").submit(function(ev){
				ev.preventDefault();
				/* SEND DATA */
				var data = {
					finance_type : "<?php echo $finance_type; ?>",
					member : $("#member").val(),
					loan_amount : $("#loan_amount").val(),
					instalments : $("#instalments").val(),
					down_payment : $("#down_payment").val(),
					interest_rate : $("#interest_rate").val(),
					start_date : $("#start_date").val(),
					end_date : $("#end_date").val(),
					remarks : $("#remarks").val(),
					<?php if (!empty($finance_id)) { ?>
					finance_id : "<?php echo $finance_id; ?>",
					<?php } ?>
				};
				
				$.ajax({
					url: "secrets/add_finance",
					type: "POST",
					dataType: "json",
					async: true,
					data: data,
					success: function (response) {
						if (response.status == 1) {
                            swal({
                                title: 'Saved!',
                                text: response.message,
                                type: 'success',
                                onClose: function () {
                                    location.reload('true');
                                }
                            });
							window.location.href = "admin/finance/<?php echo $finance_type; ?>";
						}else{
							swal({
                                title: 'Error!',
                                text: response.message,
                                type: 'error',
                            });
							return false;
						}
					},
					error: function (jXHR, textStatus, errorThrown) {
						alert(errorThrown);
					}
				});
				return false;
			});
		});
		$(window).load(function () {
			<?php if (!empty($finance_id)) { ?>
				var finance_id ="<?php echo $finance_id;?>";
				get_finance(finance_id);
			<?php } ?>
			
			
		});
		
		var get_finance = function (finance_id) {
			
			var data = {
				finance_id : finance_id,
			};
			$.ajax({
				url: "secrets/financelist",
				type: "POST",
				dataType: "json",
				async: true,
				data: data,
				success: function (response) {
					if (response.status == 1) {
						if(response.details.length>0){
							financeDetail = response.details[0];
							$('#loan_amount').val(financeDetail['loan_amount']);
							$('#instalments').val(financeDetail['instalments']);
							$('#down_payment').val(financeDetail['down_payment']);
							$('#interest_rate').val(financeDetail['interest_rate']);
							$('#member').val(financeDetail['member_id']);
							$('#start_date').val(financeDetail['start_date']);
							$('#end_date').val(financeDetail['end_date']);
							$('#remarks').val(financeDetail['remarks']);
							$('#submitBtn').html("Update Loan");
							//alert(financeDetail['loan_amount']);
							return false;
						}
						return false;
					}else{
						swal({
							title: 'Error!',
							text: response.message,
							type: 'error',
						});
						return false;
					}
				},
				error: function (jXHR, textStatus, errorThrown) {
					alert(errorThrown);
				}
			});
			return false;
		};
	</script>