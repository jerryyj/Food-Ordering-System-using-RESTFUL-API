<?php
include_once('../Repository/OrderRepository.php');

class Order
{
    /*
        Maps to orders table in database with the following columns:
        - orderId
        - customerEmail
        - tableNo
        - orderDate
        - orderStatus
    */
    public $orderId;            
    public $customerEmail;
    public $tableNo;            
    public $orderDate;          
    public $orderStatus;        
    public $orderDetailsList;   // array type of OrderDetail objects

    // Fetch all or a single order by id from database
	public function fetchById($orderId = 0) : array
    {
	    $repository = new OrderRepository();
        return $repository->fetchById($orderId);
	}

    // Fetch orders by status
    public function fetchByStatus($orderStatus) : array
    {
        $repository = new OrderRepository();
	    return $repository->fetchByStatus($orderStatus);
	}

    // Fetch orders by tableNo and status
    public function fetchByTableNo($tableNo, $orderStatus) : array
    {
        $repository = new OrderRepository();
	    return $repository->fetchByTableNo($tableNo, $orderStatus);
	}

    // Fetch orders by orderId and status
    public function fetchByOrderId($orderId, $orderStatus) : array
    {
        $repository = new OrderRepository();
	    return $repository->fetchByOrderId($orderId, $orderStatus);
	}

    // Insert an order into the database
    public function insert($customerEmail, $tableNo, $itemsArray) : bool
    {
        $repository = new OrderRepository();
	    return $repository->insert($customerEmail, $tableNo, $itemsArray);
    }

    // Set status of an order to completed in the database
    public function completeOrder($orderId) : bool
    {
        $repository = new OrderRepository();
	    return $repository->completeOrder($orderId);
    }

    // Set status of an order to cancelled in the database
    public function cancelOrder($orderId) : bool
    {
        $repository = new OrderRepository();
	    return $repository->cancelOrder($orderId);
    }

    // Get business data from database
    public function fetchStatistics($startDate, $endDate) : array
    {
        $repository = new OrderRepository();
	    return $repository->fetchStatistics($startDate, $endDate);
    }
}
?>