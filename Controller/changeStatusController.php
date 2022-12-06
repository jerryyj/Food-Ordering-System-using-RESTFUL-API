<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateAdminLogin.php');
include_once ('../Entity/user.php');
include_once ('../Entity/userprofile.php');

// Declare functions
function changeUserStatus($id)
{
    // Create object of user class
    $user = new User();
    $usersArray = $user->fetchById($id);
    $user = $usersArray[0];

    // Create object of user profile class
    $userP = new UserProfile();

    // Get user profile of user
    $userProfile = $userP->fetchById($user->userroleId)[0];
    if ($userProfile->status === "Suspended")
    {
        $upName = $userProfile->name;
        echo message("The user profile $upName has been suspended", false);
    }
    else
    {
        if ($user->status === "Active")
        {
            $status = $user->suspend($id);

            if ($status === true)
                echo message('Suspended', false);
        }
        else
        {
            $status = $user->activate($id);

            if ($status === true)
                echo message('Active', false);
        }
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    $id = $_GET['id'];

    if ($id)
        changeUserStatus($id);
}
?>