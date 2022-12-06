<?php
if (!(isset ($_SESSION['loggedin'])) || !(isset($_SESSION['userrole'])) || ($_SESSION['userrole'] != "owner")) {
    header('location:'.SITEURL.'Boundary/login.php');
    exit;
}
?>