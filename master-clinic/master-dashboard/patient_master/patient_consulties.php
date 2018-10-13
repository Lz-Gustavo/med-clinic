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
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'
	/>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
	/>
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
					<li class="nav-item">
						<a class="nav-link" href="patient_profile.php">
							<i class="material-icons">person</i>
							<p>Profile</p>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="patient_new_consultie.html">
							<i class="material-icons">add_circle</i>
							<p>New Appointment</p>
						</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="#0">
							<i class="material-icons">schedule</i>
							<p>History</p>
						</a>
					</li>
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
						</ul>
					</div>
				</div>
			</nav>

			<!-- End Navbar -->
			<div class="content">
			<div class="container-fluid">
				<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-info">
							<h4 class="card-title ">Consulties</h4>
							<p class="card-category"></p>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class=" text-primary">
										<th>CRM</th>
										<th>Clinic ID</th>
										<th>Date</th>
										<th>Hour</th>
										<!--th>Notes</th-->
										<th>Prescription</th>
									</thead>

									<tbody>
										<?php
											ini_set('display_errors', 1);
											ini_set('display_startup_errors', 1);
											error_reporting(E_ALL);

											require_once "../../../php_backend/class/storage.php";

											session_start();
											
											$db_instance = Storage::getInstance();
											$db_instance->connect("GeracaoSaude");
											$now = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
											
											$sql = "SELECT * FROM GeracaoSaude.consultas WHERE cpf='".$_SESSION['login_cpf']."';";
											$result = $db_instance->SQLretrieve($sql);
											
											for ($i = 0; $i < count($result); $i++) {

												$hour = $db_instance->translate_time($result[$i]['horario']);

												echo "<tr>";
												echo "<td>".$result[$i]['crm']."</td>";
												echo "<td>".$result[$i]['clinica']."</td>";
												echo "<td>".$result[$i]['dia']."</td>";
												echo "<td>".$hour."</td>";
												//echo "<td>".$result[$i]['obs']."</td>";
												echo "<td>".$result[$i]['receita']."</td>";
												echo "</tr>";
											}

											$db_instance->disconnect();
										?>
									</tbody>
								</table>
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

	<!--   Core JS Files   -->
	<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
	<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
	<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
	<!--  Google Maps Plugin    -->
	<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
	<!-- Chartist JS -->
	<script src="assets/js/plugins/chartist.min.js"></script>
	<!--  Notifications Plugin    -->
	<script src="assets/js/plugins/bootstrap-notify.js"></script>
	<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>

</body>
</html>