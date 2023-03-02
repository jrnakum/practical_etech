<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Practical</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="../css/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="../css/adminlte.min.css">
</head>
<body class="hold-transition login-page">

<div class="wrapper">
<?php include('../../practicaletech/header.php'); ?>

<section class="content" style="width: 1000px;">
			<div class="container-fluid">
			 <section class="content-header">
						<div class="row mb-2">
								<div class="col-sm-6">
										<h1>Event List</h1>
								</div>
						</div>
				</section>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<!-- <h3 class="card-title">Expandable Table</h3> -->
								<div class="row">
									<div class="col-md-9 ">
										<form action="" method="get">
										<div class="input-group input-group-sm col-sm-10" >
											<label style="margin-right:3px">Search:</label>
											<?php
												$name = "";
												if( !empty( $_GET['name'] ) ){
													$name = $_GET['name'];
												}
											?>
											<input type="text" name="name" style="margin-right:15px;width: 130px" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Event Name">
											<input type="submit" class="form-control" value="Search">
										</div>
										
										</form>
									</div>
									<div class="col-md-3 float-right">
										<a href="../event/create.php" class="btn btn-default">Add Event</a>
									</div>
								</div>
							</div>
							<!-- ./card-header -->
							<?php include('../controller/EventController.php'); ?>
							<div class="card-body">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<!-- <th>#</th> -->
											<?php
												$sortDirection = "";
												if( !empty( $_GET['sortDirection'] ) ){
													$sortDirection = $_GET['sortDirection'];
												}
											?>
											<th><a href="../event/list.php?sortKey=name&sortDirection=<?php echo $sortDirection=='desc' ? 'asc': 'desc' ?>">Name</a></th>
											<th>Location</th>
											<th>Date</th>
											<th>image</th>
											<th>Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if( !empty( $result ) ) {
											foreach( $result as $k=>$v ) {
										?>
										<tr>
											<td><?php echo $v["name"]; ?></td>
											<td><?php echo $v["location"]; ?></td>
											<td><?php echo $v["event_date"]; ?></td>
											<td><img src="../uploads/<?php echo $v["photos"]; ?>" height="15" width="18"></td>
											<td><?php echo ucfirst($v["status"])  ?></td>
											<!-- <td></td> -->
											<td class="text-center">
												<a class="btn btn-info btn-sm" href="../event/edit.php?id=<?php echo $v["id"]; ?>" >
													<i class="fas fa-pencil-alt"></i>
												</a>
												<a class="btn btn-danger btn-sm" href="../event/delete.php?id=<?php echo $v["id"]; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
													<i class="fas fa-trash"></i>
												</a>
											</td>
										</tr>
										<?php } } ?>
										
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>
	</div>
<script src="../css/jquery/jquery.min.js"></script>
<script src="../js/adminlte.min.js"></script>

</body>
</html>
