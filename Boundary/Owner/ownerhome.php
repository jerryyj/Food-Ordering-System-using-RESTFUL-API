<?php 
include('../../config/constants.php');
include('../../config/validateOwnerLogin.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Owner Home</title>
        <link rel="stylesheet" href="../../css/owner.css">
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a class="option" href="ownerhome.php">Home</a></li>
                    <li><a class="logout" href="../../Controller/managerLogoutController.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <h1 class="overview">View Report</h1>
        <div class="container">
        <div>
            <form id="reportform">
                <label>View report by</label>
                <select id="reporttype">
                    <option value="Day">Day</option>
                    <option value="Week">Week</option>
                    <option value="Month">Month</option>
                </select>
                <label>from</label>
                <input id="date" type="date" name="date" required>
                <button class="reportbtn" type="submit" form="reportform" value="submit">Generate</button>
            </form>
            <p id="reportnum" class="reportnum"></p>
        </div>

        <div id="report">
            
        </div>
        
        </div>
        <script>
            function toHTMLDivs(htmlStr, statsObj)
            {
            htmlStr += '<div class="food-menu-box-order">' +
                        '<div class="food-menu-desc-order"><h4 id="foodname">Most Ordered Dish</h4><br>' +
                        '<span>' + statsObj.MOrdD + '</span>' +
                        '</div></div>';

            htmlStr += '<div class="food-menu-box-order">' +
                        '<div class="food-menu-desc-order"><h4 id="foodname">Least Ordered Dish</h4><br>' +
                        '<span>' + statsObj.LOrdD + '</span>' +
                        '</div></div>';
            
            htmlStr += '<div class="food-menu-box-order">' +
                        '<div class="food-menu-desc-order"><h4 id="foodname">Average spend per visit</h4><br>' +
                        '<span>$ ' + statsObj.AVGSPV.toFixed(2) + '</span>' +
                        '</div></div>';

            return htmlStr;
            }

            $('#reportform').on('submit', function (e) {
            e.preventDefault();

            var type = $('#reporttype').val();
            var url;
            if (type == "Day")
                url = '../../Controller/viewDailyReportController.php';
            else if (type == "Week")
                url = '../../Controller/viewWeeklyReportController.php';
            else
                url = '../../Controller/viewMonthlyReportController.php';
            
                $.ajax({
                    type: 'post',
                    url: url,
                    data: $('#reportform').serialize(),
                    success: function (response) {
                        if (response.error == true) {
                            $('#reportnum').html(response.message);
                            $('#report').html('');
                        } else {
                            var statsArray = response.message[0];
                            var message = "Viewing report for "
                            if ('endDate' in statsArray)
                            {
                                message += statsArray.startDate + ' - ' + statsArray.endDate;
                            }
                            else
                            {
                                message += statsArray.startDate;
                            }
                            $('#reportnum').html(message);

                            var htmlStr = '';
                            htmlStr = toHTMLDivs(htmlStr, statsArray);
                            $('#report').html(htmlStr);
                        }
                    },
                });
            });
        </script>
        </body>
</html>