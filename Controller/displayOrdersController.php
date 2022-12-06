<?php 
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateStaffLogin.php');
include_once ('../Entity/orders.php');
include_once ('../Entity/orderdetails.php');

// Declare functions
function getOrders()
{
    // Create object of order class
    $order = new Order();
    $ordersArray = $order->fetchByStatus('Pending');

    // Create object of orderdetails class
    $orderDetails = new OrderDetail();
    foreach ($ordersArray as $orderItem)
    {
        $orderItem->orderDetailsList = $orderDetails->fetchByOrderId($orderItem->orderId);
    }

    echo json_encode($ordersArray);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    getOrders();
}
?>