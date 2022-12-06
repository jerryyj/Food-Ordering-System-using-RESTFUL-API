<?php include('../../config/constants.php'); 
include('../../config/validateStaffLogin.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Staff Home</title>
        <link rel="stylesheet" href="../../css/staff.css">
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a class="option" href="staffhome.php">Manage Orders</a></li>
                    <li><a class="option" href="staffmenu.php">Make Order</a></li>
                    <li><a class="option" href="staffmakeorder.php">View Order</a><li>
                    <li><a class="logout" href="../../Controller/staffLogoutController.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <h1 class="overview">Pending Orders</h1>
        <p id="message" class="message" hidden="true"></p>
        <div class="container">
            <div class="search">
                <label>Search by <span><select id="searchby">
                    <option value="orderno">Order No.</option>
                    <option value="tableno">Table No.</option>
                </select> </span>:</label>
                <input id="search" type="text">
            </div>

            <p id="noOfItems" class="food-detail" hidden="true"></p>

            <div id="orderslist">
                

            </div>
        </div>
        <script>
            function toHTMLDivs(htmlStr, Obj)
            {
                var orderDArray = Obj.orderDetailsList;

                htmlStr += '<div id="order' + Obj.orderId + '">' +
                            '<button class="collapsible">Order No.: ' + Obj.orderId + '&emsp;Table No.: ' + Obj.tableNo + '</button>' +
                            '<div class="content"><table><thead><tr><th>Order Item</th><th>Quantity</th><th>Status</th><th></th></tr></thead><tbody>';

                for (let i=0; i<orderDArray.length; i++)
                {
                    htmlStr += '<tr><td>' + orderDArray[i].foodName + 
                                '</td><td>' + orderDArray[i].quantity +
                                '</td><td id="status' + orderDArray[i].id + '">' + orderDArray[i].status +
                                '</td><td><button class="btn-table" onClick="changeItemStatus(' + orderDArray[i].id + ')">Set Complete</button></td><tr>';
                }

                return htmlStr += '</tbody></table><br>' + '<button class="completebtn" onClick="completeOrder(' + Obj.orderId + ')">Complete Order</button>' +
                                    '<button class="cancelbtn" onClick="cancelOrder(' + Obj.orderId + ')">Cancel Order</button></div>';
            }

            function changeItemStatus(id) {
                if (confirm("Are you sure you want to set this item as completed?"))
                {
                    var url = '../../Controller/manageOrderController.php' + '?id=' + id;

                    $.ajax({
                        type: 'get',
                        url: url,
                        success: function (response) {
                            if (response.error == false)
                                $('#status' + id).html(response.message);
                        },
                    });
                }
            }

            function completeOrder(orderId) {
                if (confirm("Are you sure you want to complete Order No. " + orderId + "?"))
                {
                    var url = '../../Controller/completeOrderController.php' + '?id=' + orderId;

                    $.ajax({
                        type: 'get',
                        url: url,
                        success: function (response) {
                            if (response.error == false)
                                $('#order' + orderId).remove();
                        },
                    });
                }
            }

            function cancelOrder(orderId) {
                if (confirm("Are you sure you want to cancel Order No. " + orderId + "?"))
                {
                    var url = '../../Controller/cancelOrderController.php' + '?id=' + orderId;

                    $.ajax({
                        type: 'get',
                        url: url,
                        success: function (response) {
                            if (response.error == false)
                                $('#order' + orderId).remove();
                        },
                    });
                }
            }

            $('#search').keyup(function() {
                var url = '../../Controller/searchOrderController.php';
                var id = $('#search').val();
                var type = $('#searchby').val();
                url = url + '?id=' + id + '&type=' + type;
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (response) {
                        $('#orderslist').empty();
                        $.each(response, function(i, item) {
                                var trHTML = '';
                                trHTML = toHTMLDivs(trHTML, item);
                                $('#orderslist').append(trHTML);
                            });
                    },
                });
            });

            $(document).on('click', '.collapsible', function(){
                $(this).toggleClass("active");
                var content = $(this).next();
                if (content.css('display') === "block") {
                    content.css('display', "none");
                } else {
                    content.css('display', "block");
                }
            });

            $(document).ready(function(){
                $.ajax({
                        type: 'get',
                        url: '../../Controller/displayOrdersController.php',
                        success: function (response) {
                            if (response.length > 0)
                            {
                                $('#noOfItems').attr('hidden', true);
                                $.each(response, function(i, item) {
                                var trHTML = '';
                                trHTML = toHTMLDivs(trHTML, item);
                                $('#orderslist').append(trHTML);
                            });
                            }
                            else
                            {
                                $('#noOfItems').html('There are no pending orders');
                                $('#noOfItems').removeAttr('hidden');
                            }
                            
                        },
                    });
            });
        </script>
    </body>
</html>