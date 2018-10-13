<!doctype html>
<html lang="en">
<?php session_start(); ?>
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
					<li class="nav-item active">
						<a class="nav-link" href="#0">
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
						<a class="navbar-brand" href="#pablo"></a>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false"
					 aria-label="Toggle navigation">
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
			<div class="content">
				<div class="container-fluid">
					<div class="space">
						Week:
						<a href="javascript:dp.startDate = dp.startDate.addDays(-7); dp.update();">Previous</a>
						|
						<a href="javascript:dp.startDate = dp.startDate.addDays(7); dp.update();">Next</a>
					</div>

					<div id="dp"></div>
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

		<!-- Chartist JS -->
		<script src="assets/js/plugins/chartist.min.js"></script>
		<!--  Notifications Plugin    -->
		<script src="assets/js/plugins/bootstrap-notify.js"></script>
		<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
		<script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>

		<!-- Daypilot scripts-->
		<script type="text/javascript">

			var dp = new DayPilot.Calendar("dp");

			// view
			dp.startDate = "2018-10-28";  // or just dp.startDate = "2013-03-25";
			dp.viewType = "WorkWeek";
			dp.businessBeginsHour = 8;
			dp.timeRangeSelectedHandling = "Disabled";
			dp.eventDeleteHandling = "Disabled";
			dp.eventMoveHandling = "Disabled";
			dp.eventResizeHandling = "Disabled";
			dp.eventClickHandling ="Disabled";
			dp.eventHoverHandling = "Disabled";
	
			//start
			dp.init();

			dp.events.list = [
				<?php

					//ini_set('display_errors', 1);
					//ini_set('display_startup_errors', 1);
					//error_reporting(E_ALL);

					require_once "../../../php_backend/class/storage.php";

					$db_instance = Storage::getInstance();
					$db_instance->connect("GeracaoSaude");

					$filter = array(
						"TABLE:" => "consultas",
						"crm:" => $_SESSION['login_crm'],
					);

					$sql = "SELECT pacientes.cpf, pacientes.nome, consultas.clinica, consultas.dia, consultas.horario "; 
					$sql .= "FROM GeracaoSaude.pacientes RIGHT JOIN GeracaoSaude.consultas ON consultas.cpf=pacientes.cpf WHERE consultas.crm='".$_SESSION['login_crm']."';";
					
					$result = $db_instance->SQLretrieve($sql);

					//$result = $db_instance->read($filter);
					
					for ($i = 0; $i < count($result); $i++) {

						$hour = $db_instance->translate_time($result[$i]['horario']);

						if (strpos($hour, "PM") != FALSE) {
							
							$hour = rtrim($hour, "PM");
							$hour = ((int) $hour) + 12;
							$hour_fim = $hour + 1;

							$hour = $hour.":00";
							$hour_fim = $hour_fim.":00";
						}
						else {
							
							$hour = rtrim($hour, "AM");
							if (strlen($hour) == 4)
								$hour = "0".$hour;

							$hour_fim = ((int) $hour) + 1;
							
							if ($hour_fim < 10)
								$hour_fim = "0".$hour_fim;
							
							$hour_fim = $hour_fim.":00";
						}

						$inicio = $result[$i]['dia']."T".$hour.":00";
						$fim = $result[$i]['dia']."T".$hour_fim.":00";
						
						$text = "Clinica ".$result[$i]['clinica']." - ".$result[$i]['nome'].", ".$result[$i]['cpf'];

						$var = "{ \"start\": \"".$inicio."\", \"end\": \"".$fim."\", \"id\": \"".$i."\", \"text\": \"".$text."\"},";
						echo $var;
					}

					$db_instance->disconnect();
				?>
			];

			dp.update();

		</script>

		<script type="text/javascript">
			$(document).ready(function () {
				var url = window.location.href;
				var filename = url.substring(url.lastIndexOf('/') + 1);
				if (filename === "") filename = "index.html";
				$(".menu a[href='" + filename + "']").addClass("selected");
			});

		</script>
</body>

</html>