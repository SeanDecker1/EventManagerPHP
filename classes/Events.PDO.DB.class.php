<?php

    class DB {

        private $dbh;

        // Connects to the database
        function __construct() {

            try {

                $this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}",$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD']);

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends constuctor

        // Function to return all event objects from the database
        function getEventObjects() {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT event.idevent, event.name, venue.name 
                    FROM event
                    JOIN venue
                    ON event.venue = idvenue
                " );
                $stmt->execute();

                while ( $event = $stmt->fetch() ) {
                    $data[] = $event;
                }

                return $data;

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends getEventObjects

        // Function to return all event sessions from the database
        function getEventSessions( $eventID ) {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT name,DATE_FORMAT(startdate, '%M %D, %Y'), DATE_FORMAT(startdate, '%h:%i %p'), DATE_FORMAT(enddate, '%h:%i %p')
                    FROM session
                    WHERE event = {$eventID}
                " );
                $stmt->execute();

                while ( $session = $stmt->fetch() ) {
                    $data[] = $session;
                }

                return $data;

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends getEventObjects

    } // Ends class