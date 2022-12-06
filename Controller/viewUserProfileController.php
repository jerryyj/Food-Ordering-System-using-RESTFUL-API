<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateAdminLogin.php');
include_once ('../Entity/userprofile.php');

// Declare functions
function getAllUserProfiles()
{
    // Create object of user class
    $userP = new UserProfile();
    $data = $userP->fetchById();

    echo json_encode($data);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    getAllUserProfiles();
}
?>