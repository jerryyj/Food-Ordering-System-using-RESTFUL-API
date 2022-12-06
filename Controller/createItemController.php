<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateManagerLogin.php');
include_once ('../Entity/food.php');

// Declare functions
function createItem($name, $price, $description, $image, $status)
{
    // Create object of food class
    $food = new Food();
    $status = $food->insert($name, $price, $description, $image, $status);

    if ($status === true)
    {
        echo message("New item $name successfully created", false);
    }else
    {
        echo message("New item $name creation failed", true);
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'POST')
{
    // Validate inputted data
    $name = validate($_POST['name']);
    $price= validate($_POST['price']);
    $description = validate($_POST['description']);
    $status = $_POST['status'];

    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $allowedfileExtensions = array('jpg', 'jpeg', 'png');
    
    if (empty($name))
    {
        echo message("Name required", true);
    } 
    else if (empty($price))
    {
        echo message("Price required", true);
    }
    else if (!is_numeric($price))
    {
        echo message("Please enter a valid price", true);
    } 
    else if (empty($description))
    {
        echo message("Description required", true);
    } 
    else
    {
        // Validate file
        if (in_array($fileExtension, $allowedfileExtensions))
        {
            // Upload file to directory
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = '../images/food/' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath))
            {
                createItem($name, $price, $description, $newFileName, $status);
            }
            else
                echo message("File upload failed", true);

        }else
            echo message("Unaccepted image file format", true);
    }
}
?>