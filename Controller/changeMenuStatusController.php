<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateManagerLogin.php');
include_once ('../Entity/food.php');

// Declare functions
function changeMenuStatus($id)
{
    // Create object of food class
    $food = new Food();
    $foodArray = $food->fetchById($id);
    $food = $foodArray[0];
    
    if ($food->status === "In Menu")
    {
        $status = $food->removeFromMenu($id);

        if ($status === true)
            echo message('Not In Menu', false);
    }
    else
    {
        $status = $food->addToMenu($id);

        if ($status === true)
            echo message('In Menu', false);
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $id = $_GET['id'];

    if ($id)
        changeMenuStatus($id);
}
?>