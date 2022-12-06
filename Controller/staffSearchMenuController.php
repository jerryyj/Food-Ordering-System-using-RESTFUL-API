<?php 
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateStaffLogin.php');
include_once ('../Entity/food.php');

// Declare functions
function searchMenu($name)
{
    // Create object of food class
    $food = new Food();
    $data = $food->fetchByName($name);

    foreach ($data as $key => $foodItem)
    {
        if ($foodItem->status === "Not In Menu")
            unset($data[$key]);
    }

    echo json_encode($data);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $name = validate($_GET['name']);

    searchMenu($name);
}


