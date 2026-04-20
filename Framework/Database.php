<?php

namespace Framework;

use PDO;

class Database
{
    public $conn;

    /**
     * Constructor for Database class
     *
     * @param array $config The database configuration array
     */
    function __construct($db_config)
    {
        $dsn = 'pgsql:host=' . $db_config['host'] . ';port=' . $db_config['port'] . ';dbname=' . $db_config['dbname'];

        $attr_options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, $db_config['user'], $db_config['password'], $attr_options);
            // echo 'Db connection successful';
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Query the database.
     *
     * @param string $query The SQL query to execute
     *
     * @return PDOStatement The PDO statement object.
     * @throws Exception If query execution fails.
     */
    public function query($query, $params = [])
    {
        try {
            $sth = $this->conn->prepare($query);

            // Bind named parameters
            foreach ($params as $param => $value) {
                $sth->bindValue(':' . $param, $value);
            }

            $sth->execute();
            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Query execution failed: " . $e->getMessage());
        }
    }
}
