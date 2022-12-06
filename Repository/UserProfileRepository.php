<?php
include_once('../config/dbconfig.php');

class UserProfileRepository extends DBconfig
{
    // Fetch all or a single user profile by id from database
	public function fetchById($id = 0)
    {
	    $sql = 'SELECT * FROM userprofile';
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
	    
	    $userprofiles = $stmt->fetchAll(PDO::FETCH_CLASS, 'UserProfile');
	    return $userprofiles;
	}

    // Fetch all user profile with name from database
    public function fetchByName($name)
    {
        $sql = 'SELECT * FROM userprofile WHERE name LIKE :name';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => "%$name%"]);
        $userprofiles = $stmt->fetchAll(PDO::FETCH_CLASS, 'UserProfile');
        return $userprofiles;
    }

    // Insert a user profile into the database
    public function insert($name, $status)
    {
        // Check if user profile of the same name exists
        $sql = 'SELECT * FROM userprofile WHERE name = :name';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name]);
        $count = $stmt->rowCount();
        if ($count === 1)
            return false;
        else
        {
            // Create user profile in database
            $sql = 'INSERT INTO userprofile (name, status) VALUES (:name, :status)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['name' => $name, 'status' => $status]);
            return true;
        }
    }

	// Update a user profile in the database
    public function update($id, $name, $status)
    {
        // Check if user profile of the same name exists
        $sql = 'SELECT * FROM userprofile WHERE name = :name';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name]);
        $count = $stmt->rowCount();
        if ($count === 1)
        {
            $row = $stmt->fetch();
            if ($row['id'] !== $id)
            {
                return false;
            }
        }
        
        $sql = 'UPDATE userprofile SET name = :name, status = :status WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute(['name' => $name, 'status' => $status, 'id' => $id]))
        {
            $sql = 'UPDATE users SET status = :status WHERE userroleId = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['status' => $status, 'id' => $id]);
        }
        return true;
    }

    // Suspend a user profile in the database
    public function suspend($id)
    {
        $sql = 'UPDATE userprofile SET status = "Suspended" WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $count = $stmt->rowCount();

        if ($count === 1)
        {
            $sql = 'UPDATE users SET status = "Suspended" WHERE userroleId = :id';
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute(['id' => $id]))
                return true;
        }
        else
            return false;
    }

    // Activate a user profile in the database
    public function activate($id)
    {
        $sql = 'UPDATE userprofile SET status = "Active" WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $count = $stmt->rowCount();

        if ($count === 1)
        {
            $sql = 'UPDATE users SET status = "Active" WHERE userroleId = :id';
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute(['id' => $id]))
                return true;
        }
        else
            return false;
    }
}