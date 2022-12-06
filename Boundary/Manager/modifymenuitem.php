<?php 
include('../../config/constants.php');
include('../../config/validateManagerLogin.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manager - Modify Food Item</title>
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

        <h1 class= "overview">Modify Food Item</h1>
        <form id="modifyitemform" class="userform" name="form">
            <p id="message" hidden=true></p>
            <label>Name:</label><br>
            <input id="name" class="fill" type="text" name="name" placeholder="Name" required /><br>
            <label>Price:</label><br>
            <input id="price" class="fill" type="number" name="price" min="0.00" step="0.01" placeholder="Price" required/>
            <label>Description (max. 250 characters):</label><br>
            <textarea id="description" name="description" form="modifyitemform" maxlength="250" placeholder="Description" required></textarea><br>
            <label>Image (jpg, jpeg, png) (optional):</label><br>
            <input class="fill" type="file" name="image" accept="image/png, image/jpeg, image/jpg"><br>
            <label>Status:</label><br>
            <div class="select">
            <select id="status" name="status">
                <option value="In Menu">In Menu</option>
                <option value="Not In Menu">Not In Menu</option>
            </select>
            </div>

            <button class="createbtn" type="submit" form="modifyitemform" value="submit">Modify Item</button>
        </form>
        <script>
            var id = '<?php echo $_GET['id']; ?>';
            var currentImg;

            $(document).ready(function() {
                $.ajax({
                    type: 'get',
                    url: '../../Controller/modifyFoodController.php?id=' + id,
                    success: function (response) {
                        var food = response[0];
                        $('#name').val(food.name);
                        $('#price').val(food.price);
                        $('#description').val(food.description);
                        $('#status').val(food.status);
                        currentImg = food.image;
                    },
                });
            });

            $('#modifyitemform').on('submit', function (e) {
            e.preventDefault();

                var formData = new FormData(this);
                formData.append('currentImg', currentImg);
                formData.append('id', id);
            
                $.ajax({
                    type: 'post',
                    url: '../../Controller/modifyFoodController.php',
                    data: formData,
                    processData: false,
                    contentType: false,
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