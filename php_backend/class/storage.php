<?php

	class Storage {
		private static $instance;
		private $file_doctors;
		private $file_patients;
		private $file_history;

		private function __constructor() {
			$this->file_doctors = fopen("../storage_xml/doctor_reg.txt", "rw");
			$this->file_patients = fopen("../storage_xml/patient_reg.txt", "rw");
			$this->file_history = fopen("../storage_xml/history.txt", "rw");
		}

		public function getInstance() {
			if ($this->instance == null) {
				$this->instance = new Storage();
			}
			return $this->instance;
		}

		public function write($database, $input_array) {
			$input_text = implode(" ", $input_array);
			
			if (strncasecmp($database, "medico") == 0) {
				fwrite($file_doctors, $input_text);				
			}
			else if (strncasecmp($database, "paciente") == 0) {
				fwrite($file_patients, $input_text);
			}
			else {
				fwrite($file_history, $input_text);
			}

		}
		public function show($database, $value) {
			// leitura seletiva nao pq fazer agora, com o formato xml vai ser melhor ja q vai buscar especificamente na row
		}
		public function show_all($database) {
			
			if (strncasecmp($database, "medico") == 0) {

				$extract = fread($file_doctors, filesize("../storage_xml/doctor_reg.txt"));
			}
			else if (strncasecmp($database, "paciente") == 0) {
				
				$extract = fread($file_patients, filesize("../storage_xml/patient_reg.txt"));
			}
			else {
				
				$extract = fread($file_history, filesize("../storage_xml/history.txt"));
			}
			echo "<u>Dados extraidos de ".$database.":</u> <br><br>";
			echo $extract;
			echo "<br>";
		}
	}

?>