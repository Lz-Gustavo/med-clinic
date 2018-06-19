<?php
	require_once "person.php";
	require_once "storage.php";

	class Secretary extends Person {
		private $reg;
		private $temporary_buffer = array();

		public function __construct($n, $ln, $id) {
			parent::__construct($n, $ln, "atendente");
			$this->reg = $id;
		}
		public function __destructor() {

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
			else {
				
				$hd->write($database, $this->temporary_buffer);
				reset($this->temporary_buffer);
				echo "changes commited to the history database!<br>";
			}
		}

		public function search_patient($name) {

		}
		public function search_doctor($crm) {

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