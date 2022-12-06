<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if (isset($_SESSION["userrole"]) && $_SESSION["userrole"] === "admin"){
        header("location: ../Boundary/Admin/adminhome.php");
        exit;
    }
    else if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] === "owner"){
    header("location: ../Boundary/Owner/ownerhome.php");
    exit;
    }
    else if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] === "staff"){
    header("location: ../Boundary/Staff/staffhome.php");
    exit;
    }
    else if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] === "manager"){
    header("location: ../Boundary/Manager/managerhome.php");
    exit;
    }
}
?>