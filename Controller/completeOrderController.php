<?php 
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include_once ('../Entity/orders.php');

// Declare functions
function setOrderCompleted($id)
{
    // Create object of orderdetail class
    $order = new Order();
    $status = $order->completeOrder($id);

    if ($status == true)
        echo message('Completed', false);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $orderId = $_GET['id'];
    
    if ($orderId)
        setOrderCompleted($orderId);
}
?>