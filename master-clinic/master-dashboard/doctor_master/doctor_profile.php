<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		MedClinic
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!-- CSS Files -->
	<link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="">
  	<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">

		<div class="logo">
			<img src="../../master-login/src/medclinic-logo.png"  alt="Logo" title="Logo" width="100" style=" display: block;margin-left: auto;margin-right: auto;">
        	<a class="simple-text logo-normal">
        		MedClinic
    		</a>
    	</div>
		
		<div class="sidebar-wrapper">
        <ul class="nav">
        	<li class="nav-item active">
				<a class="nav-link" href="#0">
				<i class="material-icons">person</i>
				<p>Profile</p>
				</a>
          	</li>
			<!--li class="nav-item">
				<a class="nav-link" href="doctor_consulties.html">
				<i class="material-icons">calendar_today</i>
				<p>Calendar</p>
				</a>
			</li-->
			<li class="nav-item">
				<a class="nav-link" href="doctor_schedule.php">
				<i class="material-icons">schedule</i>
				<p>Weekly Schedule</p>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="doctor_clinics.php">
				<i class="material-icons">class</i>
				<p>Clinics</p>
				</a>
			</li>
			<!-- your sidebar here -->
        </ul>
      	</div>
	</div>
	
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#"></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="../../index.html">
                	<i class="material-icons">arrow_back</i> LOGOUT
                </a>
              </li>
              <!-- your navbar here -->
            </ul>
        	</div>
        </div>
		</nav>
	  
		<?php
			//ini_set('display_errors', 1);
			//ini_set('display_startup_errors', 1);
			//error_reporting(E_ALL);

			require_once "../../../php_backend/class/storage.php";

			session_start();

			$db_instance = Storage::getInstance();
			$db_instance->connect("GeracaoSaude");

			$retrieve_data = array(
				"TABLE:" => "medicos",
				"crm" => $_SESSION['login_crm']
			);

			$result = $db_instance->read($retrieve_data);

			$_POST['crm'] = $result[0]['crm'];
			$_POST['name'] = $result[0]['nome'];
			$_POST['last_name'] = $result[0]['sobrenome'];
			$_POST['spec'] = $result[0]['especializacao'];
			$_POST['email'] = $result[0]['email'];
			$_POST['tel'] = $result[0]['telefone'];
			$_POST['addr'] = $result[0]['endereco'];

			$db_instance->disconnect();
		?>

    	<!-- End Navbar -->
		<div class="content">
			<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-info">
					<h4 class="card-title">Personal Information</h4>
					<p class="card-category">By sharing your data, you agree to abide by our MedClinic Terms of Service and Honor Code and agree to our Privacy Policy.</p>
					</div>
					<div class="card-body">
					<button id="setweek" class="btn btn-info pull-right">Set Weekly</button>

					<form method="post" action="../../../php_backend/save-forms/master/med_profile.php">
						<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							<label class="bmd-label-floating">Fist Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $_POST['name'] ?>" disabled>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label class="bmd-label-floating">Last Name</label>
							<input type="text" class="form-control" name="last_name" value="<?php echo $_POST['last_name'] ?>">
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-md-4">
							<div class="form-group">
							<label class="bmd-label-floating">Email address</label>
							<input type="email" class="form-control" name="email" value="<?php echo $_POST['email'] ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<label class="bmd-label-floating">Especialization</label>
							<input type="text" class="form-control" name="spec" value="<?php echo $_POST['spec'] ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<label class="bmd-label-floating">Telephone</label>
							<input type="text" class="form-control" name="tel" value="<?php echo $_POST['tel'] ?>">
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-md-4">
							<div class="form-group">
							<label class="bmd-label-floating">CRM</label>
							<input type="number" class="form-control" name="crm" value="<?php echo $_POST['crm'] ?>" disabled>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
							<label class="bmd-label-floating">Adress</label>
							<input type="text" class="form-control" name="addr" value="<?php echo $_POST['addr'] ?>">
							</div>
						</div>
						
						</div>

						<button type="submit" class="btn btn-info pull-right">Update Profile</button>
						<div class="clearfix"></div>
					</form>
					</div>
				</div>
				</div>
			</div>
			</div>
		</div>

		<footer class="footer">
			<div class="container-fluid">
			</div>
		</footer>
	
	</div>
	</div>

	<!-- Chartist JS -->
	<script src="assets/js/plugins/chartist.min.js"></script>
	<!--  Notifications Plugin    -->
	<script src="assets/js/plugins/bootstrap-notify.js"></script>
	<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
	
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

	<script>
		$(document).ready(function () {
			$("#setweek").click(function () {
				location.assign('doctor_setweek.php');
			});
		});
	</script>

</body>
</html>