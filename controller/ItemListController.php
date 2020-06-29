<?php
    class ItemListController{
        private $conn;
        private $table_1="`Itemlist`";
        private $table_2="`local-item-list`";

        public function __construct($db){
            $this->conn = $db;
        }
        public function index(){}

        public function create(){}

        public function update(){}

        public function delete(){}

        // get merchant itemIDS by using merchantId
        public function getMerchantItemsFromItemListTable($merchantId){
            //select all data
            $query = "SELECT ItemID FROM ".$this->table_1 ." WHERE MerchantID LIKE '%$merchantId%'";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        // get merchant codes by using merchantId
        public function getMerchantItemsFromLocalItemListTable($merchantId){
            //select all data
            $query = "SELECT code FROM ".$this->table_2 ." WHERE merchant_id LIKE '%$merchantId%'";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }