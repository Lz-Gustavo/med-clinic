<!DOCTYPE html>
<html lang = "pt-br">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tabela Consultas</title>
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>

<body>
	<a href = "admin_panel.php"><b> <--- Voltar</b></a><br><br>

	<h2>Buscar Consulta:</h2><br>
	<form method = "get">

		<span>Nome do Paciente: </span><input type = "text" name = "name" required><br><br>
		
		<span>Nome do Medico: </span><input type = "text" name = "doctor_name"><br><br>

		<span>Periodo: </span><br>
		<input type = "radio" name = "time" value = "all" checked> Todas<br>
		<input type = "radio" name = "time" value = "future"> Futuras<br>
		
		<br>
		<button type = "submit">Submeter!</button>
	</form><br>

	<table>
		<br>
		<caption>Consultas Encontradas: </caption>
		<tr>
			<th> Nome do Paciente </th>
			<th> Sobrenome </th>
			<th> Nome do medico </th>
			<th> Data da consulta </th>
			<th> Observacao medica </th>
			<th> Receita </th>
		</tr>

		<?php
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

			require_once "../php_backend/class/storage.php";
			require_once "../php_backend/class/person.php";
			require_once "../php_backend/class/secretary.php";
			require_once "../php_backend/class/doctor.php";
			require_once "../php_backend/class/patient.php";
	
			$secretary = new Secretary("admin", "istrator", "Atendente");
			
			if (!empty($_GET)) {
				$result = $secretary->search_history();

				for ($i = 0; $i < count($result); $i++) {
					
					echo "<tr>";
					echo "<th>".$result[$i]->name."</th>";
					echo "<th>".$result[$i]->last_name."</th>";
					echo "<th>".$result[$i]->doctor_name."</th>";
					echo "<th>".$result[$i]->appt_date."</th>";
					echo "<th>".$result[$i]->obs."</th>";
					echo "<th>".$result[$i]->recipe."</th>";
					echo "</tr>";
				}
			}

		?>
	
	</table>

</body>