<?php

    class ShopModel extends Model {

        public function getProduct($id = 0) {
            return (($id > 0) ? $this->db->selectOne("SELECT * FROM `product`;") : $this->db->selectAll("SELECT * FROM `product`;"));
        }

        public function getProductType() {
            return $this->db->selectAll("SELECT * FROM `product_type`;");
        }

    }

?>