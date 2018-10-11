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
	<!-- daypilot libraries -->
	<link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=2018.2.232" />
	<link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=2018.2.232" />
	<link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=2018.2.232" />
	<script src="../helpers/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="../js/daypilot-all.min.js?v=2018.2.232" type="text/javascript"></script>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!-- CSS Files -->
	<link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="">
	<div class="wrapper ">
		<div class="sidebar" data-color="purple" data-background-color="white">
			<div class="logo">
				<a class="simple-text logo-normal">
					MedClinic
				</a>
			</div>
			<div class="sidebar-wrapper">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="doctor_profile.php">
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
					<li class="nav-item active">
						<a class="nav-link" href="#0">
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
						<a class="navbar-brand" href="#pablo"></a>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
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
			<!-- End Navbar -->
			<div class="content" style='align-items: center;'>
		
				<?php
					//ini_set('display_errors', 1);
					//ini_set('display_startup_errors', 1);
					//error_reporting(E_ALL);

					require_once "../../../php_backend/class/storage.php";

					session_start();
					
					$db_instance = Storage::getInstance();
					$db_instance->connect("GeracaoSaude");
					
					// TODO: show just clinics that are associated with $_SESSION['login_crm'] on func_clinicas
					// table, and a hiperlink to each corresponding page

					$sql = "SELECT clinicas.id, clinicas.nome, clinicas.descricao ";
                    $sql .= "FROM GeracaoSaude.clinicas RIGHT JOIN GeracaoSaude.func_clinica ON clinicas.id=func_clinica.clinica WHERE func_clinica.crm='".$_SESSION['login_crm']."'";

					$result = $db_instance->SQLretrieve($sql);
					
					for ($i = 0; $i < count($result); $i++) {
						echo "<button class='btn btn-info' style='width:100%; font-size:20px;' onclick='redirect(".$result[$i]['id'].")'>".$result[$i]['nome']."</button>";
					}

					$db_instance->disconnect();
				?>
				
			</div>
		</div>
		<!--   Core JS Files   -->
		<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
		<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
		<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
		<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
		<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
		<script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
		
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

		<script>
			function redirect(id) {
				alert(id);
				window.location = "doctor_redirect.php?id="+id;
			};
		</script>
</body>

</html>