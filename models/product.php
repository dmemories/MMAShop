<?php

    class Product extends Model {

        public static $table = "product";

        public function getProduct($id = 0) {
            return $this->get("product_id, product_name", null, null, ["product_id", "DESC"]);
            //return (($id > 0) ? $this->get("SELECT * FROM `product`;") : $this->db->selectAll("SELECT * FROM `product`;"));
        }

    }

?>