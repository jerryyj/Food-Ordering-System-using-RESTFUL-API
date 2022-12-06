<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateAdminLogin.php');
include_once ('../Entity/user.php');
include_once ('../Entity/userprofile.php');

// Declare functions
function searchUserProfile($name)
{
    // Create object of user profile class
    $userP = new UserProfile();
    $data = $userP->fetchByName($name);
    
    echo json_encode($data);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $name = validate($_GET['name']);

    searchUserProfile($name);
}