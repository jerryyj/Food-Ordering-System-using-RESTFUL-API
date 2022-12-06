<?php
include_once('../Repository/OrderDetailRepository.php');

class OrderDetail
{
    /*
        Maps to orderdetails table in database with the following columns:
        - id
        - orderId
        - foodId
        - unitPrice
        - quantity
        - totalPrice
        - status
    */
    public $id;
    public $orderId;
    public $foodName;
    public $unitPrice;
    public $quantity;
    public $totalPrice;
    public $status;

    // Fetch all or a single order detail by orderId from database
	public function fetchByOrderId($orderId) : array
    {
	    $repository = new OrderDetailRepository();
        return $repository->fetchByOrderId($orderId);
	}

    // Complete order item
    public function completeOrderItem($id) : bool 
    {
        $repository = new OrderDetailRepository();
        return $repository->completeOrderItem($id);
    }
}
?>