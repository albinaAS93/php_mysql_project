<?php
include_once 'City.php';

    class Flight {

        private $connection;

        private $table_name = "flight";
        public $Id;
        public $departure;
        public $arrival;
        public $seats;

        function __construct($db) {
            $this->connection = $db;
        }

        function read() {

            $query =  "SELECT Id, c1.name as departure, c2.name as arrival, seats 
                FROM " . $this->table_name . 
                "LEFT JOIN city c1 ON c1.id = departure
                LEFT JOIN city c2 ON c2.id = arrival
                ORDER BY seats ASC
            ;";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        function selectByCity(array $data) {

            $query =  "SELECT flight.id, c1.name as departure, c2.name as arrival, flight.seats
                FROM flight
                LEFT JOIN city c1 ON c1.id = flight.departure
                LEFT JOIN city c2 ON c2.id = flight.arrival
                WHERE c1.name = :name OR c2.name = :name
            ;";

            $stmt = $this->connection->getConnection()->prepare($query);
            $param = array('name' => $data['name']);

            if ($stmt->execute($param)) {
                $rows = array();
                while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $rows[] = $row;
                }
                return $rows;
            }
            else {
                return false;
            }
        }

        function selectBySeats(array $data) {

            $query = "SELECT flight.id, c1.name as departure, c2.name as arrival, flight.seats
                FROM flight
                LEFT JOIN city c1 ON c1.id = flight.departure
                LEFT JOIN city c2 ON c2.id = flight.arrival
                HAVING flight.seats >= :seats
            ;";

            $stmt = $this->connection->getConnection()->prepare($query);
            $param = array('seats' => $data['seats']);

            if ($stmt->execute($param)) {
                $rows = array();
                while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $rows[] = $row;
                }
                return $rows;
            }
            else {
                return false;
            }
        }

        function create(array $data) {

            $query = "INSERT INTO flight (departure, arrival, seats) 
                VALUES (:departure, :arrival, :seats)
            ";

            $stmt = $this->connection->getConnection()->prepare($query);
            $param = array(
                'departure' => $data['departure'],
                'arrival' => $data['arrival'],
                'seats' => $data['seats']
            );

            if ($stmt->execute($param)) {
                return true;
            }
        }

        function update(array $data) {

            $query = "UPDATE flight 
                SET seats = :seats 
                WHERE id = :id
            ";
                
            $stmt = $this->connection->getConnection()->prepare($query);
            $param = array('id' => $data['id'], 'seats' => $data['seats']);

            if ($stmt->execute($param)) {
                return true;
            }
        }

        function delete(array $data) {

            $query = "DELETE FROM flight WHERE id = :id";

            $stmt = $this->connection->getConnection()->prepare($query);
            $param = array('id' => $data['id']);

            if ($stmt->execute($param)) {
                return true;
            }
        }
    }

?>