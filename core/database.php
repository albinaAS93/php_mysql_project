<?php

    class Database
    {
        protected $config;
        protected $connection;

        public function __construct(Array $config) {

            $this->config = $config;
            
        }

        public function getConnection() 
        {
            try {

                if (is_null($this->connection)) {
                    return $this->connection = new PDO(
                        $this->config['connection'] . ';dbname=' . $this->config['dbname'],
                        $this->config['username'],
                        $this->config['password'],
                        $this->config['options']
                    );
                } 

                return $this->connection;


            } catch(PDOException $e) {
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->connection;
        }
    }
