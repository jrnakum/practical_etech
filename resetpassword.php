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
	<?php include('./controller/ResetPasswordController.php'); ?>
	<?php echo $emailExist; ?>
	<?php echo $successMsg; ?>
	<?php //echo $emailVerifySuccess; ?>
	<?php if(!empty($user_id)) { ?>
	<form action="" method="post" id="resetpassword">
		<div class="input-group mb-3">
			<input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $user_id?>">
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
			<button type="submit" name="resetpassword" class="btn btn-primary btn-block">Submit</button>
		  </div>
		  <!-- /.col -->
		</div>
	  </form>
	</div>
	<?php } else { ?>
		<div class="alert alert-danger">
                    User token expired
                </div>
	<?php } ?>
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
	
		
	$("#resetpassword").validate({
		rules: {
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
