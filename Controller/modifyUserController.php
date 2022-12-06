<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateAdminLogin.php');
include_once ('../Entity/user.php');
include_once ('../Entity/userprofile.php');

// Declare functions
function getUser($id)
{
    $response = array();

    // Create object of user class
    $user = new User();
    $data = $user->fetchById($id);
    array_push($response, $data);

    // Create object of user profile class
    $userP = new UserProfile();
    $userProfiles = $userP->fetchById();
    array_push($response, $userProfiles);

    echo json_encode($response);
}

function updateUser($id, $name, $username, $password, $userroleId, $status)
{
    // Create object of user class
    $user = new User();
    $status = $user->update($id, $name, $username, $password, $userroleId, $status);

    if($status === false)
    {
        echo message("Username $username already exists. Please use a different username", true);
    }else
    {
        echo message("adminhome.php", false);
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        getUser($id);
    }
}

if ($request == 'POST')
{
    // Validate inputted data
    $name = validate($_POST['name']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $userrole = $_POST['userrole'];
    $status = $_POST['status'];
    $id = $_GET['id'];

    if (empty($name))
    {
        echo message("Name required", true);
    } 
    else if (empty($username))
    {
        echo message("Username required", true);
    }
    else if (preg_match('/\s/',$username))
    {
        echo message("Username must not contain spaces", true);
    } 
    else if (empty($password))
    {
        echo message("Password required", true);
    } else
    {
        updateUser($id, $name, $username, $password, $userrole, $status);
    }
}