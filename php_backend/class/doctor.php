<?php
	/*	med-clinic										*/
	/*												*/
	/*	"doctor.php" is the code implementation of the doctor entity of the clinic. Just	*/
	/* 	like the secretary it has admin. privileges on the database, being able to modify	*/
	/*	certain fields in the history of appointments XML file, changing its registry info.	*/
	/*	and searching for specific patient's or its own future appointments.			*/
	/*												*/
	/*	developed by: Luiz G. Xavier and Albano Borba			June/2018		*/

	require_once "person.php";
	require_once "storage.php";

	class Doctor extends Person {
		private $crm;
		private $temporary_buffer = array();

		public function _construct() {
			parent::_construct();
			$this->crm = 0;
		}
		public function __construct($n, $ln, $id) {
			parent::__construct($n, $ln, "medico");
			$this->crm = $id;
		}
		public function __destruct() {

		}

		public function add_changes($cell, $value) {
			// Number(key), Number -> -
			//
			// stores the given 'key/value' into the mapped temporary buffer to latter store all the required
			// registry information at once on the XML file

			array_push($this->temporary_buffer, $cell);
			$this->temporary_buffer[$cell] = $value;
		}
		public function commit_changes() {
			// String -> -
			//
			// call Storage::Modify() passing CRM as key to modify his own profile

			$hd = Storage::getInstance();

			$hd->modify("medico", $this->temporary_buffer["CRM:"], $this->temporary_buffer);
			reset($this->temporary_buffer);
		}
		public function search_history() {
			// $_GET[] -> Array
			//
			// structures a Xpath filter using the content on the global $_GET array, similar to secretary's method 
			// but only searching for its own appointments and filtering for 'all/future' ones as requested

			$hd = Storage::getInstance();

			$filter = "//consulta[";

			if (!empty($_GET['doctor_name'])) {
				$filter.= "doctor_name='".$_GET['doctor_name']."'";
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
			if (isset($_GET['name'])) {
				$filter = rtrim($filter, "]");
				$filter.= " and name='".$_GET['name']."']";
			}
			
			$result = $hd->read("historico", $filter);
			return $result;
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
			$filter.= "]";
			
			$result = $hd->read("paciente", $filter);
			return $result;
		}
		public function search_profile() {
			// $_GET[] -> Array
			//
			// structures a Xpath filter using the content on the global $_GET array and returns the resulted array
			// from Storage::Read() procedure

			$hd = Storage::getInstance();

			$filter = "//med[";

			if (!empty($_GET['name'])) {
				$filter.= "name='".$_GET['name']."'";
			}
			if (!empty($_GET['crm'])) {
				$filter.= " and number(crm)='".$_GET['crm']."'";
			}
			if (!empty($_GET['email'])) {
				$filter.= " and email='".$_GET['email']."'";
			}
			if (!empty($_GET['tel'])) {
				$filter.= " and number(tel)='".$_GET['tel']."'";
			}
			$filter.= "]";
			
			$result = $hd->read("medico", $filter);
			return $result;
		}
		public function show_all_patients() {
			$hd = Storage::getInstance();

			$result = $hd->show_all("paciente");
			return $result;
		}
		public function anotate($name, $observation, $recipe) {
			// String, String, String -> -
			// 
			// calls Storage::Modify() structuring an array using the given 'observation' and 'recipe' info and 
			// passing the patients name as key

			$hd = Storage::getInstance();

			$input_array = array(
				"Observacao:" => $observation,
				"Receita:" => $recipe,
			);

			$hd->modify("historico", $name, $input_array);
		}
	}
?>