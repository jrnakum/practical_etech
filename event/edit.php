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
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
	<?php include('../../practicaletech/header.php'); ?>
		<div class="content-wrapper">
			<section class="content">
				<div class="row">
					<div class="col-md-10">
						<div class="card card-primary">
							<div class="card-header">
							<h3 class="card-title">Create Product</h3>
						</div>
						<!-- controller/ProductController.php -->
						<?php include('../controller/EventController.php'); ?>
						<form action="" method="post" id="edit" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
                                    <input type="hidden" id="id" name="id" value="<?php echo $result['id'] ?>" class="form-control">
									<label for="inputName">Name</label>
									<input type="text" id="name" name="name" value="<?php echo $result['name'] ?>" class="form-control">
								</div>
								<div class="form-group">
									<label for="inputName">Location</label>
									<input type="text" id="location" name="location" class="form-control" value="<?php echo $result['location'] ?>">
								</div>
								<div class="form-group">
									<label for="inputName">Date</label>
									<input type="text" id="date" name="date" class="form-control" value="<?php echo date('m/d/Y',strtotime($result['event_date'])) ?>">
								</div>
								<div class="form-group">
									<label for="inputClientCompany">Image</label>
									<input type="file" name="image" id="image" value="<?php echo $result['photos'] ?>" class="form-control">
								</div>
								<div class="form-group">
									<label for="inputStatus">Status</label>
									<select id="inputStatus" name="status" class="form-control custom-select">
										<option <?php echo $result['status'] == 'upcoming' ? 'selected' :''; ?> value="upcoming">Upcoming</option>
										<option <?php echo $result['status'] == 'active' ? 'selected' :''; ?> value="active">Active</option>
										<option <?php echo $result['status'] == 'past' ? 'selected' :''; ?> value="past">Past</option>
									</select>
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" name="update" class="btn btn-success">Submit</button>
								<a href="/practicaletech/dashboard.php" class="btn btn-secondary">Cancel</a>
							</div>
						</form>
						<!-- </div> -->
					</div>
					
				</div>
				
			</section>
		</div>
	</div>

</body>


<!-- jQuery -->
<script src="../css/jquery/jquery.min.js"></script>
<script src="../js/adminlte.min.js"></script>
<script src="../js/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#create").validate({
		rules: {
			name: {
				required: true,
			},
			price: {
				required: true,
			},
			image: {
				required: true,
			},

		},
		errorElement: 'span',
			errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.error_class').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		},
		submitHandler: function(form) {
		form.submit();
		}
  });
</script>

</body>
</html>
