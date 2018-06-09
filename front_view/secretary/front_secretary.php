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
		function validate() {
			var i;
			var x = new Array();
			for (i = 0; i < 3; i++){
				x[i] = document.forms[0][i].value;
				if (x[i] == "") {
					alert("Todos os campos devem estar preenchidos");
					return false;
				}
			}
			alert("Dados enviados com sucesso!");
			return true;
		}
	</script>

	<a href = "../index.php"><b> <--- Voltar</b></a><br><br>

	<h3>Registrar Cadastro:</h3><br>
	<form onsubmit = "return validate()" method = "get">
		<br>
		<span>Nome: </span><input type = "text" name = "name"><br><br>
		
		<span>Sobrenome: </span><input type = "text" name = "last_name"><br><br>

		<span>Funcao: </span><input type = "text" name = "role"><br><br>
		
		<br><br>
		<button type = "submit">Submeter!</button>
	</form>

	<?php
		require_once "../../php_backend/class/storage.php";
		require_once "../../php_backend/class/person.php";
		require_once "../../php_backend/class/secretary.php";
		require_once "../../php_backend/class/doctor.php";
		require_once "../../php_backend/class/patient.php";

		$hd = Storage::getInstance();
		$hd->show();

		$secretary = new Secretary("Maria", "da Rosa", "Atendente");

		if (isset($_GET['role'])) {

			$role = $_GET['role'];
			if (strcasecmp($role, "medico") == 0) {

					echo "eae meu consagrado doutor!<br>";
					$secretary->add_changes("Nome", $_GET['name']);
					$secretary->add_changes("Sobrenome", $_GET['last_name']);
					$secretary->commit_changes("medico");
			}

		}
	?>

</body>
</html>