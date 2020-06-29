<?php

include_once 'database.php';
include_once 'order.php';
include_once 'controller/OrderController.php';
include_once 'controller/ItemListController.php';
// create a database connection
$database = new Database();
$connection = $database->getConnection();
$orders = array();
// parse request
$orderController = new OrderController($connection);
$itemListController = new ItemListController($connection);
if(isset($_GET["merchantId"])){
    $merchantId = $_GET["merchantId"];
    // GET merchant items from ItemList table
    $itemIds = $GLOBALS['itemListController']->getMerchantItemsFromItemListTable($merchantId);
    $itemIdsArray =array();
    while($row = $itemIds->fetch(PDO::FETCH_ASSOC)){
        array_push($itemIdsArray, $row['ItemID']);
    }
    // GET merchant other possible items from local-item-list table
    $codes = $GLOBALS['itemListController']->getMerchantItemsFromLocalItemListTable($merchantId);


    while($row = $codes->fetch(PDO::FETCH_ASSOC)){
        array_push($itemIdsArray, $row['code']);
    }
//    echo json_encode($itemIdsArray);
    foreach ($itemIdsArray as $item) {
        getNewOrders($item);
    }

    foreach ($orders as $order) {
        updateRequestedOrders($order->id);
    }

    echo json_encode($orders);

}



function getNewOrders($itemId){

    $stmnt = $GLOBALS['orderController']->getOrderByItemId($itemId);

    while($row = $stmnt->fetch(PDO::FETCH_ASSOC)){
        $order = new Order();
        $order->id = $row['id'];
        $order->itemId = $row['ItemID'];
        $order->confirmationId = $row['confirmationID'];
        $order->customerPhone = $row['customer_phone'];
        $order->payment = $row['payment'];
        $order->status = $row['status'];
        $order->createAt = $row['created_at'];
        $order->updatedAt = $row['updated_at'];
        array_push($GLOBALS['orders'], $order);
    }


}

function updateRequestedOrders($id){
    $stmnt = $GLOBALS['orderController']->updateRequestedOrder($id);
}



?>
