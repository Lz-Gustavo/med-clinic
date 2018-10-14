<?php
	/*	med-clinic	v2.0 																	*/
	/*																						*/
	/*	"storage.php" contains the implementation of the Storage class, which provides		*/
	/*	read/writes primitives to the data storing methods from other classes. Basically	*/
	/*	acts like a API set that manipulates information over a MySQL DB, that represent	*/
	/*	the persistent storage for the system data.											*/
	/* 																						*/
	/*	developed by: Luiz G. Xavier and Albano Borba			Sept/2018					*/

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	class Storage {
		private static $instance = NULL;
		private $db_connectiton;

		private function __construct() {

		}
		public static function getInstance() {
			if (self::$instance == NULL) {
				self::$instance = new Storage();
			}
			return self::$instance;
		}

		public function connect($schema) {
			// String -> Int (Boolean rep.)
			// ...
			// establishes a connection on the given schema on the mysql database hosted locally

			$user = "administrator";
			$pw = "ronaldinho10";
			$host = "localhost";

			try {		
				$this->db_connection = new PDO("mysql:host=".$host.";dbname=".$schema.";charset=utf8", $user, $pw);
				$this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				//echo "foi<br>";
			}
			catch (PDOException $e) {
				echo "Exception: ".$e->getMessage()."<br>";
			}
		}

		public function disconnect() {
			// deletes PDO connection with the database

			$this->db_connection = NULL;
		}

		public function write($array_data) {
			// Array -> Int (Boolean rep.)
			// ...
			// structures a SQL instruction to insert values from array map into  the specified
			// using an universal db access key

			try {
				$index = array_keys($array_data);

				$sql = "INSERT INTO ".$array_data["TABLE:"]."(";
				for ($i = 1; $i < count($array_data); $i++) {

					//$sql .= rtrim(strtolower(implode("", [$index[$i]])), ":").", ";
					$sql .= rtrim($index[$i], ":").", ";
				}
				$sql = rtrim($sql, ", ");
				$sql .= ") VALUES (";

				//echo "<br>INDEX: ".count($index);
				for ($i = 1; $i < count($index); $i++) {
					
					$sql .= "'".$array_data[$index[$i]]."', ";
				}
				$sql = rtrim($sql, ", ");
				$sql .= ");";
				
				echo "<br><b>SQL query:</b> ".$sql."<br><br>";

				$this->db_connection->exec($sql);
				
				return 1;
			}
			catch (Exception $e) {
				echo "Exception: ".$e->getMessage()."<br>";
				return 0;
			}
		}

		public function read($array_fields) {
			// Array -> String
			// ...
			// receives a list of specific fields to be extracted from the db, with the table
			// name on first pos, and returns an entire string with the query result

			try {
				//echo "teste<br>";
				//print_r($array_fields);
				//echo "<br>";
				//echo count($array_fields);

				$index = array_keys($array_fields);

				$sql = "SELECT * FROM GeracaoSaude.".$array_fields["TABLE:"];

				for ($i = 1; $i < count($array_fields); $i++) {

					if ($i == 1)
						$sql .= " WHERE ";

					$sql .= rtrim($index[$i], ":")."='".$array_fields[$index[$i]]."' AND ";
				}
				$sql = rtrim($sql, " AND ");
				$sql .= ";";

				//echo "<br><b>SQL query:</b> ".$sql."<br><br>";

				$result = $this->db_connection->query($sql);
				$rows = $result->fetchAll();

				//print_r($rows);
				return $rows;
			}
			catch (Exception $e) {
				echo "Exception: ".$e->getMessage()."<br>";
			}
		}
		public function read_all($table_name) {
			// String -> String
			// ...
			// select all results from a given table name

			try {
				$sql = "SELECT * FROM GeracaoSaude.".$table_name.";";

				//echo "<br><b>SQL query:</b> ".$sql."<br><br>";

				$result = $this->db_connection->query($sql);
				$rows = $result->fetchAll();
			
				//print_r($rows);
				return $rows;
			}
			catch (Exception $e) {
				echo "Exception: ".$e->getMessage()."<br>";
			}
		}
		
		public function modify_week($modify_array) {
			// PDO, Number, Array -> -
			//
			// used to modify doctors week schedule
			
			try {

				$seg = str_replace(' ', '', $modify_array['seg']);
				$ter = str_replace(' ', '', $modify_array['ter']);
				$qua = str_replace(' ', '', $modify_array['qua']);
				$qui = str_replace(' ', '', $modify_array['qui']);
				$sex = str_replace(' ', '', $modify_array['sex']);

				$sql = "UPDATE GeracaoSaude.func_clinica SET seg='".$seg."', ter='".$ter."', qua='".$qua."', qui='".$qui."', sex='".$sex."'"; 
				$sql .= " WHERE crm='".$_SESSION['login_crm']."' AND clinica='".$_SESSION['clinic']."';";

				$this->db_connection->exec($sql);

				return;
			}
			catch (Exception $e) {
				echo "Exception: ".$e->getMessage()."<br>";
			}

		}

		public function login($role, $user, $password) {
			// String, String, String -> Number (Boolean Repr.)
			//
			// authenticates login for doctors and patients, verifying matching credentials of 'Name/PW' for
			// doctors and patientes, or 'admin/admin' for administrators

			try {
				//session_start();

				if ($role == "atendente") {

					if ($password == "admin")
						return 1;
					
					return 0;
				}
				else if ($role == "paciente")
					$sql = "select * from GeracaoSaude.credentials where cpf=(select cpf from GeracaoSaude.pacientes where nome like '".$user."');";
				
				else if ($role == "medico")
					$sql = "select * from GeracaoSaude.credentials where crm=(select crm from GeracaoSaude.medicos where nome like '".$user."');";
			
				$result = $this->db_connection->query($sql);
				$rows = $result->fetchAll();

				if (count($rows) == 0) {
					
					//user not found
					return 0;
				}

				$pw = hash("md5", $password);

				for ($i = 0; $i < count($rows); ++$i) {

					if ($rows[$i]['pw'] == $pw) {
						
						if ($role == "medico")
							$_SESSION['login_crm'] = $rows[$i]['crm'];
						
						else if ($role == "paciente")
							$_SESSION['login_cpf'] = $rows[$i]['cpf'];

						//all good
						return 1;
					}
				}

				//incorrect password
				return 0;
			}
			catch (Exception $e) {
				echo "Exception: ".$e->getMessage()."<br>";
			}
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
					if ($hour >= 12) {

						//lunch time
						$hour++;
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

		public function appointment($table_info) {
			// create a new row on "consultas" table and update doctor schedule on "func_clinica"

			try {
				
				//$table_info["TABLE:"] = "consultas";
				$this->write($table_info);

				$week = array("dom", "seg", "ter", "qua", "qui", "sex", "sab");
				$dayofweek = date('w', strtotime($table_info["dia:"]));

				$filter = array(
					"TABLE:" => "func_clinica",
					"CRM:" => $table_info["crm:"],
					"CLINICA:" => $table_info['clinica:']
				);
				$result = $this->read($filter);

				$time = str_split($result[0][$week[$dayofweek]]);
				$marked = explode(" ", $table_info["horario:"]);

				for ($i = 0; $i < count($time); $i++) {
					
					if ($marked[$i] == "1") {
						$time[$i] = "1"; 
					}
				}

				$horario = implode("", $time);

				$sql = "UPDATE GeracaoSaude.func_clinica SET ".$week[$dayofweek]."='".$horario."' WHERE crm='".$table_info["crm:"]."' AND clinica='".$table_info['clinica:']."';";

				echo "<br><b>SQL query:</b> ".$sql."<br><br>";

				$this->db_connection->exec($sql);
				
				return 1;
			}
			catch (Exception $e) {
				echo "Exception: ".$e->getMessage()."<br>";
				return 0;
			}
		}

		public function SQLinsert($sql) {

			try {
				$this->db_connection->exec($sql);
			}
			catch (Exception $e) {
				echo "Exception: ".$e->getMessage()."<br>";
			}
		}

		public function SQLretrieve($sql) {
			
			try {
				$result = $this->db_connection->query($sql);
				$rows = $result->fetchAll();
			}
			catch (Exception $e) {
				echo "Exception: ".$e->getMessage()."<br>";
			}

			return $rows;
		}
	}
?>