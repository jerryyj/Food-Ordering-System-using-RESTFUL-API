<?php 
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateManagerLogin.php');
include_once ('../Entity/food.php');

// Declare functions
function searchFood($name)
{
    // Create object of food class
    $food = new Food();
    $data = $food->fetchByName($name);

    echo json_encode($data);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $name = validate($_GET['name']);

    searchFood($name);
}