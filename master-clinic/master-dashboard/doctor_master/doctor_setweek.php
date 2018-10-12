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
			dp.startDate = "2018-10-28"; //a regular sunday
			dp.viewType = "WorkWeek";
			dp.headerDateFormat = "dddd";
			dp.eventDeleteHandling = "Update";
			dp.businessBeginsHour = 8;
			dp.eventMoveHandling = "Disabled";
			dp.eventResizeHandling = "Disabled";

			// event creating
			dp.onTimeRangeSelected = function (args) {
				//var name = prompt("New event name:", "Event");
				var modal = new DayPilot.Modal();
				modal.onClosed = function (args) {
					console.log(args.result.args[0]);
					var e = new DayPilot.Event({
						start: args.result.args[0].start,
						end: args.result.args[0].end,
						//id: DayPilot.guid(),
						text: args.result.args[0].clinic,
					});
					dp.events.add(e);
					dp.clearSelection();
					//console.log(e.data)
				};
				//console.log(args);
				modal.showUrl("new_calendar.php?start=" + args.start + "&end=" + args.end);
			};

			//event remove
			dp.onEventDeleted = function (args) {
				var e = new DayPilot.Event({
					start: args.start,
					end: args.end,
					id: DayPilot.guid(),
					text: name
				});
				dp.events.remove(e);
				console.log(args)
			};

			//start
			dp.init();

			dp.events.list = [
				<?php

					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);

					require_once "../../../php_backend/class/storage.php";

					$db_instance = Storage::getInstance();
					$db_instance->connect("GeracaoSaude");

					$week = array("dom", "seg", "ter", "qua", "qui", "sex", "sab");
					$json = "";

					$filter = array(
						"TABLE:" => "func_clinica",
						"CRM:" => $_SESSION['login_crm']
					);
					$result = $db_instance->read($filter);

					for ($i = 1; $i < 6; $i++) {

						$time = str_split($result[0][$week[$i]]);
						$array_bitmap = $time;

						for ($j = 0; $j < count($array_bitmap); $j++) {
							
							if ($array_bitmap[$j] == "0") {
								
								// morning hours indexes on bitmap
								if ($i < 5) 
									$ini_hour = (8 + $j);
								
								// afternoon
								else 
									$ini_hour = 9 + $j;

								if ($ini_hour < 10)
									$ini_hour = "0".$ini_hour;

								$fin_hour = $ini_hour + 1;
								if ($fin_hour < 10)
									$fin_hour = "0".$fin_hour;

								$inicio = "2018-10-".(21+$i)."T".$ini_hour.":00".":00";
								$fim = "2018-10-".(21+$i)."T".$fin_hour.":00".":00";

								$text = "Clinica ".$result[0]['clinica'];
								$json .= "{ \"start\": \"".$inicio."\", \"end\": \"".$fim."\", \"id\": \"".$i."\", \"text\": \"".$text."\"}, ";
							}
						}
						
					}
					echo $json;			

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