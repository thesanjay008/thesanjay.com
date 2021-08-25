	<section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-clone"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Loans</span>
			  <span class="info-box-number">121</span>
            </div>
          </div>
        </div>
		
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Loan Amount</span>
              <span class="info-box-number"><?php echo '111'; ?></span>
            </div>
          </div>
        </div>
		
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Interst</span>
              <span class="info-box-number">3,42,520</span>
            </div>
          </div>
        </div>
		
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number"><?php echo sizeof($users); ?></span>
            </div>
          </div>
        </div>
		<div class="clearfix visible-sm-block"></div>
      </div>
      <!-- /.row -->

    <!-- Main row -->
	<div class="row">
		<div class="col-md-8 col-xs-12">
			<div class="row">
				<div class="col-md-12">
				  <div class="box">
					<div class="box-header">
					  <h3 class="box-title">Aavilable Finance</h3>
					</div>
					<div class="box-body">
					  <a href="admin/finance/home" class="btn btn-app">
						<span class="badge bg-blue">5</span>
						<i class="fa fa-circle-o"></i> Daily
					  </a>
					  <a href="admin/finance/gold" class="btn btn-app">
						<?php if(isset($loan_data['gold'])){ echo'<span class="badge bg-blue">'.$loan_data['gold'].'</span>'; }?>
						<i class="fa fa-circle-o"></i> Monthly
					  </a>
					  <a href="admin/finance/personal" class="btn btn-app">
					  <?php if(isset($loan_data['personal'])){ echo'<span class="badge bg-blue">'.$loan_data['personal'].'</span>'; }?>
						<i class="fa fa-circle-o"></i> Yearly
					  </a>
					</div>
				  </div>
				</div>
				
				<!-- Upcoming Instalment-->
				<div class="col-md-12">
				  <div class="box box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">Upcoming Instalment</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					  <div class="table-responsive">
						<table class="table no-margin">
						  <thead>
						  <tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Instalment Price</th>
							<th>Finance Type</th>
							<th>Date</th>
							<td class="tab"><b class="pull-right">Action</b></td>
						  </tr>
						  </thead>
						  <tbody>
							  <?php if(! empty($upcoming_instalment)): ?>
							  <?php foreach($upcoming_instalment as $key=>$udata): ?>
							  <tr>
								<td><a href="javascript:void(0)"><?= $key + 1; ?></a></td>
								<td><?php echo $udata['fname']; ?></td>
								<td><div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo $udata['lname']; ?></div></td>
								<td><?php echo $udata['instalment_price']; ?></td>
								<td><b><?php echo ucfirst($udata['finance_type']); 0?></b></td>
								<?php $instalments_date= date_create($udata['instalments_date']); ?>
								<td><?php echo date_format($instalments_date, 'd - M - Y'); ?></td>
								<td>
									<span class="pull-right">
									<a data-toggle="tooltip" title="View Instalments" href="admin/instalments/<?php echo $udata['finance_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
									</span>
								</td>
							  </tr>
							  <?php endforeach; ?>
							  <?php endif; ?>
						  </tbody>
						</table>
					  </div>
					</div>
				  </div>
				</div>
				
				<div class="col-md-12">
				  <div class="box">
					<div class="box-header with-border">
					  <h3 class="box-title">Upcoming Monthly Loans</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					  <div class="table-responsive">
						<table class="table no-margin">
						  <thead>
						  <tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Instalment Price</th>
							<th>Date</th>
							<td class="tab"><b class="pull-right">Action</b></td>
						  </tr>
						  </thead>
						  <tbody>
							  <?php if(! empty($upcoming_homeloans)): ?>
							  <?php foreach($upcoming_homeloans as $key=>$udata): ?>
							  <tr>
								<td><a href="javascript:void(0)"><?= $key + 1; ?></a></td>
								<td><?php echo $udata['fname']; ?></td>
								<td><div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo $udata['lname']; ?></div></td>
								<td><?php echo $udata['instalment_price']; ?></td>
								<!--<td><?php //echo date('d M Y', $udata['date']); ?></td>-->
								<?php $instalments_date= date_create($udata['instalments_date']); ?>
								<td><?php echo date_format($instalments_date, 'd - M - Y'); ?></td>	
								<td>
									<span class="pull-right">
									<a data-toggle="tooltip" title="View Instalments" href="admin/finance_member/<?php echo $udata['user_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
									</span>
								</td>
							  </tr>
							  <?php endforeach; ?>
							  <?php endif; ?>
						  </tbody>
						</table>
					  </div>
					</div>
				  </div>
				</div>
				
				<!-- Upclosed Instalment-->
				<div class="col-md-12">
				  <div class="box box-danger">
					<div class="box-header with-border">
					  <h3 class="box-title">Pending Instalment</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					  <div class="table-responsive">
						<table class="table no-margin">
						  <thead>
						  <tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Instalment Price</th>
							<th>Date</th>
							<td class="tab"><b class="pull-right">Action</b></td>
						  </tr>
						  </thead>
						  <tbody>
							  <?php if(! empty($upclosed_instalment)): ?>
							  <?php foreach($upclosed_instalment as $key=>$udata): ?>
							  <tr>
								<td><a href="javascript:void(0)"><?= $key + 1; ?></a></td>
								<td><?php echo $udata['fname']; ?></td>
								<td><div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo $udata['lname']; ?></div></td>
								<td><?php echo $udata['instalment_price']; ?></td>
								<?php $instalments_date= date_create($udata['instalments_date']); ?>
								<td><?php echo date_format($instalments_date, 'd - M - Y'); ?></td>
								<td>
									<span class="pull-right">
									<a data-toggle="tooltip" title="View Instalments" href="admin/instalments/<?php echo $udata['finance_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
									</span>
								</td>
							  </tr>
							  <?php endforeach; ?>
							  <?php endif; ?>
						  </tbody>
						</table>
					  </div>
					</div>
				  </div>
				</div>
				
				<!-- USERS LIST -->
				<div class="col-md-12">
				  <div class="box box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">Members</h3>

					  <div class="box-tools pull-right">
						<?= anchor('admin/add_user', 'Add New', ['class'=>'btn btn-sm btn-info btn-flat pull-left']) ?>
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					  <div class="table-responsive">
						<table class="table no-margin">
						  <thead>
						  <tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Role</th>
						  </tr>
						  </thead>
						  <tbody>
							  <?php if(! empty($users)): ?>
							  <?php foreach($users as $row): ?>
							  <tr>
								<td><a href=""></a></td>
								<td>AAA</td>
								<td>
								  <div class="sparkbar" data-color="#00a65a" data-height="20">asdas</div>
								</td>
								<td><span class="label label-success">asdas</span></td>
							  </tr>
							  <?php endforeach; ?>
							  <?php endif; ?>
						  </tbody>
						</table>
					  </div>
					</div>
					<div class="box-footer clearfix">
					  <a href="admin/users" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
					</div>
				  </div>
				</div>
			</div>
		</div>
		
		<!-- RIGHT SIDE -->
        <div class="col-md-4">
			<div class="col-md-12 col-xs-12">
				<div class="row">
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Recently Added Loans</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					  <ul class="products-list product-list-in-box">
						<?php if(!empty($recent_loans)){ ?>
						  <?php foreach($recent_loans as $data){?>
						<li class="item">
						  <div class="product-img">
							<img src="support/admin/dist/img/default-50x50.gif" alt="Product Image">
						  </div>
						  <div class="product-info">
							<a href="javascript:void(0)" class="product-title"><?php echo $data['fname'] ." ".$data['lname']; ?>
							  <span class="label label-warning pull-right"><?php echo $data['loan_amount']; ?></span></a>
								<span class="product-description">
								  <?php echo ucfirst($data['finance_type']); ?> Loan
								</span>
						  </div>
						</li>
						<?php } } ?>
					  </ul>
					</div>
					<div class="box-footer text-center">
					  <a href="admin/finance/all" class="uppercase">View All Loans</a>
					</div>
				  </div>
				</div>
			</div>
        </div>
    </div>
    </section>
	
	<script type="text/javascript">
		$(document).ready(function(e) {
			$('.dashboard_page').addClass('active');
		});
	</script>