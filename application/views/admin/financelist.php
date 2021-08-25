	<section class="content-header">
      <h1><?php echo ucfirst($finance_type); ?> Loans</h1>
      <ol class="breadcrumb">
        <li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?php if($feedback= $this->session->flashdata('feedback')): $feedback_class=$this->session->flashdata('feedback_class'); ?>
          <div class="col-md-6 col-lg-offset-3">
            <div class="alert alert-dismissible <?= $feedback_class; ?>">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?= $feedback; ?>
            </div>
          </div>
          <?php endif ?>
        </div>
        <div class="col-md-12">
          <div class="box box-primary">
          <div class="box-body no-padding">
            <div class="mailbox-controls">
            <!-- Check all button -->
            <div class="btn-group">
            <button type="submit" name="delet_user" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
            </div>
            <div class="btn-group">
              <a class="btn btn-default btn-sm" href="javascript:void(0);"><i class="fa fa-reply"></i></a>
              <a class="btn btn-default btn-sm" href="javascript:void(0);"><i class="fa fa-share"></i></a>
            </div><!-- /.btn-group -->
            <div class="btn-group addproduct">
			<?php if($finance_type != '' && $finance_type != 'all'){ ?>
              <a class="btn btn-primary btn-sm" href="admin/finance_add/<?php echo$finance_type; ?>">Add New</a>
			<?php } ?>
            </div>
            </div>
            <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
                <tr>
                  <td class="select-tab"><a class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></a></td>
                  <td class="tab"><b>Title</b></td>
                  <td class="tab"><b>Member Name</b></td>
                  <td class="tab"><b>Loan Amount</b></td>
                  <td class="tab"><b>Total Amount</b></td>
                  <td class="tab"><b>No. of Instalments</b></td>
                  <td class="tab"><b>Instalment Price</b></td>
                  <td class="tab"><b>Interest Rate</b></td>
                  <td class="tab"><b>Loan Type</b></td>
                  <td class="tab"><b>Status</b></td>
                  <td class="tab"><b class="pull-right">Action</b></td>
                </tr>
                <?php foreach($results as $data){ ?>
                <tr>  
                  <td class="select-tab"><a class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></a></td>
                  <td><img src="support/admin/media/defoult.png" alt="" height="50px" width="50px"></td>
                  <td><a href="admin/finance_member/<?php echo $data['user_id']; ?>"><b><?php echo $data['fname']." ".$data['lname']; ?></b></a></td>
                  <td><b>Rs.</b> <?php echo $data['loan_amount']; ?></td>
                  <td><?php if($finance_type == 'monthly'){ echo "--";}else{ echo "<b>Rs. </b>". $data['total_payable'];} ?></td>
                  <td><?php if($finance_type == 'monthly'){ echo "--";}else{ echo $data['instalments']; } ?></td>
                  <td><b>Rs.</b> <?php echo $data['instalment_price']; ?></td>
                  <td><?php echo $data['interest_rate']; ?>%</td>
                  <td><b><?php echo ucfirst($data['finance_type']); ?></b></td>
                  <td><span class="label label-success"><?php echo $data['status']; ?></span></td>
                  <td>
                    <span class="pull-right">
                    <?php if($finance_type != 'monthly'){ ?>
					<a data-toggle="tooltip" title="View Instalments" href="admin/instalments/<?php echo $data['finance_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                    <?php } ?>
					<a data-toggle="tooltip" title="Edit" href="admin/finance_add/<?php echo $data['finance_type']; ?>/<?php echo $data['finance_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-file-text-o"></i></a>
					<a data-toggle="tooltip" title="Delete" href="javascript:void(0)" onClick="get_finance(<?php echo $data['finance_id']; ?>);" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a> 
					</span>
                  </td>
                </tr>
				<?php } ?>
              </tbody>
            </table>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
    <!-- //Main content over-->
	
	<script src="support/admin/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(e) {
		$('.finance_list').addClass('active');
		$('.finance_<?php echo$finance_type; ?>').addClass('active');
	});
	
	var get_finance = function (finance_id) {
		if (confirm("Click OK to Delete")){
			var data = {
				finance_id : finance_id,
			};
			
			$.ajax({
				url: "secrets/delete_finance",
				type: "POST",
				dataType: "json",
				async: true,
				data: data,
				success: function (response) {
					if (response.status == 1) {
						swal({
							title: 'Success!',
							text: response.message,
							type: 'success',
							onClose: function () {
								location.reload('true');
							}
						});
						location.reload('true');
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
		}
	};
	</script>