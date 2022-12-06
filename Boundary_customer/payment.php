  
<?php include('../config/constants.php'); ?>
<?php include_once('../config/dbconfig.php'); ?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer - Food Order System</title>
        <link rel="stylesheet" href="../css/style.css">
        <script type="text/javascript" src="../Boundary/js/jquery-3.4.1.min.js"></script>
    </head>

    <body>
        <?php include('../Boundary_customer/header.php'); ?>
        <p id="popUp" class="success" style="display: none;"></p>

        <div class="container text-center">
                <h2 class="orderheader">Payment</h2>
        </div>

        <div class="formcontainer">
                <form id="paymentform" class="userform" name="form">
                        <p id="message" hidden=true></p>
                        <label>Credit card number:</label><br>
                        <input class="fill" name="creditcard" type="text" maxlength="19" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required/>
                        <label>Name on card:</label><br>
                        <input class="fill" type="text" name="cardname" required /><br>
                        <label>Card Expiry (M / Y):</label><br>
                        <span>
                        <input class="box" name="expmonth" type="text" maxlength="2" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required/>
                        </span>
                        <span> / </span>
                        <span>
                        <input class="box" name="expyear" type="text" maxlength="2" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required/>
                        </span><br>
                        <label>CVV:</label>
                        <input class="cvv" name="cvv" type="text" maxlength="4" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required/><br>
                        <label>Your Table No:</label>
                        <input class="box" name="tableno" type="text" maxlength="3" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required/><br>
                        <label>Your Email:</label></br>
                        <input class="fill" type="text" name="email" required /><br>

                        <p class="payable"><span>Total Cost:<span><span id="totalprice" class="food-price-order">$0.00</span></p>
                        <button class="checkoutbtn" type="submit" form="paymentform" value="submit">Make Payment</button>
                </form>
        </div>

        <script>
                function updatePriceFromCart(cartArray) {
                        var totalPrice = 0;

                        if (cartArray != null)
                        {
                        for (let i = 0; i < cartArray.length; i++)
                                totalPrice += parseFloat(cartArray[i].quantity) * parseFloat(cartArray[i].price);
                        }

                        $('#totalprice').html('$' + totalPrice.toFixed(2));
                }

                $(document).ready(function() {
                        var storedCart = JSON.parse(sessionStorage.getItem("cart"));

                        if (storedCart == null || storedCart.length == 0)
                        {
                                window.location.replace('makeorder.php');
                        }
                        updatePriceFromCart(storedCart);
		});

                $('#paymentform').on('submit', function (e) {
                        e.preventDefault();
                        
                        var formData = new FormData(this);
                        // formData.append('items', JSON.stringify(storedCart));
                        formData.append('items', sessionStorage.getItem("cart"));

                        $.ajax({
                        type: 'post',
                        url: '../Controller/makePaymentController.php',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                                        if (response.error == true) {
                                                $('#message').html(response.message);
                                                $('#message').addClass("error").removeClass("paymentsuccess");
                                                $('#message').attr("hidden",false);
                                        } else {
                                                sessionStorage.removeItem("cart");
                                                $('#message').html(response.message);
                                                $('#message').addClass("paymentsuccess").removeClass("error");
                                                $('#message').attr("hidden",false);
                                                $('#paymentform')[0].reset();
                                                updatePriceFromCart(null);

                                                setTimeout(() => {
                                                        window.location.replace('menu.php');
                                                }, 3000);
                                        }
                                },
                        });
                });

        </script>
</body>
</html>








