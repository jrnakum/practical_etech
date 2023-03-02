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
	  <a href="javascript:void(0)" class="h1"><b>Login</b></a>
	</div>
	<div class="card-body">
	  <!-- <p class="login-box-msg">Sign in to start your session</p> -->
	<?php include('./controller/LoginController.php'); ?>
	<?php echo $accountNotExistErr; ?>
	<?php echo $emailPwdErr; ?>
	<?php echo $verificationRequiredErr; ?>
	
	  <form action="" method="post" id="login">
		<div class="input-group mb-3">
		  <input type="email" class="form-control" name="email" placeholder="Email">
		</div>
		<div class="input-group mb-3">
		  <input type="password" class="form-control" name="password" placeholder="Password">
		</div>
		<div class="row">
		  <div class="col-8">
			
		  </div>
		  <!-- /.col -->
		  <div class="col-4">
			<button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
		  </div>
		  <!-- /.col -->
		</div>
	  </form>

	  <p class="mb-0">
	  <a href="../practicaletech/forgotpassword.php" class="text-center">I forgot my password</a>
		</p>
	  <p class="mb-0">
	  	<a href="../practicaletech/register.php" class="text-center">Register</a>
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
	$("#login").validate({
    rules: {
		email: {
			required: true,
			email: true
		},
		password: {
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
