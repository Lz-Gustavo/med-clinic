<?php
	require_once "./person.php";
	require_once "./storage.php";

	class Secretary extends Person {
		private $reg;
		private $temporary_buffer;

		public function _constructor() {
			parent::_constructor();
			$this->reg = 0;
		}
		public function __constructor($n, $ln, $id) {
			parent::__constructor($n, $ln, "atendente");
			$this->reg = $id;
		}
		public function _destructor() {

		}

		public function add_changes($cell, $value) {
			if (count($temporary_buffer) == 0) {
				$this->temporary_buffer = array(
					$cell => $value,
				);
			}
			else {
				array_push($this->temporary_buffer, $cell);
				$this->temporary_buffer[$cell] = $value;
			}
		}
		public function commit_changes($database) {
			if (strncasecmp($database, "medico") == 0) {

				echo "changes commited to the doctors database!<br>";
				//storage_write($buffer) em doctor_reg.xml 
				reset($this->temporary_buffer);
			}
			else if (strncasecmp($database, "paciente") == 0) {

				echo "changes commited to the patients database!<br>";
				//storage_write(buffer) em patient_reg.xml
				reset($this->temporary_buffer);
			}
			else {

				echo "changes commited to the history database!<br>";
				//storage_write(buffer) em history.xml
				reset($this->temporary_buffer);
			}

		}
		public function check_schedule() {
			// storage->show_all from history.xml
		}
		public function search_patient($name) {
			// storage->show("paciente", $name) em history.xml;
		}
		public function search_doctor($crm) {
			// storage->show("medico", $crm) em history.xml;
		}

	}

?>