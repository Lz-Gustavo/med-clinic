<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	class Storage {
		private static $instance = NULL;
		private $file_doctors;
		private $file_patients;
		private $file_history;

		public function __constructor() {
			// idk why i cant use them this way

			//$this->file_doctors = fopen("../../storage_xml/doctor_reg.txt", "r+");
			//$this->file_patients = fopen("../../storage_xml/patient_reg.txt", "r+");
			//$this->file_history = fopen("../../storage_xml/history.txt", "r+");
		}

		public static function getInstance() {
			if (self::$instance == NULL) {
				self::$instance = new Storage();
			}
			return self::$instance;
		}

		public function write($database, $input_array) {

			$this->file_doctors = fopen("../../storage_xml/doctor_reg.txt", "a+");
			$this->file_patients = fopen("../../storage_xml/patient_reg.txt", "a+");
			$this->file_history = fopen("../../storage_xml/history.txt", "a+");
			
			$input_text = implode(" ", $input_array)."\n";
			
			if (strcasecmp($database, "medico") == 0) {
				fwrite($this->file_doctors, $input_text);				
			}
			else if (strcasecmp($database, "paciente") == 0) {
				fwrite($this->file_patients, $input_text);
			}
			else {
				fwrite($this->file_history, $input_text);
			}

			fclose($this->file_doctors);
			fclose($this->file_patients);
			fclose($this->file_history);

		}
		public function show($database, $value) {
			// leitura seletiva nao pq fazer agora, com o formato xml vai ser melhor ja q vai buscar especificamente na row
			echo "DEBUG: tem nada pra mostrar!<br>";
		}
		public function show_all($database) {

			$this->file_doctors = fopen("../../storage_xml/doctor_reg.txt", "r+");
			$this->file_patients = fopen("../../storage_xml/patient_reg.txt", "r+");
			$this->file_history = fopen("../../storage_xml/history.txt", "r+");

			if (strcasecmp($database, "medico") == 0) {

				$extract = fread($this->file_doctors, filesize("../../storage_xml/doctor_reg.txt"));
			}
			else if (strcasecmp($database, "paciente") == 0) {
				
				$extract = fread($this->file_patients, filesize("../../storage_xml/patient_reg.txt"));
			}
			else {
				
				$extract = fread($this->file_history, filesize("../../storage_xml/history.txt"));
			}
			echo "<u>Dados extraidos de ".$database.":</u> <br><br>";
			echo $extract;
			echo "<br>";

			fclose($this->file_doctors);
			fclose($this->file_patients);
			fclose($this->file_history);

		}
	}

?>