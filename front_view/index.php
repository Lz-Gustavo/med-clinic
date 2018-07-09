<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PsyMed Dashboard</title>

	<!-- ICONS -->
	<!--link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css"-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />

	<!-- STYLE-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form">

					<!--span class="login100-form-title p-b-43">
						Login as
					</span-->
					<div class="login100-form-title p-b-30 animate-logo">
						<img src="images/logo.png" style="width:250px;height:127.5px;">
					</div>

					<div class="flex-sb-m w-full p-b-32">
						<button class="choice-adm-form-btn">
							Admin
						</button>
						<button class="choice-med-form-btn">
							Doctor
						</button>
					</div>

					<form method="post">
						<div class='hide_div'>
							<div class="wrap-input100 validate-input">
								<input class="input100" type="text" name="login_user" required>
								<span class="focus-input100"></span>
								<span class="label-input100">Username</span>
							</div>

							<div class="wrap-input100 validate-input" data-validate="Password is required">
								<input class="input100" type="password" name="login_password" required>
								<span class="focus-input100"></span>
								<span class="label-input100">Password</span>
							</div>

							<div class="flex-sb-m w-full p-t-3 p-b-32">
								<div class="contact100-form-checkbox">
									<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
									<label class="label-checkbox100" for="ckb1">
										Remember me
									</label>
								</div>

								<div>
									<a href="#" class="txt1">
										Forgot Password?
									</a>
								</div>
							</div>

							<div class="container-login100-form-btn">
								<button id="login-button" class="login100-form-btn">
									Login
								</button>
							</div>
						</div>
					</form>
			</div>
			<div class="login100-more" style="background-image: url('images/login_bg_min.png');">
			</div>
		</div>
	</div>

	<?php
		// using this php script as an action of login form makes unable to notify alerts about wrong user/passw combination

		require_once "../php_backend/class/storage.php";

		if (isset($_POST['login_user'])) {

			$hd = Storage::getInstance();
			if ($_POST['login_user'] == "admin") {
				
				$permission = $hd->login("atendente", $_POST['login_user'], $_POST['login_password']);
				if ($permission == 1) {

					session_start();
					$_SESSION['login_user'] = $_POST['login_user'];
					header("location: admin_panel/admin_panel.html");
				}
				else {
					echo "<script type='text/javascript'>alert('Incorrect Username or Password');</script>";
				}
			}
			else {
				$permission = $hd->login("medico", $_POST['login_user'], $_POST['login_password']);
				if ($permission == 1) {

					session_start();
					$_SESSION['login_user'] = $_POST['login_user'];
					header("location: doctor_panel/doctor_panel.html");
				}
				else {
					echo "<script type='text/javascript'>alert('Incorrect Username or Password');</script>";
				}
			}
		}
	?>

	<!-- JS SCRIPT -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>