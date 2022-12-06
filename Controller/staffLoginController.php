<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include_once ('../Entity/user.php');

// Deckare functions
function validateStaffLogin($username, $password, $userrole)
{
    // Create object of user class
    $user = new User();
    $valid = $user->validateLogin($username, $password, $userrole);

    if ($valid === 'valid')
    {
        // Store session details
        $_SESSION['loggedin'] = true;
        $_SESSION['userrole'] = "staff";

        // Return no errors and url to redirect
        echo message('Staff/staffhome.php', false);
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
        validateStaffLogin($username, $password, $userrole);
    }
}
?>