<?php
class OrderController{
    private $conn;
    private $table_name = "Orders";
    public function __construct($db){
        $this->conn = $db;
    }
    public function index(){}

    public function create(){}

    public function update(){}

    public function delete(){}
    // used to get all rows with a given itemID
    function getOrderByItemId($itemId)
    {
        //select all data
        $query = "SELECT * FROM " . $this->table_name . " WHERE ItemID = '$itemId' AND status='PAID'AND requested_state='PENDING' AND confirmationId!='N/A' ORDER BY created_at";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function updateRequestedOrder($orderId)
    {

        //select all data
        $query = "UPDATE ". $this->table_name . " SET requested_state='PROCESSED' WHERE id='$orderId'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}