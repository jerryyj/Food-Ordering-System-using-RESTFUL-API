<?php
include_once('../config/dbconfig.php');

class FoodRepository extends DBconfig
{
    // Fetch all or a single food by id from database
	public function fetchById($foodId = 0)
    {
	    $sql = 'SELECT * FROM food';
	    if ($foodId != 0)
        {
            $sql .= ' WHERE foodId = :id';
            $stmt = $this->conn->prepare($sql);
	        $stmt->execute(['id' => $foodId]);
        }
        else
        {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
	    
	    $foodItems = $stmt->fetchAll(PDO::FETCH_CLASS, 'Food');
	    return $foodItems;
	}

    // Fetch by status
    public function fetchByStatus($status)
    {
	    $sql = 'SELECT * FROM food WHERE status = :status';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['status' => $status]);
	    $foodItems = $stmt->fetchAll(PDO::FETCH_CLASS, 'Food');
	    return $foodItems;
	}

    // Fetch all food with name from database
    public function fetchByName($name)
    {
        $sql = 'SELECT * FROM food WHERE name LIKE :name OR description LIKE :name';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => "%$name%"]);
        $foodItems = $stmt->fetchAll(PDO::FETCH_CLASS, 'Food');
        return $foodItems;
    }

    // Insert a Food into the database
    public function insert($name, $price, $description, $image, $status)
    {
        $sql = 'INSERT INTO food (name, price, description, image, status) VALUES (:name, :price, :description, :image, :status)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'price' => $price, 'description' => $description, 'image' => $image, 'status' => $status]);
        $count = $stmt->rowCount();
        if ($count === 1)
            return true;
        else
            return false;
    }

	// Update a Food in the database
    public function update($foodId, $name, $price, $description, $image, $status)
    {
        $sql = 'UPDATE food SET name = :name, price = :price, description = :description, image = :image, status = :status WHERE foodId = :foodId';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'price' => $price, 'description' => $description, 'image' => $image, 'status' => $status, 'foodId' => $foodId]);
        if ($stmt->execute(['name' => $name, 'price' => $price, 'description' => $description, 'image' => $image, 'status' => $status, 'foodId' => $foodId]))
            return true;
        else
            return false;
    }

    // Change menu status of food in the database
    public function removeFromMenu($foodId)
    {
        $sql = 'UPDATE food SET status = "Not In Menu" WHERE foodId = :foodId';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['foodId' => $foodId]);
        $count = $stmt->rowCount();

        if ($count === 1)
            return true;
        else
            return false;
    }

    // Change menu status of food in the database
    public function addToMenu($foodId)
    {
        $sql = 'UPDATE food SET status = "In Menu" WHERE foodId = :foodId';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['foodId' => $foodId]);
        $count = $stmt->rowCount();

        if ($count === 1)
            return true;
        else
            return false;
    }

    // Remove food from database
    public function delete($foodId)
    {
        $sql = 'DELETE FROM food WHERE foodId = :foodId';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['foodId' => $foodId]);
        $count = $stmt->rowCount();

        if ($count === 1)
            return true;
        else
            return false;
    }
}