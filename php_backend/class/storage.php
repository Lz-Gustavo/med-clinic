<?php
	/*	med-clinic										*/
	/*												*/
	/*	"storage.php" contains the implementation of the Storage class, which provides		*/
	/*	read/writes primitives to the data storing methods from other classes. Basically	*/
	/*	acts like a API set that manipulates information over the XML files, that represent	*/
	/*	the persistent storage for the system data.						*/
	/* 												*/
	/*	developed by: Luiz G. Xavier and Albano Borba			June/2018		*/

	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);

	class Storage {
		private static $instance = NULL;
		private $file_doctors;
		private $file_patients;
		private $file_history;

		private function __construct() {

		}
		public static function getInstance() {
			if (self::$instance == NULL) {
				self::$instance = new Storage();
			}
			return self::$instance;
		}

		public function write($conection, $table, $input_array) {
			// PDO, String, Array -> -
			//
			// writes a NEW NODE on the specified database table using the given 'input_array' values

			$sql = "INSERT INTO ".$table." VALUES ....";
			
		}
		public function read($conection, $table, $filter) {
			// String, String -> Array
			//
			// structures a SQL query with received data and returns the result in array format

			
		}
		public function show_all($connection, $table) {
			// PDO -> Array
			//
			// returns all the content on the specified table within the database

			$sql = "SELECT * FROM ".$table;
			$result = $conection->query($sql);
			$rows = $result->fetchAll();

			print_r($rows);
			return $rows;
		}
		public function modify($conection, $table, $key_cell, $modify_array) {
			// PDO, Number, Array -> -
			//
			// used to modify data on patients and doctors or to add information on an appointment registry 

		}
		public function login($connection, $table, $role, $user, $password) {
			// PDO, String, String, Number -> Number (Boolean Repr.)
			//
			// authenticates login for doctors and patients, verifying matching credentials of 'Name/CRM' for
			// doctors and 'admin/admin' for administrators

		}
		public function check_avaiable($conection, $table, $crm, $day, $time) {
			// PDO, Number, String, String(bitmap) -> Number
			//
			// implements searching for the specified doctor,
			// -- if it exists: 
			//	check if he s avaiable and makes the appointment returning 1, otherwise returns 0
			// -- if it doesnt exists:
			//	returns an error code that is captured by the invoker class, aborting the operation

			
		}
		public function translate_time($bitmap) {
			// String(bitmap) -> Number
			//
			// translates a given bitmap into a hour in 12h format
			$base_hour = 8;

			$vector_bitmap = explode(" ", $bitmap);
			for ($i = 0; $i < count($vector_bitmap); $i++) {
				
				if ($vector_bitmap[$i] == 1) {
					$hour = $base_hour + $i;
					if ($hour > 12) {
						$hour = $hour - 12;

						// concatenates PM
						$hour .= ":00PM";
					}
					else {
						// concatenates AM
						$hour .= ":00AM";
					}
					break;
				}
			}
			return $hour;
		}
	}
?>