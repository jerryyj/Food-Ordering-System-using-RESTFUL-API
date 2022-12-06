<?php
// Include CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include_once ('../Entity/user.php');

// Declare functions
function validateAdminLogin($username, $password, $userrole)
{
    // Create object of user class
    $user = new User();
    $valid = $user->validateLogin($username, $password, $userrole);

    if ($valid === 'valid')
    {
        // Store session details
        $_SESSION['loggedin'] = true;
        $_SESSION['userrole'] = "admin";

        // Return no errors and url to redirect
        echo message('Admin/adminhome.php', false);
    }else if ($valid === 'failed')
    {
        echo message("Username or Password incorrect", true);
    }else
    {
        echo message("User account has been suspended", true);
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'POST')
{
    // Validate inputted data
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $userrole = $_POST['userrole'];

    if (empty($username))
    {
        echo message("Username required", true);
    } else if (empty($password))
    {
        echo message("Password required", true);
    } else
    {
        validateAdminLogin($username, $password, $userrole);
    }
}
?>