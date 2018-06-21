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
		private $temporary_buffer;

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
			array_push($this->temporary_buffer, $cell);
			$this->temporary_buffer[$cell] = $value;
		}
		public function commit_changes() {
			$hd = Storage::getInstance();

			$hd->write("medico", $this->temporary_buffer);
			echo "changes commited to the database!<br>";
			reset($this->temporary_buffer);
		}
		public function search_history() {
			// same operation as the secretary's history search, but it can only track appointments using his own doctor_name

			$hd = Storage::getInstance();

			$filter = "//consulta[";

			if (!empty($_GET['doctor_name'])) {
				$filter.= "doctor_name='".$_GET['doctor_name']."'";
			}

			if (!empty($_GET['name'])) {
				$filter.= " and name='".$_GET['name']."'";
			}
			$filter.= "]";

			if (strcasecmp($_GET['time'], "future") == 0) {
				
				$now = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
				$time_filter = " and number(translate(appt_date,'-','')) > ".$now->format("Ymd")."]";

				$filter = rtrim($filter, "]");
				$filter.= $time_filter;
			}
			
			$result = $hd->read("historico", $filter);
			echo "RESULTADO BUSCA HISTORICO: <br>";
			print_r($result);
		}
		public function anotate($name, $observation, $recipe) {
			$hd = Storage::getInstance();

			$input_array = array(
				"Observacao:" => $observation,
				"Receita:" => $recipe,
			);

			$hd->modify("historico", $name, $input_array);
		}
	}
?>