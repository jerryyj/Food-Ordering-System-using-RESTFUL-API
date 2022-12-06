<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateAdminLogin.php');
include_once ('../Entity/userprofile.php');

// Declare functions
function changeUserProfileStatus($id)
{
    // Create object of user profile class
    $userP = new UserProfile();
    $userPArray = $userP->fetchById($id);
    $userProfile = $userPArray[0];
    
    if ($userProfile->status === "Active")
    {
        $status = $userProfile->suspend($id);

        if ($status === true)
            echo message('Suspended', false);
    }
    else
    {
        $status = $userProfile->activate($id);

        if ($status === true)
            echo message('Active', false);
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $id = $_GET['id'];

    if ($id)
        changeUserProfileStatus($id);
}
?>