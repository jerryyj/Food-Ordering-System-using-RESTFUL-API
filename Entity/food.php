<?php
include_once('../Repository/FoodRepository.php');

class Food
{
    /*
        Maps to food table in database with the following columns:
        - foodId
        - name
        - price
        - description
        - image
        - status
    */
    public $foodId;
    public $name;
    public $price;
    public $description;
    public $image;
    public $status;

    // Fetch all or a single food by id from database
	public function fetchById($foodId = 0) : array
    {
	    $repository = new FoodRepository();
        return $repository->fetchById($foodId);
	}

    // Fetch by status
    public function fetchByStatus($status) : array
    {
        $repository = new FoodRepository();
        return $repository->fetchByStatus($status);
	}

    // Fetch all food with similar name from database
    public function fetchByName($name) : array
    {
        $repository = new FoodRepository();
        return $repository->fetchByName($name);
    }

    // Insert a Food into the database
    public function insert($name, $price, $description, $image, $status) : bool
    {
        $repository = new FoodRepository();
        return $repository->insert($name, $price, $description, $image, $status);
    }

	// Update a Food in the database
    public function update($foodId, $name, $price, $description, $image, $status) : bool
    {
        $repository = new FoodRepository();
        return $repository->update($foodId, $name, $price, $description, $image, $status);
    }

    // Change menu status of food in the database
    public function removeFromMenu($foodId) : bool
    {
        $repository = new FoodRepository();
        return $repository->removeFromMenu($foodId);
    }

    // Change menu status of food in the database
    public function addToMenu($foodId) : bool
    {
        $repository = new FoodRepository();
        return $repository->addToMenu($foodId);
    }

    // Remove food from database
    public function delete($foodId) : bool
    {
        $repository = new FoodRepository();
        return $repository->delete($foodId);
    }
}
?>