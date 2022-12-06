<?php 
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateStaffLogin.php');
include_once ('../Entity/orders.php');

// Declare functions
function setOrderCancelled($id)
{
    // Create object of orderdetail class
    $order = new Order();
    $status = $order->cancelOrder($id);

    if ($status == true)
        echo message('Cancelled', false);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $orderId = $_GET['id'];
    
    if ($orderId)
        setOrderCancelled($orderId);
}
?>