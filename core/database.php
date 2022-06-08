<?php

    class Database
    {
        public $connection;

        public function getConnection($config)
        {
            try {
                $this->connection = new PDO(
                    $config['connection'] . ';dbname=' . $config['name'],
                    $config['username'],
                    $config['password'],
                    $config['options']
                );
            } catch(PDOException $e) {
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->connection;
        }
    }

?>