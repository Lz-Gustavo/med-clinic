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
			// escrita na persistencia XML criando novos campos para as info especificadas,
			// nao modificando


			if (strcasecmp($database, "medico") == 0) {
				$xml = simplexml_load_file($this->file_doctors);				
				
				$med = $xml->addChild("med");
				$med->addChild("name", $input_array["Nome:"]);
				$med->addChild("last_name", $input_array["Sobrenome:"]);
				$med->addChild("spec", $input_array["Especializacao:"]);
				$med->addChild("crm", $input_array["CRM:"]);
				$med->addChild("email", $input_array["Email:"]);
				$med->addChild("tel", $input_array["Telefone:"]);
				$med->addChild("addr", $input_array["Endereco:"]);

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
				$pct->addChild("bday", $input_array["Data:"]);
				$pct->addChild("blood", $input_array["Sangue:"]);
				$pct->addChild("cpf", $input_array["CPF:"]);
				$pct->addChild("email", $input_array["Email:"]);
				$pct->addChild("tel", $input_array["Telefone:"]);
				
				$xml->asXML($this->file_patients);
			}
			else {
				$xml = simplexml_load_file($this->file_history);				
				$hist = $xml->addChild("consulta");

				$hist->addChild("name", $input_array["Nome:"]);
				$hist->addChild("last_name", $input_array["Sobrenome:"]);
				$hist->addChild("cpf", $input_array["CPF:"]);
				$hist->addChild("doctor_name", $input_array["Nome-do-Medico:"]);
				$hist->addChild("crm", $input_array["CRM:"]);
				$hist->addChild("appt_date", $input_array["Data:"]);
				$hist->addChild("time", $input_array["Horario:"]);
				$hist->addChild("obs", "empty");
				$hist->addChild("recipe", "empty");

				$xml->asXML($this->file_history);
			}
		}
		public function read($database, $filter) {
			// leitura dos arquivos XML utilizando um filtro previamente estruturado
			// pela classe invocadora
			
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
			//echo "<u>Dados extraidos de ".$database.":</u> <br><br>";
			//echo $extract->asXML();
			//print_r($extract);
			return $extract;
		}
		public function modify($database, $key_cell, $modify_array) {
			// utilizado para alterar campos no cadastro de um medico, paciente, ou acrescentar dados a uma consulta

			if (strcasecmp($database, "medico") == 0) {

				$filter = "//med[number(crm)='".$key_cell."']";
				$xml = simplexml_load_file($this->file_doctors);
				$result = $xml->xpath($filter);

				$result[0]->name = $modify_array["Nome:"];
				$result[0]->last_name = $modify_array["Sobrenome:"];
				$result[0]->spec = $modify_array["Especializacao:"];
				$result[0]->crm = $modify_array["CRM:"];
				$result[0]->email = $modify_array["Email:"];
				$result[0]->tel = $modify_array["Telefone:"];
				$result[0]->addr = $modify_array["Endereco:"];
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

			$filter = "//med[number(crm)='".$crm."']";
			$xml = simplexml_load_file($this->file_doctors);
			$result = $xml->xpath($filter);

			if (isset($result)) {
				$flag = 0;

				$doctor_hour = $result[0]->week->$day;
				$vector_doctor = explode(" ", $doctor_hour);
				$vector_marked = explode(" ", $time);

				for ($i = 0; $i < count($vector_marked); $i++) {
					if (($vector_marked[$i] == 1) && ($vector_doctor[$i] == 0)) {
						$flag = 1;
						$vector_doctor[$i] = 1;
						break;
					}
				}
				if ($flag == 0) {
					return 0;
				}
			}
			else {
				// means that theres no doctor with that crm on the database
				return 404;
			}
			return 1;
		}
	}
?>