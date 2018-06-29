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
	<a href = "index.html"><b> <--- Voltar</b></a><br><br>

	<h3>Teste Login:</h3><br>
	<form method = "post">

		<span>Usuario: </span><input type = "text" name = "login_user"><br><br>
		
		<span>Senha: </span><input type = "password" name = "login_psw"><br><br>

		<br>
		<button type = "submit">Submeter!</button>
	</form><br>

	<h3>Registrar Cadastro:</h3><br>
	<form method = "post">

		<span>Funcao: </span>
		<input type = "radio" name = "role" value = "paciente" checked> Paciente
		<input type = "radio" name = "role" value = "medico"> Medico
		<br><br>

		<span>Nome: </span><input type = "text" name = "name" required><br><br>
		
		<span>Sobrenome: </span><input type = "text" name = "last_name"><br><br>
		
		<span>Email: </span><input type = "email" name = "email"><br><br>

		<span>Telefone: </span><input type = "tel" name = "tel"><br><br>

		<span>CRM: (somente medico)</span><input type = "number" name = "crm" min = "0"><br><br>

		<br>
		<button type = "submit">Submeter!</button>
	</form><br>

	<h3>Agendar Consulta:</h3><br>
	<form method = "post">

		<span>Nome: </span><input type = "text" name = "name" required><br><br>
		
		<span>Sobrenome: </span><input type = "text" name = "last_name" required><br><br>

		<span>Nome do Medico: </span><input type = "text" name = "doctor_name" required><br><br>

		<span>CRM: </span><input type = "number" name = "crm" min = "0" required><br><br>

		<span>Data: </span><input type = "date" name = "appt_date" required><br><br>
		
		<br>
		<button type = "submit">Submeter!</button>
	</form><br>

	<h3>Buscar Consulta: (imagine inves de um form um filtro)</h3><br>
	<form method = "get">

		<span>Nome do Paciente: </span><input type = "text" name = "name" required><br><br>
		
		<span>Nome do Medico: </span><input type = "text" name = "doctor_name"><br><br>

		<span>Periodo: </span><br>
		<input type = "radio" name = "time" value = "all" checked> Todas<br>
		<input type = "radio" name = "time" value = "future"> Futuras<br>
		
		<br>
		<button type = "submit">Submeter!</button>
	</form><br>

	<h3>Alterar Consulta: (eu sei que eh so funcionalidade do medico)</h3><br>
	<form method = "post">

		<span>Nome do Paciente: </span><input type = "text" name = "name" required><br><br>

		<span>Receita: </span><input type = "text" name = "recipe" required><br><br>

		<span>Observacao: </span><input type = "text" name = "obs"><br><br>

		<br>
		<button type "submit">Submeter!</button>
	</form><br>

	<hr>
	<?php
		require_once "../php_backend/class/storage.php";
		require_once "../php_backend/class/person.php";
		require_once "../php_backend/class/secretary.php";
		require_once "../php_backend/class/doctor.php";
		require_once "../php_backend/class/patient.php";

		$secretary = new Secretary("admin", "istrator", "Atendente");

		if (isset($_POST['role'])) {

			$role = $_POST['role'];
			if (strcasecmp($role, "medico") == 0) {

				$secretary->add_changes("Nome:", $_POST['name']);
				$secretary->add_changes("Sobrenome:", $_POST['last_name']);
				$secretary->add_changes("Email:", $_POST['email']);
				$secretary->add_changes("Telefone:", $_POST['tel']);
				$secretary->add_changes("CRM:", $_POST['crm']);
				$secretary->commit_changes("medico");
				
				$secretary->show_all_doctors();
			}
			else if (strcasecmp($role, "paciente") == 0) {

				$secretary->add_changes("Nome:", $_POST['name']);
				$secretary->add_changes("Sobrenome:", $_POST['last_name']);
				$secretary->add_changes("Email:", $_POST['email']);
				$secretary->add_changes("Telefone:", $_POST['tel']);
				$secretary->commit_changes("paciente");

				$secretary->show_all_patients();
			}
		}
		if (isset($_POST['appt_date'])) {

			$secretary->add_changes("Nome:", $_POST['name']);
			$secretary->add_changes("Sobrenome:", $_POST['last_name']);
			$secretary->add_changes("Nome-do-Medico:", $_POST['doctor_name']);
			$secretary->add_changes("CRM:", $_POST['crm']);
			$secretary->add_changes("Data:", $_POST['appt_date']);
			$secretary->commit_changes("historico");

			$secretary->show_all_history();
		}
		if (!empty($_GET)) {
			// start a Xpath query on the history XML using data from _GET global as data filter
			
			$secretary->search_history();
		}
		if (isset($_POST['login_user'])) {

			$hd = Storage::getInstance();
			$permission = $hd->login("medico", $_POST['login_user'], $_POST['login_psw']);
		}

		//testing doctors anotate using storage modify
		if (isset($_POST['recipe'])) {

			$hd = Storage::getInstance();

			$input_array = array(
				"Observacao:" => $_POST['obs'],
				"Receita:" => $_POST['recipe'],
			);

			$hd->modify("historico", $_POST['name'], $input_array);
		}
		
	?>

</body>
</html>