<?php 
	class Product extends Model {
		public function __construct() {
            session_start();
            header("Access-Control-Allow-Origin: *");
		}

        public function getFullProduct($sql) {
            $product = $this->runQuery($sql);
            
            return json_encode($product);
        }

        public function getFullTypeProduct($sql) {
            $typeProduct = $this->runQuery($sql);

            return json_encode($typeProduct);
        }

        public function getTypeProduct($sql) {
            $typeProduct = $this->runSingleQuery($sql);

            return json_encode($typeProduct);
        }
	}
?>