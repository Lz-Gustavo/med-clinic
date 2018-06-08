<?php

	class Person {
		private $name;
		private $last_name;
		private $funcao;

		public function _constructor() {
			$this->name = null;
			$this->last_name = null;
			$this->funcao = null;
		}
		public function __constructor($n, $ln, $fnc) {
			$this->name = $n;
			$this->last_name = $ln;
			$this->funcao = $fnc;
		}
		public function __destructor() {
			$this->name = null;
			$this->last_name = null;
			$this->funcao = null;
		}

		public function setName($n) {
			$this->name = $n;
		}
		public function getName() {
			return $this->name;
		}

		public function show() {
			echo "<u>Nome:</u> ".$this->name."<br>";
			echo "<u>Sobrenome:</u> ".$this->last_name."<br>";
			echo "<u>Funcao:</u> ".$this->funcao."<br>";
		}

	}

?>