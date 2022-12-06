<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateStaffLogin.php');
include_once ('../Entity/orders.php');

// Declare functions
function makePayment($email, $tableNo, $itemsArray)
{
    // Create object of Order class
    $order = new Order();
    $status = $order->insert($email, $tableNo, $itemsArray);

    if ($status === false)
        echo message("Payment failed, something went wrong", true);
    else
        echo message("Your order has been successfully made", false);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'POST')
{
    $cardName = validate($_POST['cardname']);
    $expMonth = validate($_POST['expmonth']);
    $expYear = validate($_POST['expyear']);
    $cvv = validate($_POST['cvv']);
    $tableNo = validate($_POST['tableno']);
    $email = validate($_POST['email']);
    $itemsArray = json_decode($_POST['items'], true);

    $year = intval(substr(date("Y"), 0, 2) . $expYear);
    $month = intval($expMonth);
    
    // Name on card check
    if (empty($cardName))
        echo message("Name on card required", true);
    else if (intval($expMonth) > 12 || intval($expMonth) < 1)
        echo message("Invalid expiry month", true);
    else if ($year < date("Y") || ($year == date("Y") && $month < date("m")))
        echo message("Card has expired", true);
    else if (strlen($cvv) < 3)
        echo message("Invalid CVV", true);
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        echo message("Invalid email", true);
    else if (empty($itemsArray))
        echo message("Payment failed, order is empty", true);
    else
        makePayment($email, $tableNo, $itemsArray);
}
?>