<?php 
include('../../config/constants.php');
include('../../config/validateManagerLogin.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manager Home</title>
        <link rel="stylesheet" href="../../css/manager.css">
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a class="option" href="managerhome.php">Home</a></li>
                    <li><a class="option" href="createmenuitem.php">Create Item</a></li>
                    <li><a class="logout" href="../../Controller/managerLogoutController.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <h1 class="overview">Overview of menu Items</h1>
        <p id="message" class="message" hidden="true"></p>
        <div class="container">
        <div class="search">
            <label>Search by name:</label>
            <input id="search" type="text">
        </div>
            <table id="userstable" class="ua">
                <thead class="collapsible">
                    <tr>
                        <th class="sortable" onclick="sortTable(0)">Name</th>
                        <th class="sortable" onclick="sortTable(1)">Price</th>
                        <th class="sortable" onclick="sortTable(2)">Description</th>
                        <th>Image</th>
                        <th class="sortable" onclick="sortTable(4)">Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="content">

                </tbody>
            </table>
        </div>
        <script>
            function toHTMLRows(htmlStr, foodObj)
            {
                htmlStr += '<tr id="foodRow' + foodObj.foodId + '"><td class="name">' + foodObj.name + 
                                        '</td><td class="price">$ ' + foodObj.price + 
                                        '</td><td class="description">' + foodObj.description + 
                                        '</td><td>' + '<img class="img-responsive img-curve" src="../../images/food/' + foodObj.image + '">' +
                                        '</td><td id="status' + foodObj.foodId + '">' + foodObj.status + 
                                        '</td><td><a class="btn-table" href="modifymenuitem.php?id=' + foodObj.foodId + '">Modify</a>' +
                                        '</td><td><a class="btn-table" onClick="changeStatus(' + foodObj.foodId + ')">Change Status</a>' +
                                        '</td><td><a class="delete" onClick="deleteFood(' + foodObj.foodId + ')">Delete</a>' +
                                        '</td></tr>';

                return htmlStr;
            }

            $(document).ready(function() {
                $.ajax({
                    type: 'get',
                    url: '../../Controller/viewFoodController.php',
                    success: function (response) {
                        
                        $.each(response, function(i, item) {
                            var trHTML = '';
                           trHTML = toHTMLRows(trHTML, item);
                           $('#content').append(trHTML);
                        });
                    },
                });
            });

            function changeStatus(id) {
                var url = '../../Controller/changeMenuStatusController.php' + '?id=' + id;

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (response) {
                        if (response.error == false)
                            $('#status' + id).html(response.message);
                    },
                });
            }

            function deleteFood(id) {
                if (confirm("Are you sure you want to delete this food item?"))
                {
                    var url = '../../Controller/deleteFoodController.php' + '?id=' + id;

                    $.ajax({
                        type: 'get',
                        url: url,
                        success: function (response) {
                            if (response.error == false)
                                $('#foodRow' + id).remove();
                        },
                    });
                }
            }

            $('#search').keyup(function() {
                var url = '../../Controller/searchFoodController.php';
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