<?php
	require_once "./person.php";
	require_once "./storage.php";

	class Doctor extends Person {
		private $crm;
		private $temporary_buffer;

		public function _constructor() {
			parent::_constructor();
			$this->crm = 0;
		}
		public function __constructor($n, $ln, $id) {
			parent::__constructor($n, $ln, "medico");
			$this->crm = $id;
		}
		public function _destructor() {

		}

		public function add_changes($cell, $value) {
			// call procedure from storage->write to each cell of xml from the array_map
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
		public function commit_changes() {
			// agora a ideia seria pasar todo conteudo do array pra storage->write
			$hd = Storage::getInstance();

			$hd->write("medico", $this->temporary_buffer);
			echo "changes commited to the database!<br>";
			reset($this->temporary_buffer);
		}
		public function check_schedule() {
			$hd = Storage::getInstance();

			$hd->show_all();
		}
		public function anotate($name, $observation, $recipe) {

			$input_array = array(
				"Observacao" => $observation,
				"Receitas" => $recipe,
			);

			// storage->write($name, $input_array);
		}
		public function search_patient($name) {
			// storage->show($name) em history.xml;
		}
	}

?>