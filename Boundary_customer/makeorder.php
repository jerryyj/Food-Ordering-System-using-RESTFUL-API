<?php include('../config/constants.php'); ?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer - Food Order System</title>
        <link rel="stylesheet" href="../css/style.css">
        <script type="text/javascript" src="../Boundary/js/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <div class="main-content">
            <?php include('../Boundary_customer/header.php'); ?>
            <p id="popUp" display="none"></p>

            <div class="container text-center">
                <h2 class="orderheader">Your Order</h2>
                <p id="noOfItems" class="food-detail"></p>
            </div>
            <div id="cartlist"></div>
        </div>

        <div class="pricecontainer float-container">
            <div class="pricesummary">
                <p><span>Total Cost:<span><span id="totalprice" class="food-price-order">5.60</span></p>
                <a class="checkoutbtn">Checkout</a>
            </div>
        </div>
        
        <script>
            function updateFromCart(cartArray) {
                if (cartArray == null)
                    $('#noOfItems').html('You have no items in your cart');
                else
                {
                    $('#noOfItems').html('You have ' + cartArray.length + ' items in your cart');
                    
                    var trHTML = '';
                    for (let i=0; i < cartArray.length; i++)
                    {
                        trHTML = toHTMLDivs(trHTML, cartArray[i]);
                    }
                    $('#cartlist').html(trHTML);
                }
            }

            function updatePriceFromCart(cartArray) {
                var totalPrice = 0;

                if (cartArray != null)
                {
                    for (let i = 0; i < cartArray.length; i++)
                        totalPrice += parseFloat(cartArray[i].quantity) * parseFloat(cartArray[i].price);
                }

                $('#totalprice').html('$' + totalPrice.toFixed(2));
            }

            function toHTMLDivs(htmlStr, cartItem)
            {
            htmlStr += '<div class="food-menu-box-order">' +
                        '<div class="food-menu-desc-order" id="' + cartItem.foodId + '"><h4 id="foodname">' + cartItem.name + '</h4><br>' +
                        '<div class="number"><span class="minus">-</span><input class="quantity" type="number" min=1 onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="' + cartItem.quantity + '"/><span class="plus">+</span>' +
                        '<span class="food-price-order">$' + cartItem.price + '</span></div>' +
                        '<button class="removeorderbtn">Remove</button>' +
                        '</div></div>';

            return htmlStr;
            }

            $(document).on('click', '.removeorderbtn', function() {
                var foodId = $(this).parent().attr('id');
                var storedCart = JSON.parse(sessionStorage.getItem("cart"));
                var item = storedCart.find(item => item.foodId == foodId);
                var name = item.name;
                var index = storedCart.indexOf(item);

                if (index > -1){
                    storedCart.splice(index, 1);
                }

                var jsonStr = JSON.stringify(storedCart);
                sessionStorage.setItem("cart", jsonStr);
                updateFromCart(storedCart);
                updatePriceFromCart(storedCart);

                $( "#popUp" ).addClass("success").removeClass("error");
                $( "#popUp" ).html('Item ' + name + ' removed from your order');
                $( "#popUp" ).show(); 
                setTimeout(function() {
                $( "#popUp" ).hide();
                }, 2000);
        });

        $(document).on('click', '.checkoutbtn', function() {
                var storedCart = JSON.parse(sessionStorage.getItem("cart"));

                if (storedCart == null || storedCart.length == 0)
                {
                    $( "#popUp" ).addClass("error").removeClass("success");
                    $( "#popUp" ).html('You have no items in your cart');
                    $( "#popUp" ).show(); 
                    setTimeout(function() {
                    $( "#popUp" ).hide();
                    }, 2000);
                }
                else
                {
                    window.location.replace('payment.php');
                }
        });

        $(document).on('click', '.minus', function() {
                var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();

                var foodId = $(this).parent().parent().attr('id');
                var storedCart = JSON.parse(sessionStorage.getItem("cart"));
                var item = storedCart.find(item => item.foodId == foodId);
                item.quantity = parseInt(count);

                var jsonStr = JSON.stringify(storedCart);
                sessionStorage.setItem("cart", jsonStr);
                updateFromCart(storedCart);
                updatePriceFromCart(storedCart);

				return false;
            });

            $(document).on('click', '.plus', function() {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) + 1;
                $input.val(count);
                $input.change();

                var foodId = $(this).parent().parent().attr('id');
                var storedCart = JSON.parse(sessionStorage.getItem("cart"));
                var item = storedCart.find(item => item.foodId == foodId);
                item.quantity = parseInt(count);
                
                var jsonStr = JSON.stringify(storedCart);
                sessionStorage.setItem("cart", jsonStr);
                updateFromCart(storedCart);
                updatePriceFromCart(storedCart);

                return false;
            });

            $(document).on('change', '.quantity', function() {
                var value = $(this).val();

                if (value == "" || value == 0)
                    $(this).val(1);

                var count = $(this).val();

                var foodId = $(this).parent().parent().attr('id');
                var storedCart = JSON.parse(sessionStorage.getItem("cart"));
                var item = storedCart.find(item => item.foodId == foodId);
                item.quantity = parseInt(count);
                
                var jsonStr = JSON.stringify(storedCart);
                sessionStorage.setItem("cart", jsonStr);
                updateFromCart(storedCart);
                updatePriceFromCart(storedCart);
            });

            $(document).ready(function() {
                var storedCart = JSON.parse(sessionStorage.getItem("cart"));
                updateFromCart(storedCart);
                updatePriceFromCart(storedCart);
			});
            
        </script>
    </body>
</html>