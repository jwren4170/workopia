<?php

class Database
{
    public $conn;

    /**
     * Constructor for Database class
     *
     * @param array $config
     * 
     */
    public function __construct(array $config)
    {
        $dsn = 'mysql:host=' . $config['host'] . ';port=' . $config['port'] .
            ';dbname=' . $config['dbname'];

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
            // var_dump('Connection successful');
        } catch (PDOException $e) {
            inspect_and_die('Connection failed' . $e->getMessage());
        }
    }

    /**
     * Method excepts a mysql query statement
     *
     * @param string $query
     * @param array $params
     * 
     * @return PDOStatement
     * @throws PDOException 
     */
    public function query(string $query, array $params = []): PDOStatement
    {
        try {
            $stmt = $this->conn->prepare($query);
            // Bind named parameters
            foreach ($params as $param => $value) {
                $stmt->bindParam(':' . $param, $value);
            }

            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException('Query failed to execute' . $e->getMessage());
        }
    }
}