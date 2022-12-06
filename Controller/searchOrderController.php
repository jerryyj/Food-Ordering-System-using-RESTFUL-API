<?php 
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateStaffLogin.php');
include_once ('../Entity/orders.php');
include_once ('../Entity/orderdetails.php');

// Declare functions
function searchOrder($id, $type)
{
    // Create object of order class
    $order = new Order();
    $ordersArray = array();
    
    // Check searchtype
    if ($type == "orderno")
    {
        $ordersArray = $order->fetchByOrderId($id, 'Pending');
    }
    else if ($type == "tableno")
    {
        $ordersArray = $order->fetchByTableNo($id, 'Pending');
    }

    if ($ordersArray)
    {
        $orderDetails = new OrderDetail();
        foreach ($ordersArray as $orderItem)
        {
            $orderItem->orderDetailsList = $orderDetails->fetchByOrderId($orderItem->orderId);
        }
    }

    echo json_encode($ordersArray);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $type = $_GET['type'];
    $id = validate($_GET['id']);
    
    searchOrder($id, $type);
}
?>