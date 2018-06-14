<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	class Storage {
		private static $instance = NULL;
		private $file_doctors;
		private $file_patients;
		private $file_history;

		public function __construct() {

			$this->file_doctors = "../../storage_xml/doctor_reg.xml";
			$this->file_patients = "../../storage_xml/patient_reg.xml";
			$this->file_history = "../../storage_xml/history.xml";
		}

		public static function getInstance() {
			if (self::$instance == NULL) {
				self::$instance = new Storage();
			}
			return self::$instance;
		}

		public function write($database, $input_array) {
			
			if (strcasecmp($database, "medico") == 0) {
				$xml = simplexml_load_file($this->file_doctors);				
				$med = $xml->addChild("med");

				$med->addChild("name", $input_array["Nome:"]);
				$med->addChild("last_name", $input_array["Sobrenome:"]);
				
				$xml->asXML($this->file_doctors);
			}
			else if (strcasecmp($database, "paciente") == 0) {
				$xml = simplexml_load_file($this->file_patients);				
				$pct = $xml->addChild("pct");

				$pct->addChild("name", $input_array["Nome:"]);
				$pct->addChild("last_name", $input_array["Sobrenome:"]);
				
				$xml->asXML($this->file_patients);
			}
			else {
				$xml = simplexml_load_file($this->file_history);				
				$hist = $xml->addChild("consulta");

				$hist->addChild("name", $input_array["Nome:"]);
				$hist->addChild("last_name", $input_array["Sobrenome:"]);
				$hist->addChild("doctor_name", $input_array["Nome-do-Medico:"]);
				$hist->addChild("appt_date", $input_array["Data:"]);

				$xml->asXML($this->file_history);
			}

		}
		public function show($database, $value) {
			// leitura seletiva nao pq fazer agora, com o formato xml vai ser melhor ja q vai buscar especificamente na row
			echo "DEBUG: tem nada pra mostrar!<br>";
		}
		public function show_all($database) {

			if (strcasecmp($database, "medico") == 0) {

				$extract = simplexml_load_file($this->file_doctors);
			}
			else if (strcasecmp($database, "paciente") == 0) {
				
				$extract = simplexml_load_file($this->file_patients);
			}
			else {
				
				$extract = simplexml_load_file($this->file_history);
			}
			echo "<u>Dados extraidos de ".$database.":</u> <br><br>";
			//echo $extract->asXML();
			print_r($extract);
			echo "<br>";
		}
	}

?>