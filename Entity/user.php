<?php
include_once('../Repository/UserRepository.php');

class User
{
    /*
        Maps to users table in database with the following columns:
        - id
        - name
        - username
        - password
        - userroleId
        - status
    */
    public $id;             
    public $name;           
    public $username;       
    public $password;       
    public $userroleId;     
    public $status;         
    public $userProfile;    // UserProfile object type

    // Fetch all or a single user by id from database
	public function fetchById($id = 0) : array
    {
        $repository = new UserRepository();
        return $repository->fetchById($id);
	}

    // Fetch all users with name from database
    public function fetchByName($name) : array
    {
        $repository = new UserRepository();
        return $repository->fetchByName($name);
    }

    // Insert a user into the database
    public function insert($name, $username, $password, $userroleId, $status) : bool
    {
        $repository = new UserRepository();
        return $repository->insert($name, $username, $password, $userroleId, $status);
    }

	// Update a user in the database
    public function update($id, $name, $username, $password, $userroleId, $status) : bool
    {
        $repository = new UserRepository();
        return $repository->update($id, $name, $username, $password, $userroleId, $status);
    }

    // Suspend a user in the database
    public function suspend($id) : bool
    {
        $repository = new UserRepository();
        return $repository->suspend($id);
    }

    // Activate a user in the database
    public function activate($id) : bool
    {
        $repository = new UserRepository();
        return $repository->activate($id);
    }

    // Validate a user in the database
    public function validateLogin($username, $password, $userroleId) : string
    {
        $repository = new UserRepository();
        $user = $repository->validateLogin($username, $password, $userroleId);

        if ($user)
        {
            if ($user->status === 'Active')
                return 'valid';
            else
                return 'suspended';
        }
        else
            return 'failed';
    }
}
?>