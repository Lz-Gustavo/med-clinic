<?php
	/*	med-clinic	v2.0									*/
	/*												*/
	/*	"secretary.php" is the code implementation of the Secretary class that represents	*/
	/* 	the secretary entity of the clinic. It can operate as a full permission administrator	*/
	/*	of the clinic's database, registering/searching new doctors, patients and future	*/
	/*	appointments on the system.								*/
	/*												*/
	/*	developed by: Luiz G. Xavier and Albano Borba			Sept/2018		*/

	require_once "person.php";
	require_once "storage.php";

	class Secretary extends Person {
		private $db_connection;
		private $temporary_buffer = array();

		public function __construct($user, $pw) {

			parent::__construct($user, "atendente");
			try {
				
				$this->db_connection = new PDO("mysql:host=localhost;dbname=GeracaoSaude", $user, $pw);
				$this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				echo "foi<br>";
			}
			catch (PDOException $e) {
				echo "Exception: ".$e->getMessage();
			}
		}
		public function __destruct() {
			$this->db_connection = null;
		}

		public function add_changes($cell, $value) {
			// Number(key), Number -> -
			//
			// stores the given 'key/value' into the mapped temporary buffer to latter store all the required
			// registry information at once on the XML file

			array_push($this->temporary_buffer, $cell);
			$this->temporary_buffer[$cell] = $value;
		}
		public function commit_changes($database) {
			// String -> Number (Boolean Repr.)
			//
			// call Storage::Write() on the specified database, in the case of making a new appointment, calls
			// Storage::check_avaiable() to verify information

			$hd = Storage::getInstance();

			if ((strcasecmp($database, "historico") == 0) || (strcasecmp($database, "history") == 0)) {

				$day = $this->temporary_buffer["Data:"];
				$aux = explode("-", $day);
				unset($aux[0]);
				unset($aux[1]);
				$day = implode("-", $aux);

				$dayofweek = strtolower(date('l', strtotime($this->temporary_buffer["Data:"])));

				$permission = $hd->check_avaiable($this->temporary_buffer["CRM:"], $dayofweek, $this->temporary_buffer["Horario:"]);
				//$permission = 1;
				if ($permission == 1) {

					$hd->write($database, $this->temporary_buffer);
					return 1;
				}
				else if ($permission == 0) {
					
					echo "<script type='text/javascript'>alert('Doctor is busy in that hour');</script>";
					return 0;
				}
				else {
					echo "<script type='text/javascript'>alert('Insert a valid CRM');</script>";
					return 404;
				}
				reset($this->temporary_buffer);
			}
			else {
				$hd->write($database, $this->temporary_buffer);
				reset($this->temporary_buffer);
			}
		}

		public function search_patient() {
			// $_GET[] -> Array
			//
			// structures a Xpath filter using the content on the global $_GET array and returns the resulted array
			// from Storage::Read() procedure

			$hd = Storage::getInstance();

			$filter = "//pct";

			if (!empty($_GET['name'])) {
				$filter.= "[name='".$_GET['name']."'";
			}
			if (!empty($_GET['cpf'])) {
				$filter.= " and number(cpf)='".$_GET['cpf']."'";
			}
			$filter.= "]";
			
			$result = $hd->read("paciente", $filter);
			return $result;
		}
		public function search_doctor() {
			// $_GET[] -> Array
			//
			// structures a Xpath filter using the content on the global $_GET array and returns the resulted array
			// from Storage::Read() procedure

			$hd = Storage::getInstance();

			$filter = "//med";

			// 'name' is the doctors name, trust me
			if (!empty($_GET['name'])) {
				$filter.= "[name='".$_GET['name']."'";
			}
			if (!empty($_GET['crm'])) {
				$filter.= " and number(crm)='".$_GET['crm']."'";
			}
			if (!empty($_GET['email'])) {
				$filter.= " and email='".$_GET['email']."'";
			}
			$filter.= "]";
			
			$result = $hd->read("medico", $filter);
			return $result;
		}
		public function search_history() {
			// $_GET[] -> Array
			//
			// structures a Xpath filter using the content on the global $_GET array and returns the resulted array
			// from Storage::Read() procedure

			$hd = Storage::getInstance();

			$filter = "//consulta";

			if (!empty($_GET['name'])) {
				$filter.= "[name='".$_GET['name']."'";
			}

			if (!empty($_GET['doctor_name'])) {
				$filter.= " and doctor_name='".$_GET['doctor_name']."'";
			}
			$filter.= "]";

			if (isset($_GET['time'])) {

				if (strcasecmp($_GET['time'], "future") == 0) {
					
					$now = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
					$time_filter = " and number(translate(appt_date,'-','')) > ".$now->format("Ymd")."]";
					$filter = rtrim($filter, "]");
					$filter.= $time_filter;
				}
			}
			$result = $hd->read("historico", $filter);
			return $result;
		}

		public function show_all_patients() {
			$hd = Storage::getInstance();

			$result = $hd->show_all($this->db_connection, "pacientes");
			return $result;
		}
		public function show_all_doctors() {
			$hd = Storage::getInstance();

			$result = $hd->show_all($this->db_connection, "medicos");
			return $result;
		}
		public function show_all_history() {
			$hd = Storage::getInstance();

			$result = $hd->show_all($this->db_connection, "consultas");
			return $result;
		}
	}

?>