<?php 
include('../../config/constants.php');
include('../../config/validateAdminLogin.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Modify Existing User</title>
        <link rel="stylesheet" href="../../css/admin.css">
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <div class="menu text-center">
        <div class="wrapper">
                <ul>
                    <li><a class="option" href="adminhome.php">View User Accounts</a></li>
                    <li><a class="option" href="createuser.php">Create User</a></li>
                    <li><a class="option" href="userprofiles.php">View User Profiles</a></li>
                    <li><a class="option" href="createuserprofile.php">Create User Profile</a></li>
                    <li><a class="logout" href="../../Controller/adminLogoutController.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <h1 class= "overview">Modify User</h1>
        <form id="modifyuserform" class="userform" name="form">
            <p id="message" hidden=true></p>
            <label>Name:</label><br>
            <input id="name" class="fill" type="text" name="name" placeholder="Name" required /><br>
            <label>Username:</label><br>
            <input id="username" class="fill" type="text" name="username" placeholder="Username" required /><br>
            <label>Password:</label><br>
            <input id="password" class="fill" type="text" name="password" placeholder="Password" required /><br>
            <label>Role:</label><br>
            <div class="select">
            <select id="userrole" name="userrole">
                
            </select>
            </div>
            <label>Status:</label><br>
            <div class="select">
            <select id="status" name="status">
                <option value="Active">Active</option>
                <option value="Suspended">Suspended</option>
            </select>
            </div>

            <button class="createbtn" type="submit" form="modifyuserform" value="submit">Update User</button>
        </form>
        <script>
            function toHTMLOptions(htmlStr, UPObj)
            {
                htmlStr += '<option value="' + UPObj.id + '">' + UPObj.name + '</option>';

                return htmlStr;
            }

            var id = '<?php echo $_GET['id']; ?>';

            $(document).ready(function() {
                $.ajax({
                    type: 'get',
                    url: '../../Controller/modifyUserController.php?id=' + id,
                    success: function (response) {
                        var user = response[0][0];
                        $('#name').val(user.name);
                        $('#username').val(user.username);
                        $('#password').val(user.password);
                        $('#status').val(user.status);

                        var userProfileList = response[1];
                        var trHTML = '';
                            $.each(userProfileList, function(i, item) {
                                trHTML = toHTMLOptions(trHTML, item);
                            });
                            $('#userrole').html(trHTML);

                        $('#userrole').val(user.userroleId);
                    },
                });
            });

            $('#modifyuserform').on('submit', function (e) {
            e.preventDefault();
            
                $.ajax({
                    type: 'post',
                    url: '../../Controller/modifyUserController.php?id=' + id,
                    data: $('#modifyuserform').serialize(),
                    success: function (response) {
                        if (response.error == true) {
                            $('#message').html(response.message);
                            $('#message').addClass("error");
                            $('#message').attr("hidden",false);
                        } else {
                            window.location.replace(response.message);
                        }
                    },
                });
            });
        </script>
    </body>
</html>