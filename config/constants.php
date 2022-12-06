<?php 
    // Start Session
    session_start();

    // Create Constants to Store Non Repeating Values
    define('SITEURL', 'http://localhost/FoodOrderingSys/');

    // Define user input validation function
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // JSON Format Convertor Function
    function message($content, $status) 
    {
        return json_encode(['message' => $content, 'error' => $status]);
    }
?>