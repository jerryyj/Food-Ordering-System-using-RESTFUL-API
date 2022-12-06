<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateAdminLogin.php');
include_once ('../Entity/userprofile.php');

// Declare functions
function getUserProfile($id)
{
    // Create object of user profile class
    $userP = new UserProfile();
    $userProfiles = $userP->fetchById($id);
    echo json_encode($userProfiles);
}

function updateUserProfile($id, $name, $status)
{
    // Create object of user profile class
    $userP = new UserProfile();
    $status = $userP->update($id, $name, $status);

    if($status === false)
    {
        echo message("User profile $name already exists. Please use a different name", true);
    }else
    {
        echo message("userprofiles.php", false);
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        getUserProfile($id);
    }
}

if ($request == 'POST')
{
    // Validate inputted data
    $name = validate($_POST['name']);
    $status = $_POST['status'];
    $id = $_GET['id'];

    if (empty($name))
    {
        echo message("Name required", true);
    } 
    else
    {
        updateUserProfile($id, $name, $status);
    }
}