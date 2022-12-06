<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateManagerLogin.php');
include_once ('../Entity/food.php');

// Declare functions
function deleteFood($id)
{
    // Create object of food class
    $food = new Food();
    $status = $food->delete($id);

    if ($status == true)
        echo message('Deleted', false);
}

function deleteImage($id)
{
    // Create object of food class
    $food = new Food();
    $foodItem = $food->fetchById($id)[0];

    $filePath = '../images/food/' . $foodItem->image;
    unlink($filePath);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        deleteImage($id);
        deleteFood($id);
    }
}