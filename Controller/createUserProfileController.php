<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateAdminLogin.php');
include_once ('../Entity/userprofile.php');

// Declare functions
function createUserProfile($name, $status)
{
    // Create object of user profile class
    $userP = new UserProfile();
    $status = $userP->insert($name, $status);

    if ($status === false)
    {
        echo message("User profile $name already exists. Please use a different name", true);
    }else
    {
        echo message("User profile $name successfully created", false);
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'POST')
{
    // Validate inputted data
    $name = validate($_POST['name']);
    $status = $_POST['status'];

    if (empty($name))
    {
        echo message("Name required", true);
    } else
    {
        createUserProfile($name, $status);
    }
}
?>