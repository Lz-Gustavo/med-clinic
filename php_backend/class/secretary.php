<?php
	/*	med-clinic										*/
	/*												*/
	/*	"secretary.php" is the code implementation of the Secretary class that represents	*/
	/* 	the secretary entity of the clinic. It can operate as a full permission administrator	*/
	/*	of the clinic's database, registering/searching new doctors, patients and future	*/
	/*	appointments on the system.								*/
	/*												*/
	/*	developed by: Luiz G. Xavier and Albano Borba			June/2018		*/

	require_once "person.php";
	require_once "storage.php";

	class Secretary extends Person {
		private $reg;
		private $temporary_buffer = array();

		public function __construct($n, $ln, $id) {
			parent::__construct($n, $ln, "atendente");
			$this->reg = $id;
		}
		public function __destruct() {

		}

		public function add_changes($cell, $value) {
			array_push($this->temporary_buffer, $cell);
			$this->temporary_buffer[$cell] = $value;
		}
		public function commit_changes($database) {
			$hd = Storage::getInstance();

			if (strcasecmp($database, "medico") == 0) {
				
				$hd->write($database, $this->temporary_buffer);
				reset($this->temporary_buffer);
				echo "changes commited to the doctors database!<br>";
			}
			else if (strcasecmp($database, "paciente") == 0) {
				
				$hd->write($database, $this->temporary_buffer);
				reset($this->temporary_buffer);
				echo "changes commited to the patients database!<br>";
			}
			else if ((strcasecmp($database, "historico") == 0) || (strcasecmp($database, "history") == 0)) {
				
				$permission = $hd->check_avaiable($this->temporary_buffer["CRM:"], "dia", "13:30");
				if ($permission == 1) {

					$hd->write($database, $this->temporary_buffer);
					echo "changes commited to the history database!<br>";
				}
				else {
					echo "Dr.".$this->temporary_buffer["Nome-do-Medico:"]." is busy in that hour!<br>";
				}
				reset($this->temporary_buffer);
			}
		}

		public function search_patient($name) {
			$hd = Storage::getInstance();

			$filter = "//pct[";

			if (!empty($_GET['name'])) {
				$filter.= "name='".$_GET['name']."'";
			}
			if (!empty($_GET['email'])) {
				$filter.= " and email='".$_GET['email']."'";
			}
			if (!empty($_GET['tel'])) {
				$filter.= " and number(tel)='".$_GET['tel']."'";
			}
			$filter.= "]";
			
			$result = $hd->read("paciente", $filter);
			echo "RESULTADO BUSCA PACIENTE: <br>";
			print_r($result);
		}
		public function search_doctor($crm) {
			$hd = Storage::getInstance();

			$filter = "//med[";

			// name == doctors name
			if (!empty($_GET['name'])) {
				$filter.= "name='".$_GET['name']."'";
			}
			if (!empty($_GET['crm'])) {
				$filter.= " and number(crm)='".$_GET['crm']."'";
			}
			if (!empty($_GET['email'])) {
				$filter.= " and email='".$_GET['email']."'";
			}
			if (!empty($_GET['tel'])) {
				$filter.= " and number(tel)='".$_GET['tel']."'";
			}
			$filter.= "]";
			
			$result = $hd->read("medico", $filter);
			echo "RESULTADO BUSCA MEDICO: <br>";
			print_r($result);
		}
		public function search_history() {
			$hd = Storage::getInstance();

			$filter = "//consulta[";

			if (!empty($_GET['name'])) {
				$filter.= "name='".$_GET['name']."'";
			}

			if (!empty($_GET['doctor_name'])) {
				$filter.= " and doctor_name='".$_GET['doctor_name']."'";
			}
			$filter.= "]";

			if (strcasecmp($_GET['time'], "future") == 0) {
				
				$now = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
				$time_filter = " and number(translate(appt_date,'-','')) > ".$now->format("Ymd")."]";
				//echo "FILTRO TEMPO: ".$time_filter."<br>";

				$filter = rtrim($filter, "]");
				$filter.= $time_filter;
			}
			
			$result = $hd->read("historico", $filter);
			echo "RESULTADO BUSCA HISTORICO: <br>";
			print_r($result);
		}

		public function show_all_patients() {
			$hd = Storage::getInstance();

			$hd->show_all("paciente");
		}
		public function show_all_doctors() {
			$hd = Storage::getInstance();

			$hd->show_all("medico");
		}
		public function show_all_history() {
			$hd = Storage::getInstance();

			$hd->show_all("historico");
		}
	}

?>