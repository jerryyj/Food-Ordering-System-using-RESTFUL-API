<?php
if (!(isset ($_SESSION['loggedin'])) || !(isset($_SESSION['userrole'])) || ($_SESSION['userrole'] != "admin")) {
    header('location:'.SITEURL.'Boundary/login.php');
    exit;
}
?>