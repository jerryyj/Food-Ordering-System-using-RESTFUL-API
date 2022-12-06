<?php 
include('../../config/constants.php');
include('../../config/validateAdminLogin.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Modify User Profile</title>
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

        <h1 class= "overview">Modify User Profile</h1>
        <form id="createuserform" class="userform" name="form">
            <p id="message" hidden=true></p>
            <label>Name:</label><br>
            <input id="name" class="fill" type="text" name="name" placeholder="Name" required /><br>
            <label>Status:</label><br>
            <div class="select">
            <select id="status" name="status">
                <option value="Active">Active</option>
                <option value="Suspended">Suspended</option>
            </select>
            </div>

            <button class="createbtn" type="submit" form="createuserform" value="submit">Modify User Profile</button>
        </form>
        <script>
            var id = '<?php echo $_GET['id']; ?>';

            $(document).ready(function() {
                $.ajax({
                    type: 'get',
                    url: '../../Controller/modifyUserProfileController.php?id=' + id,
                    success: function (response) {
                        var userProfile = response[0];
                        $('#name').val(userProfile.name);
                        $('#status').val(userProfile.status);
                    },
                });
            });

            $('#createuserform').on('submit', function (e) {
            e.preventDefault();
            
                $.ajax({
                    type: 'post',
                    url: '../../Controller/modifyUserProfileController.php?id=' + id,
                    data: $('#createuserform').serialize(),
                    success: function (response) {
                        if (response.error == true) {
                            $('#message').html(response.message);
                            $('#message').addClass("error").removeClass("success");
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