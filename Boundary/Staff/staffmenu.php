<?php include('../../config/constants.php'); 
include('../../config/validateStaffLogin.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Staff - Food Order System</title>
        <link rel="stylesheet" href="../../css/style.css">
        <script type="text/javascript" src="../../Boundary/js/jquery-3.4.1.min.js"></script>
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
    <p id="popUp" class="success" style="display: none;"></p>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <input id ="search" type="search" name="search" placeholder="Search for Food.." required>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
        
    <!-- fOOD MEnu -->       
<section class="food-menu">
    <div class="container">
    <h2 class="text-center">Food Menu</h2>
    <div id="foodlist"></div>
                   
    </div>
</section>

    <script>
        function toHTMLDivs(htmlStr, foodObj)
        {
            htmlStr += '<div class="food-menu-box"><div class="food-menu-img">' +
                        '<img class="img-responsive img-curve" src="../../images/food/' + foodObj.image + '">' +
                        '</div><div class="food-menu-desc"><h4 id="foodname">' + foodObj.name + '</h4>' +
                        '<p class="food-price">$' + foodObj.price + '</p>' +
                        '<p class="food-detail">' + foodObj.description + '</p><br>' +
                        '<p>Quantity:</p>' +
                        '<span class="number"><span class="minus">-</span><input class="quantity" type="number" min=1 onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=1 /><span class="plus">+</span></span>' +
                        '<button id="' + foodObj.foodId + '" class="btn btn-primary addorderbtn">Add to Order</button>' +
                        '</div></div>';

            return htmlStr;
         }

        $(document).ready(function() {
                $.ajax({
                        type: 'get',
                        url: '../../Controller/staffViewMenuController.php',
                        success: function (response) {
                            var trHTML = '';
                            $.each(response, function(i, item) {
                                trHTML = toHTMLDivs(trHTML, item);
                            });
                            $('#foodlist').html(trHTML);
                        },
                    });
			});

        $(document).on('click', '.minus', function() {
            var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
        });

        $(document).on('click', '.plus', function() {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });

        $(document).on('change', '.quantity', function() {
                var value = $(this).val();

                if (value == "" || value == 0)
                    $(this).val(1);
            });

        $(document).on('click', '.addorderbtn', function() {
            setTimeout(function(){
            $('.addorderbtn').prop('disabled', true);
            }, 10);
            setTimeout(function(){
            $('.addorderbtn').prop('disabled', false);
            }, 2000);
            var foodId = $(this).attr('id');
            var quantity = $(this).parent().find('.quantity').val();
            var name = $(this).parent().find('#foodname').text();
            var price = $(this).parent().find('.food-price').text();
            price = price.substring(1);

            var storedCart = JSON.parse(sessionStorage.getItem("cart"));

            if (!storedCart)
                storedCart = [];
            else
                var item = storedCart.find(item => item.foodId == foodId);

            if (item) {
                item.quantity = parseInt(item.quantity) + parseInt(quantity);
            }
            else {
                storedCart.push({
                    foodId, name, quantity, price
                });
            }

            var jsonStr = JSON.stringify(storedCart);
            sessionStorage.setItem("cart", jsonStr);

            $( "#popUp" ).html(quantity + ' ' + name + ' added to order');
            $( "#popUp" ).show(); 
            setTimeout(function() {
            $( "#popUp" ).hide();
            }, 2000);
        });

        $('#search').keyup(function() {
            var name = $('#search').val();
            var url = '../../Controller/staffSearchMenuController.php?name=' + name;
            
            $.ajax({
                type: 'get',
                url: url,
                success: function (response) {
                    $('#foodlist').empty();
                    $.each(response, function(i, item) {
                        var trHTML = '';
                        trHTML = toHTMLDivs(trHTML, item);
                        $('#foodlist').append(trHTML);
                    });
                    
                },
            });
        });

    </script>

    </body>
</html>