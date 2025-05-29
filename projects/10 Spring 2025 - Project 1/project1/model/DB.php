<?php
    class DB {
        private $dbh;

        function __construct() {
            try {
    
                $this->dbh = new PDO(
                    "mysql:host=" . 'localhost' . ";dbname=" . 'ec7233', 
                    'ec7233', 
                    'Resound3!terrorist'
                );
                $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Bad Database");
            }
        }//construct

        function getConn() {
            return $this->dbh;
        }
    }
?>