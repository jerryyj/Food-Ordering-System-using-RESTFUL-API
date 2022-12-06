<?php 
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateStaffLogin.php');
include_once ('../Entity/orderdetails.php');

// Declare functions
function setItemCompleted($id)
{
    // Create object of orderdetail class
    $order = new OrderDetail();
    $status = $order->completeOrderItem($id);

    if ($status == true)
        echo message('Completed', false);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $orderDetailId = $_GET['id'];
    
    if ($orderDetailId)
        setItemCompleted($orderDetailId);
}
?>