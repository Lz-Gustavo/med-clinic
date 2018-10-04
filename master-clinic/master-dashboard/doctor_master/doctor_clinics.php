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
					<li class="nav-item">
						<a class="nav-link" href="doctor_consulties.html">
							<i class="material-icons">calendar_today</i>
							<p>Consulties</p>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="doctor_schedule.html">
							<i class="material-icons">schedule</i>
							<p>Schedule</p>
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
						<a class="navbar-brand" href="#pablo">Doctor: Luiz</a>
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
								<a class="nav-link" href="#pablo">
									<i class="material-icons">notifications</i> Notifications
								</a>
							</li>
							<!-- your navbar here -->
						</ul>
					</div>
				</div>
			</nav>
			<!-- End Navbar -->
			<div class="content">

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
					$sql = "SELECT * FROM GeracaoSaude.clinicas;";
					$result = $db_instance->SQLretrieve($sql);
					
					for ($i = 0; $i < count($result); $i++) {

						echo "<h3>".$result[$i]['nome']." - ".$result[$i]['descricao']."</h3>";
					}

					$db_instance->disconnect();
				?>

				<p>conteudo aqui</p>
				
			</div>
		</div>
		<!--   Core JS Files   -->
		<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
		<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
		<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
		<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
		<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
		<script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>

		<!--Daypilot JS-->
		<script type="text/javascript">
			var dp = new DayPilot.Month("dp");
			dp.viewType = 'Weeks';
			dp.showWeekend = false;

			// view
			dp.startDate = "2018-09-28";  // or just dp.startDate = "2013-03-25";

			// generate and load events
			for (var i = 0; i < 10; i++) {
				var duration = Math.floor(Math.random() * 1.2);
				var start = Math.floor(Math.random() * 6) - 3; // -3 to 3

				var e = new DayPilot.Event({
					start: new DayPilot.Date("2018-09-28T00:00:00").addDays(start),
					end: new DayPilot.Date("2018-09-28T12:00:00").addDays(start).addDays(duration),
					id: DayPilot.guid(),
					text: "Event " + i
				});
				dp.events.add(e);
			}

			// event creating
			dp.onTimeRangeSelected = function (args) {
				//var name = prompt("New event name:", "Event");
				var modal = new DayPilot.Modal();
				modal.onClosed = function (args) {
					console.log(args)
					var e = new DayPilot.Event({
						start: args.start,
						end: args.end,
						//id: DayPilot.guid(),
						text: name
					});
					dp.events.add(e);
					dp.clearSelection();
					//console.log(e.data)
				};

				modal.showUrl("new_month.php?start=" + args.start + "&end=" + args.end);
			};

			// event deleting
			dp.onEventDeleted = function (args) {
				this.message("Event deleted.");
			};

			dp.onEventClicked = function (args) {
				alert("clicked: " + args.e.id());
			};

			dp.init();
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