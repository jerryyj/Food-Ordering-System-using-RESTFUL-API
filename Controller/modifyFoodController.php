<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateManagerLogin.php');
include_once ('../Entity/food.php');

// Declare functions
function getFood($id)
{
    // Create object of food class
    $food = new Food();
    $data = $food->fetchById($id);

    echo json_encode($data);
}

function updateItem($id, $name, $price, $description, $image, $status)
{
    // Create object of food class
    $food = new Food();
    $status = $food->update($id, $name, $price, $description, $image, $status);

    if ($status === true)
    {
        echo message("managerhome.php", false);
    }else
    {
        echo message("Item $name failed to update", true);
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'GET')
{
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        getFood($id);
    }
}

if ($request == 'POST')
{
    // Validate inputted data
    $name = validate($_POST['name']);
    $price= validate($_POST['price']);
    $description = validate($_POST['description']);
    $status = $_POST['status'];
    $id = $_POST['id'];
    $currentImage = $_POST['currentImg'];

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
        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']))
        {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $allowedfileExtensions = array('jpg', 'jpeg', 'png');

            // Validate file
            if (in_array($fileExtension, $allowedfileExtensions))
            {
                // Upload file to directory
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $destPath = '../images/food/' . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath))
                {
                    // Delete old file
                    $oldFilePath = '../images/food/' . $currentImage;
                    if (unlink($oldFilePath))
                        updateItem($id, $name, $price, $description, $newFileName, $status);
                }
                else
                    echo message("File upload failed", true);

            }else
                echo message("Unaccepted image file format", true);
        }
        else
        {
            updateItem($id, $name, $price, $description, $currentImage, $status);
        }
    }
}