<?php
	class Model {
		private $serverName = 'localhost';
		private $user = 'root';
		private $pass = '';
		private $dbName = 'qlnhahang';

		public function __construct() {
            header("Access-Control-Allow-Origin: *");
		}

		public function connect() {
			$conn = mysqli_connect($this->serverName, $this->user, $this->pass, $this->dbName);
			mysqli_set_charset($conn, 'utf8');
			date_default_timezone_set('Asia/Ho_Chi_Minh');

			if(!$conn) die('Kết nối đến Server thất bại');
			return $conn;
		}

		public function runQuery($sql) {
			$array = array();

            $query = mysqli_query($this->connect(), $sql);

            if(mysqli_num_rows($query)>0){
                while($row = mysqli_fetch_assoc($query)){
                    $array[] = $row;
                }
            }

			return $array;
		}

		public function runSingleQuery($sql) {
			$array = array();

			$query = mysqli_query($this->connect(), $sql);

            if(mysqli_num_rows($query)>0){
				while($row = mysqli_fetch_assoc($query)){
                    $array[] = $row;
                }
            }

			return $array;
		}

		public function __destruct() {
			mysqli_close($this->connect());
		}
	}
?>