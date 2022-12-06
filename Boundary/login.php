<?php 
include('../config/constants.php'); 
include('../config/validateLoggedIn.php');

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/login.css">
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <form id="loginform">
            <h2>USER LOGIN</h2>
            <p id="error" class="error" hidden="true"></p>
            
            <label>Username</label>
            <input type="text" name="username" placeholder = "Username">

            <label>Password</label>
            <input type="password" name="password" placeholder = "Password">

            <label>Login As:</label>
            <select id="userrole" name="userrole">
                <option value="1">User Administrator</option>
                <option value="2">Restaurant Staff</option>
                <option value="3">Restaurant Manager</option>
                <option value="4">Restaurant Owner</option>
            </select>

            <button type="submit" form="loginform" value="submit">Login</button>
        </form>

        <script>
            function toHTMLOptions(htmlStr, UPObj)
            {
                htmlStr += '<option value="' + UPObj.id + '">' + UPObj.name + '</option>';

                return htmlStr;
            }

            $('#loginform').on('submit', function (e) {
            e.preventDefault();
            
            var role = $('#userrole').val();
            var url;
            if (role == '2')
                url = '../Controller/staffLoginController.php';
            else if (role == '3')
                url = '../Controller/managerLoginController.php';
            else if (role == '4')
                url = '../Controller/ownerLoginController.php';
            else
                url = '../Controller/adminLoginController.php';
            
                $.ajax({
                    type: 'post',
                    url: url,
                    data: $('#loginform').serialize(),
                    success: function (response) {
                        if (response.error == true) {
                            $('#error').html(response.message);
                            $("#error").attr("hidden",false);
                            $('#loginform')[0].reset();
                        } else {
                            window.location.replace(response.message);
                        }
                    },
                });
            });
        </script>
    </body>
</html>


