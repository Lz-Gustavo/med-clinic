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

				echo "changes commited to the doctors database!<br>";
				
				$hd->write($database, $this->temporary_buffer);
				reset($this->temporary_buffer);
			}
			else if (strcasecmp($database, "paciente") == 0) {

				echo "changes commited to the patients database!<br>";
				
				$hd->write($database, $this->temporary_buffer);
				reset($this->temporary_buffer);
			}
			else {

				echo "changes commited to the history database!<br>";
				
				$hd->write($database, $this->temporary_buffer);
				reset($this->temporary_buffer);
			}

		}

		public function search_patient($name) {
			// storage->show("paciente", $name) em history.xml;
		}
		public function search_doctor($crm) {
			// storage->show("medico", $crm) em history.xml;
			$hd = Storage::getInstance();

			$hd->read("medico", "Joao");
		}
		public function search_history($filter) {
			$hd = Storage::getInstance();

			$hd->read("historico", $filter);
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