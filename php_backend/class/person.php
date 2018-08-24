<?php

	class Person {
		protected $name;
		protected $funcao;

		public function _construct() {
			$this->name = null;
			$this->funcao = null;
		}
		public function __construct($n, $fnc) {
			$this->name = $n;
			$this->funcao = $fnc;
		}
		public function __destructor() {
			$this->name = null;
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