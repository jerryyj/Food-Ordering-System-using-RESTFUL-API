<?php 
include('../../config/constants.php');
include('../../config/validateAdminLogin.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - User Profiles</title>
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

        <h1 class="overview">Overview of User Profiles</h1>
        <p id="message" class="message" hidden="true"></p>
        <div class="container">
        <div class="search">
            <label>Search by name:</label>
            <input id="search" type="text">
        </div>
            <table id="userstable" class="up">
                <thead class="collapsible">
                    <tr>
                        <th class="sortableUP" onclick="sortTable(0)">Name</th>
                        <th class="sortableUP" onclick="sortTable(1)">Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="content">

                </tbody>
            </table>
        </div>

        <script>
            function toHTMLRows(htmlStr, userObj)
            {
                htmlStr += '<tr><td>' + userObj.name + 
                                        '</td><td id="status' + userObj.id + '">' + userObj.status + 
                                        '</td><td><a class="btn-table" href="modifyuserprofile.php?id=' + userObj.id + '">Modify</a>' +
                                        '</td><td><a class="btn-table" onClick="changeStatus(' + userObj.id + ')">Change Status</a>' +
                                        '</td></tr>';

                return htmlStr;
            }

            $(document).ready(function() {
                $.ajax({
                    type: 'get',
                    url: '../../Controller/viewUserProfileController.php',
                    success: function (response) {
                        
                        $.each(response, function(i, item) {
                            var trHTML = '';
                           trHTML = toHTMLRows(trHTML, item);
                           $('#content').append(trHTML);
                        });
                    },
                });
            });

            $('#search').keyup(function() {
                var url = '../../Controller/searchUserProfileController.php';
                var name = $('#search').val();
                url = url + '?name=' + name;
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (response) {
                        $('#content').empty();
                        $.each(response, function(i, item) {
                            var trHTML = '';
                           trHTML = toHTMLRows(trHTML, item);
                           $('#content').append(trHTML);
                        });
                    },
                });
            });

            function changeStatus(id) {
                var url = '../../Controller/changeUserProfileStatusController.php' + '?id=' + id;

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (response) {
                        $('#status' + id).html(response.message);
                    },
                });

            }

            function sortTable(n) {
                var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                table = document.getElementById("userstable");
                switching = true;
                dir = "asc";
                
                while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                        }
                    }
                    }
                    if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount ++;
                    } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                    }
                }
                }
        </script>
    </body>
</html>