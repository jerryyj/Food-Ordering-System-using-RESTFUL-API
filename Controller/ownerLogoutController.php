<?php
include('../config/constants.php');

// Logout function
function ownerLogout(){
    session_unset();
    session_destroy();

    header("Location: ../Boundary/login.php");
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    ownerLogout();
}