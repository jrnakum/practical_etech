<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Practical</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="css/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<!-- <//?php include('../practicaletech/header.php'); ?> -->
<div class="login-box">
  <div class="card card-outline card-primary">
	<div class="card-header text-center">
	  <a href="javascript:void(0)" class="h1"><b>Register</b></a>
	</div>
	<div class="card-body">
	  <!-- <p class="login-box-msg">Sign in to start your session</p> -->
	<?php include('./controller/RegisterController.php'); ?>
	<?php echo $emailExist; ?>
	<?php echo $successMsg; ?>
	<?php //echo $emailVerifySuccess; ?>
	
	<form action="" method="post" id="register">
		<div class="input-group mb-3">
		  <input type="text" class="form-control" name="firstname" placeholder="First Name">
		</div>
		<div class="input-group mb-3">
		  <input type="text" class="form-control" name="lastname" placeholder="Last Name">
		</div>
		<div class="input-group mb-3">
		  <input type="email" class="form-control" name="email" placeholder="Email">
		</div>
		<div class="input-group mb-3">
		  <input type="text" class="form-control" name="phone" placeholder="Phone" maxlength="10">
		</div>
		<div class="input-group mb-3">
		  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>
		<div class="input-group mb-3">
		  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
		</div>
		<div class="row">
		  <div class="col-8">
		  </div>
		  <!-- /.col -->
		  <div class="col-4">
			<button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
		  </div>
		  <!-- /.col -->
		</div>
	  </form>
	  <p class="mb-0">
		<a href="../practicaletech/login.php" class="text-center">Login</a>
	  </p>
	</div>
	<!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="css/jquery/jquery.min.js"></script>
<script src="js/adminlte.min.js"></script>
<script src="js/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() { 
		jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[a-z]+$/i.test(value);
		}, "Letters only please"); 

	});
	
		
	$("#register").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			email: {
				required: true,
				email: true
			},
			phone: {
				required:true,
				digits: true,
				maxlength:10
			},
			password: {
				required: true,
				minlength: 8,
				maxlength: 15
			},
			confirm_password: {
				equalTo: "#password"
			}
		},
		errorElement: 'span',
			errorPlacement: function (error, element) {
			console.log(error);
			error.addClass('invalid-feedback');
			element.closest('.error_class').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			console.log(errorClass, validClass);
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
