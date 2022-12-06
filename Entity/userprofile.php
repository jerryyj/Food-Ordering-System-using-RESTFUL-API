<?php
include_once('../Repository/UserProfileRepository.php');

class UserProfile
{
    /*
        Maps to users table in database with the following columns:
        - id
        - name
        - status
    */
    public $id;     
    public $name;   
    public $status;

    // Fetch all or a single user by id from database
	public function fetchById($id = 0) : array
    {
        $repository = new UserProfileRepository();
        return $repository->fetchById($id);
	}

    // Fetch all user profile with name from database
    public function fetchByName($name) : array
    {
        $repository = new UserProfileRepository();
        return $repository->fetchByName($name);
    }

    // Insert a user profile into the database
    public function insert($name, $status) : bool
    {
        $repository = new UserProfileRepository();
        return $repository->insert($name, $status);
    }

	// Update a user profile in the database
    public function update($id, $name, $status) : bool
    {
        $repository = new UserProfileRepository();
        return $repository->update($id, $name, $status);
    }

    // Suspend a user profile in the database
    public function suspend($id) : bool
    {
        $repository = new UserProfileRepository();
        return $repository->suspend($id);
    }

    // Activate a user profile in the database
    public function activate($id) : bool
    {
        $repository = new UserProfileRepository();
        return $repository->activate($id);
    }
}
?>