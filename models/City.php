<?php

    class City {

        private $connection;

        private $table_name = "city";
        public $Id;
        public $Name;

        public function __construct($db) {
            $this->connection = $db;
        }

        function read() {

            $query = "SELECT Id, Name FROM " . $this->table_name;
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        function create(array $data) {

            $query = "INSERT INTO" . $this->table_name . "VALUES Name=:name";
            $stmt = $this->connection->getConnection()->prepare($query);
            $param = array('name' => $data['Name']);

            if ($stmt->execute($param)) {
                return true;
            }
            return false;
        }

        function update(array $data) {

            $query = "UPDATE" . $this->table_name . "SET Name = :name WHERE Id = :id";
            $stmt = $this->connection->getConnection()->prepare($query);
            $param = array('id' => $data['id'], 'name' => $data['name']);

            if ($stmt->execute($param)) {
                return true;
            }
            return false;
        }

        function delete(array $data) {

            $query = "DELETE FROM " . $this->table_name . "WHERE Id = ?";
            $stmt = $this->connection->prepare($query);
            $param = array('id' => $data['id']);

            if($stmt->execute($param)) {
                return true;
            }
            return false;
        }
    }

?>