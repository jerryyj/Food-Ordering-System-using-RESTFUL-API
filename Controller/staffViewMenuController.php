<?php 
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateStaffLogin.php');
include_once ('../Entity/food.php');

// Declare functions
function getFoodItems()
{
    // Create object of food class
    $food = new Food();
    $data = $food->fetchByStatus('In Menu');

    echo json_encode($data);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    getFoodItems();
}
?>