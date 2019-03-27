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

        // Function to return all attendee objects from the database
        function getAttendeeObjects() {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "SELECT * FROM attendee" );
                $stmt->execute();

                while ( $attendee = $stmt->fetch() ) {
                    $data[] = $attendee;
                }

                return $data;

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends getAttendeeObjects

        // Function to check if the user entered valid login information
        function checkLogin( $userName, $userPassword ) {

            // Executes SELECT query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                                                SELECT * FROM attendee
                                                WHERE (name LIKE '{$userName}')
                                                AND (password LIKE '{$userPassword}')
                                            " );
                $stmt->execute();

                while ( $attendee = $stmt->fetch() ) {
                   $data[] = $attendee;
                }

                if ( !empty($data) ) {
                    return 1;
                } else if ( empty($data) ) {
                    return 0;
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends checkLogin

        // Function to return the user's ID
        function getAttendeeID( $userName ) {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT idattendee 
                    FROM attendee
                    WHERE name 
                    LIKE '{$userName}' 
                " );
                $stmt->execute();
                $data = $stmt->fetchColumn();

                return $data;

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends getAttendeeID

        // Function to return the user's role
        function getAttendeeRole( $userID ) {

            // Executes query
            try {

                $stmt = $this->dbh->prepare( "
                    SELECT role 
                    FROM attendee
                    WHERE idattendee = {$userID}    
                " );
                $stmt->execute();
                $data = $stmt->fetchColumn();

                return $data;

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends getAttendeeRole

    } // Ends class