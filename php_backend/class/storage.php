<?php
	/*	med-clinic										*/
	/*												*/
	/*	"storage.php" contains the implementation of the Storage class, which provides		*/
	/*	read/writes primitives to the data storing methods from other classes. Basically	*/
	/*	acts like a API set that manipulates information over the XML files, that represent	*/
	/*	the persistent storage for the system data.						*/
	/* 												*/
	/*	developed by: Luiz G. Xavier and Albano Borba			June/2018		*/

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	class Storage {
		private static $instance = NULL;
		private $file_doctors;
		private $file_patients;
		private $file_history;

		private function __construct() {

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

				$week = $med->addChild("week");
				$week->addChild("monday", "empty");
				$week->addChild("tuesday", "empty");
				$week->addChild("wednesday", "empty");
				$week->addChild("thursday", "empty");
				$week->addChild("friday", "empty");

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
				$hist->addChild("crm", $input_array["CRM:"]);
				$hist->addChild("obs", "empty");
				$hist->addChild("recipe", "empty");

				$xml->asXML($this->file_history);
			}
		}
		public function read($database, $filter) {
			
			//echo "<br><b>filtro utilizado:</b> ".$filter."<br>";

			if (strcasecmp($database, "medico") == 0) {
				$xml = simplexml_load_file($this->file_doctors);				
				$result = $xml->xpath($filter);
				return $result;
			}
			else if (strcasecmp($database, "paciente") == 0) {
				$xml = simplexml_load_file($this->file_patients);				
				$result = $xml->xpath($filter);
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
		public function modify($database, $key_cell, $modify_array) {
			// utilizado para alterar campos no cadastro de um medico, paciente, ou acrescentar dados a uma consulta

			if (strcasecmp($database, "medico") == 0) {

				$filter = "//med[number(crm)='".$key_cell."']";
				$xml = simplexml_load_file($this->file_doctors);
				$result = $xml->xpath($filter);

				$result[0]->name = $modify_array["Nome:"];
				$result[0]->last_name = $modify_array["Sobrenome:"];
				$result[0]->email = $modify_array["Email:"];
				$result[0]->tel = $modify_array["Telefone:"];
				$result[0]->crm = $modify_array["CRM:"];
				//print_r($result);

				$xml->asXML($this->file_doctors);
			}
			else if ((strcasecmp($database, "historico") == 0) || (strcasecmp($database, "history") == 0)) {

				$filter = "//consulta[name='".$key_cell."']";
				$xml = simplexml_load_file($this->file_history);
				$result = $xml->xpath($filter);

				$result[0]->obs = $modify_array["Observacao:"];
				$result[0]->recipe = $modify_array["Receita:"];
				//print_r($result);

				$xml->asXML($this->file_history);
			}
			else if (strcasecmp($database, "paciente") == 0) {

				$filter = "//pct[name='".$key_cell."']";
				$xml = simplexml_load_file($this->file_patients);				
				$result = $xml->xpath($filter);

				$result[0]->name = $modify_array["Nome:"];
				$result[0]->last_name = $modify_array["Sobrenome:"];
				$result[0]->email = $modify_array["Email:"];
				$result[0]->tel = $modify_array["Telefone:"];
				
				//print_r($result);
				$xml->asXML($this->file_patients);
			}
		}
		public function modify_week($crm, $modify_array) {
			// utilizado para alterar o horario vago de um medico

			$filter = "//med[number(crm)='".$crm."']";
			$xml = simplexml_load_file($this->file_doctors);
			$result = $xml->xpath($filter);

			$result[0]->week->monday = $modify_array["Seg:"];
			$result[0]->week->tuesday = $modify_array["Ter:"];
			$result[0]->week->wednesday = $modify_array["Qua:"];
			$result[0]->week->thursday = $modify_array["Qui:"];
			$result[0]->week->friday = $modify_array["Sex:"];
			
			//print_r($result);
			$xml->asXML($this->file_doctors);
		}
		public function login($role, $user, $password) {

			if (strcasecmp($role, "medico") == 0) {
				$filter = "//med[name='".$user."']";
				$xml = simplexml_load_file($this->file_doctors);				
				$result = $xml->xpath($filter);
				
				if ((count($result) > 0) && ($result[0]->crm == $password)) {
					return 1;
				} else {
					return 0;
				}
			}
			else if (strcasecmp($role, "atendente") == 0) {
				if (($user == "admin") && ($password == "admin")) {
					return 1;
				} else {
					return 0;
				}
			}
		}
		public function check_avaiable($crm, $day, $time) {
			// IDEIA INICIAL:
			// implementar aqui a busca pelo horario do medico, para que na hora de agendar uma consulta
			// so se possa marca-la em um horario disponivel pelo doutor em sua agenda

			return 1;
		}
	}
?>