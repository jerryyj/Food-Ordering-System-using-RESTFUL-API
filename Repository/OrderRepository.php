<?php
include_once('../config/dbconfig.php');

class OrderRepository extends DBconfig
{
    // Fetch all or a single order by id from database
	public function fetchById($orderId = 0) : array
    {
	    $sql = 'SELECT * FROM orders';
	    if ($orderId != 0)
        {
            $sql .= ' WHERE orderId = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $orderId]);
        }
        else
        {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        
	    $orders = $stmt->fetchAll(PDO::FETCH_CLASS, 'Order');
	    return $orders;
	}

    // Fetch orders by status
    public function fetchByStatus($orderStatus) : array
    {
	    $sql = 'SELECT * FROM orders WHERE orderStatus = :status';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['status' => $orderStatus]);
	    $orders = $stmt->fetchAll(PDO::FETCH_CLASS, 'Order');
	    return $orders;
	}

    // Fetch orders by tableNo and status
    public function fetchByTableNo($tableNo, $orderStatus) : array
    {
        $sql = 'SELECT * FROM orders WHERE orderStatus = :status AND CAST(tableNo AS VARCHAR(10)) LIKE :tableNo';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['status' => $orderStatus, 'tableNo' => "%$tableNo%"]);
	    $orders = $stmt->fetchAll(PDO::FETCH_CLASS, 'Order');
	    return $orders;
	}

    // Fetch orders by orderId and status
    public function fetchByOrderId($orderId, $orderStatus) : array
    {
        $sql = 'SELECT * FROM orders WHERE orderStatus = :status AND CAST(orderId AS VARCHAR(10)) LIKE :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['status' => $orderStatus, 'id' => "%$orderId%"]);
	    $orders = $stmt->fetchAll(PDO::FETCH_CLASS, 'Order');
	    return $orders;
	}

    // Insert an order into the database
    public function insert($customerEmail, $tableNo, $itemsArray) : bool
    {
        $sql = 'INSERT INTO orders (customerEmail, tableNo, orderDate) VALUES (:email, :tableNo, :orderDate)';
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute(['email' => $customerEmail, 'tableNo' => $tableNo, 'orderDate' => date('Y-m-d')]))
        {
            $insertedId = $this->conn->lastInsertId();
            
            foreach ($itemsArray as $item)
            {
                $sql = 'SELECT * FROM food WHERE foodId = :id';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(['id' => $item['foodId']]);
                $foodItem = $stmt->fetch();

                $totalPrice = $foodItem['price'] * $item['quantity'];

                $sql = 'INSERT INTO order_details (orderId, foodName, unitPrice, quantity, totalPrice) VALUES (:orderId, :foodName, :unitPrice, :quantity, :totalPrice)';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(['orderId' => $insertedId, 'foodName' => $foodItem['name'], 'unitPrice' => $foodItem['price'], 'quantity' => $item['quantity'], 'totalPrice' => $totalPrice]);
            }

            return true;
        }
        else
            return false;
    }

    // Set status of an order to completed in the database
    public function completeOrder($orderId) : bool
    {
        $sql = 'UPDATE orders SET orderStatus = "Completed" WHERE orderId = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $orderId]);
        $count = $stmt->rowCount();

        if ($count === 1)
        {
            $sql = 'UPDATE order_details SET status = "Completed" WHERE orderId = :id';
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute(['id' => $orderId]))
                return true;
        }
        else
            return false;
    }

    // Set status of an order to cancelled in the database
    public function cancelOrder($orderId) : bool
    {
        $sql = 'UPDATE orders SET orderStatus = "Cancelled" WHERE orderId = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $orderId]);
        $count = $stmt->rowCount();

        if ($count === 1)
        {
            $sql = 'UPDATE order_details SET status = "Cancelled" WHERE orderId = :id';
            $stmt = $this->conn->prepare($sql);
	        $stmt->execute(['id' => $orderId]);
            $count = $stmt->rowCount();

            if ($count >= 1)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    // Get business data from database
    public function fetchStatistics($startDate, $endDate)
    {
        $sql = 'SELECT o.orderId, od.totalPrice, od.foodName
            FROM orders o INNER JOIN order_details od
            ON o.orderId = od.orderId
            WHERE orderStatus = "Completed"
            AND orderDate between :startDate AND :endDate';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['startDate' => $startDate, 'endDate' => $endDate]);
        if ($stmt->execute())
        {
            $orderStats = $stmt->fetchAll();
            return $orderStats;
        }
    }
}