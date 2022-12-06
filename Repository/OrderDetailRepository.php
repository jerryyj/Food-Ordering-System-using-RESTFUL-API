<?php
include_once('../config/dbconfig.php');

class OrderDetailRepository extends DBconfig
{
    // Fetch multiple order details by orderId from database
	public function fetchByOrderId($orderId)
    {
	    $sql = 'SELECT * FROM order_details WHERE orderId = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $orderId]);
	    $orderDetails = $stmt->fetchAll(PDO::FETCH_CLASS, 'OrderDetail');
	    return $orderDetails;
	}

    // Set status of order item to completed
	public function completeOrderItem($id)
    {
	    $sql = 'UPDATE order_details SET status = "Completed" WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
        $count = $stmt->rowCount();

        if ($count === 1)
            return true;
        else
            return false;
	}
}