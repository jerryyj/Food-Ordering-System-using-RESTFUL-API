<?php
    class DBconfig 
    {
        // Database Information
        private const DBHOST = 'localhost';
        private const DBUSER = 'root';
        private const DBPASS = '';
        private const DBNAME = 'fos';

        // Data source network
        private $dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME . '';

        // Connection variable
        protected $conn = null;

        // Constructor
        public function __construct() 
        {
            try 
            {
                $this->conn = new PDO($this->dsn, self::DBUSER, self::DBPASS);
	            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) 
            {
                die('Connection failed : ' . $e->getMessage());
            }
            return $this->conn;
        }
    }
?>