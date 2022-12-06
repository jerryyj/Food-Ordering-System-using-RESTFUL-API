<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateAdminLogin.php');
include_once ('../Entity/user.php');
include_once ('../Entity/userprofile.php');

// Declare functions
function getAllUsers()
{
    // Create object of user class
    $user = new User();
    $data = $user->fetchById();

    // Create object of user profile class
    $userP = new UserProfile();
    foreach ($data as $userRow)
    {
        $userRow->userProfile = $userP->fetchById($userRow->userroleId)[0];
    }

    echo json_encode($data);
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    getAllUsers();
}
?>