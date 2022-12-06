<?php
include_once('../config/dbconfig.php');

class UserRepository extends DBconfig
{
    // Fetch all or a single user by id from database
	public function fetchById($id = 0)
    {
	    $sql = 'SELECT * FROM users';
	    if ($id != 0)
        {
            $sql .= ' WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
        }
        else
        {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
	    
	    $users = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
	    return $users;
	}

    // Fetch all users with name from database
    public function fetchByName($name)
    {
        $sql = 'SELECT * FROM users WHERE name LIKE :name';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => "%$name%"]);
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
        return $users;
    }

    // Insert a user into the database
    public function insert($name, $username, $password, $userroleId, $status)
    {
        // Check if username exists
        $sql = 'SELECT * FROM users WHERE username = :username';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username]);
        $count = $stmt->rowCount();
        if ($count === 1)
            return false;
        else
        {
            // Get user profile status
            $sql = 'SELECT * FROM userprofile WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $userroleId]);
            $row = $stmt->fetch();
            $status = $row['status'];

            // Create user in database
            $sql = 'INSERT INTO users (name, username, password, userroleId, status) VALUES (:name, :username, :password, :userroleId, :status)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['name' => $name, 'username' => $username, 'password' => $password, 'userroleId' => $userroleId, 'status' => $status]);
            return true;
        }
    }

	// Update a user in the database
    public function update($id, $name, $username, $password, $userroleId, $status)
    {
        // Check if updating the same user with same username
        $sql = 'SELECT * FROM users WHERE username = :username';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username]);
        $count = $stmt->rowCount();
        if ($count === 1)
        {
            $row = $stmt->fetch();
            if ($row['id'] !== $id)
            {
                return false;
            }
        }

        // Get user profile status
        $sql = 'SELECT * FROM userprofile WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $userroleId]);
        $row = $stmt->fetch();
        if ($row['status'] === 'Suspended')
            $status = $row['status'];

        $sql = 'UPDATE users SET name = :name, username = :username, password = :password, userroleId = :userroleId, status = :status WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'username' => $username, 'password' => $password, 'userroleId' => $userroleId, 'status' => $status, 'id' => $id]);
        return true;
    }

    // Suspend a user in the database
    public function suspend($id)
    {
        $sql = 'UPDATE users SET status = "Suspended" WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $count = $stmt->rowCount();

        if ($count === 1)
            return true;
        else
            return false;
    }

    // Activate a user in the database
    public function activate($id)
    {
        $sql = 'UPDATE users SET status = "Active" WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $count = $stmt->rowCount();

        if ($count === 1)
            return true;
        else
            return false;
    }

    // Validate a user in the database
    public function validateLogin($username, $password, $userroleId)
    {
        $sql = 'SELECT * FROM users WHERE username = :username AND password = :password AND userroleId = :userroleId';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password, 'userroleId' => $userroleId]);
        $data = $stmt->fetchObject('User');
        return $data;
    }
}