<?php

namespace Framework;

use PDO;

class Database
{
    public $conn;

    /**
     * Constractor for Database class
     * 
     * @param array $config
     */

    public function __construct($config)
    {
        // PostgreSQL (Supabase) DSN
        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
            // echo 'Connected';
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }

    /**
     * Query the database
     * 
     * @param string $query
     * 
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($query, $params = [])
    {
        try {
            $sth = $this->conn->prepare($query);

            // Bind named params
            foreach ($params as $param => $value) {

                // Convert PHP array → Postgres array literal
                if (is_array($value)) {
                    $value = '{' . implode(',', array_map(
                        fn($v) => '"' . str_replace('"', '\"', $v) . '"',
                        $value
                    )) . '}';
                }

                $sth->bindValue(':' . $param, $value);
            }

            $sth->execute();
            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Quer failed to execute: {$e->getMessage()}");
        }
    }
}
