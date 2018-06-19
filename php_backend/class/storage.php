<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	class Storage {
		private static $instance = NULL;
		private $file_doctors;
		private $file_patients;
		private $file_history;

		private function __construct() {
			//for some reason i cant use ../filename anymore, REALLY STRANGE

			//$this->file_doctors = "../storage_xml/doctor_reg.xml";
			$this->file_doctors = "/var/www/html/med-clinic/storage_xml/doctor_reg.xml";
			$this->file_patients = "/var/www/html/med-clinic/storage_xml/patient_reg.xml";
			$this->file_history = "/var/www/html/med-clinic/storage_xml/history.xml";
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
				$med->addChild("email", $input_array["Email:"]);
				$med->addChild("tel", $input_array["Telefone:"]);
				$med->addChild("crm", $input_array["CRM:"]);
				
				$xml->asXML($this->file_doctors);
			}
			else if (strcasecmp($database, "paciente") == 0) {
				$xml = simplexml_load_file($this->file_patients);				
				$pct = $xml->addChild("pct");

				$pct->addChild("name", $input_array["Nome:"]);
				$pct->addChild("last_name", $input_array["Sobrenome:"]);
				$pct->addChild("email", $input_array["Email:"]);
				$pct->addChild("tel", $input_array["Telefone:"]);
				
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
		public function read($database, $filter) {
			
			echo "<br><b>filtro utilizado:</b> ".$filter."<br>";

			if (strcasecmp($database, "medico") == 0) {
				$xml = simplexml_load_file($this->file_doctors);				
				$result = $xml->xpath($filter);
				echo "RESULTADO BUSCA MEDICO: <br>";
				//print_r($result);
				return $result;
			}
			else if (strcasecmp($database, "paciente") == 0) {
				$xml = simplexml_load_file($this->file_patients);				
				$result = $xml->xpath($filter);
				echo "RESULTADO BUSCA PACIENTE: <br>";
				//print_r($result);
				return $result;
			}
			else {
				$xml = simplexml_load_file($this->file_history);				
				$result = $xml->xpath($filter);
				return $result;
			}
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