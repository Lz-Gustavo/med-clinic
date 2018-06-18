<!DOCTYPE html>
<html lang = "pt-br">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Secretaria</title>
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
	<script src="../JScript/"></script>
</head>
<body>
	<script>
		function validate(var id) {
			var i;
			var x = new Array();
			for (i = 0; i < 3; i++){
				x[i] = document.forms[id][i].value;
				if (x[i] == "") {
					alert("Todos os campos devem estar preenchidos");
					return false;
				}
			}
			//alert("Dados enviados com sucesso!");
			return true;
		}
	</script>

	<a href = "../index.php"><b> <--- Voltar</b></a><br><br>

	<h3>Registrar Cadastro:</h3><br>
	<form method = "post">
		<br>
		<span>Nome: </span><input type = "text" name = "name" required><br><br>
		
		<span>Sobrenome: </span><input type = "text" name = "last_name"><br><br>

		<span>Funcao: </span><input type = "text" name = "role" required><br><br>
		
		<br><br>
		<button type = "submit">Submeter!</button>
	</form><br>

	<h3>Agendar Consulta:</h3><br>
	<form method = "post">
		<br>
		<span>Nome: </span><input type = "text" name = "name" required><br><br>
		
		<span>Sobrenome: </span><input type = "text" name = "last_name" required><br><br>

		<span>Nome do Medico: </span><input type = "text" name = "doctor_name" required><br><br>

		<span>Data: </span><input type = "date" name = "appt_date" required><br><br>
		
		<br><br>
		<button type = "submit">Submeter!</button>
	</form><br>

	<?php
		require_once "../../php_backend/class/storage.php";
		require_once "../../php_backend/class/person.php";
		require_once "../../php_backend/class/secretary.php";
		require_once "../../php_backend/class/doctor.php";
		require_once "../../php_backend/class/patient.php";

		$hd = Storage::getInstance();
		//$hd->show_all("medico");

		$secretary = new Secretary("Maria", "da Rosa", "Atendente");

		if (isset($_POST['role'])) {

			$role = $_POST['role'];
			if (strcasecmp($role, "medico") == 0) {

					echo "eae meu consagrado doutor!<br>";
					$secretary->add_changes("Nome:", $_POST['name']);
					$secretary->add_changes("Sobrenome:", $_POST['last_name']);
					$secretary->commit_changes("medico");
					
					$secretary->show_all_doctors();
			}
			else if (strcasecmp($role, "paciente") == 0) {

				echo "eae meu abencoado cidadao!<br>";
				$secretary->add_changes("Nome:", $_POST['name']);
				$secretary->add_changes("Sobrenome:", $_POST['last_name']);
				$secretary->commit_changes("paciente");

				$secretary->show_all_patients();
			}
		}
		if (isset($_POST['appt_date'])) {

			echo "aquela consultinha maravilha!<br>";
			$secretary->add_changes("Nome:", $_POST['name']);
			$secretary->add_changes("Sobrenome:", $_POST['last_name']);
			$secretary->add_changes("Nome-do-Medico:", $_POST['doctor_name']);
			$secretary->add_changes("Data:", $_POST['appt_date']);
			$secretary->commit_changes("history");

			$secretary->check_schedule();
		}

	?>

</body>
</html>