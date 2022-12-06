<?php
// Include CORS headers
header('Content-Type: application/json');

// Include dependencies
include('../config/constants.php');
include('../config/validateOwnerLogin.php');
include_once ('../Entity/orders.php');

// Declare functions
function getDailyStatistics($date)
{
    // Create object of user class
    $order = new Order();
    $data = $order->fetchStatistics($date, $date);
    $computedStats = array();
    
    if (!empty($data))
    {
        $totalExpenditure = 0;
        $dishCountArray = array();
        $orderIdArray = array();

        foreach ($data as $order)
        {
            $totalExpenditure += $order['totalPrice'];

            if (!in_array($order['orderId'], $orderIdArray))
                array_push($orderIdArray, $order['orderId']);

            if (!array_key_exists($order['foodName'], $dishCountArray))
            {
                $dishCountArray[$order['foodName']] = 1;
            }
            else
            {
                $dishCountArray[$order['foodName']] += 1;
            }
        }

        arsort($dishCountArray);
        reset($dishCountArray);
        $mostOrderedDish = key($dishCountArray);
        end(($dishCountArray));
        $leastOrderedDish = key($dishCountArray);

        $averageSpendPerV = round($totalExpenditure / count($orderIdArray), 2);

        array_push($computedStats, ['MOrdD' => $mostOrderedDish,
                                        'LOrdD' => $leastOrderedDish,
                                        'AVGSPV' => $averageSpendPerV,
                                        'startDate' => date('d M Y', strtotime($date))]);

        echo message($computedStats, false);
    }
    else
    {
        $formatDate = date('d M Y', strtotime($date));
        echo message("No data available on $formatDate", true);
    }
}

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'POST')
{
    $date = date('Y-m-d', strtotime($_POST['date']));

    getDailyStatistics($date);

}
?>