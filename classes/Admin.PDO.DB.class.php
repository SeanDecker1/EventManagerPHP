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

        //*********************************************
        // BEGINS DATABASE GET ALLS 
        //*********************************************

        // Function to return all attendee objects from the database
        function getAttendeeObjects() {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT attendee.idattendee, attendee.name, attendee.password, role.name
                    FROM attendee
                    JOIN role
                    ON attendee.role = role.idrole
                " );
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

        // Function to return all venue objects from the database
        function getVenueObjects() {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT idvenue, name, capacity
                    FROM venue
                " );
                $stmt->execute();

                while ( $venue = $stmt->fetch() ) {
                    $data[] = $venue;
                }

                return $data;

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends getVenueObjects

        // Function to return all event objects from the database
        function getEventObjects() {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT event.idevent, event.name, DATE_FORMAT(datestart, '%M %D, %Y at %h:%i %p'),
                    DATE_FORMAT(dateend, '%M %D, %Y at %h:%i %p'), event.numberallowed, venue.name, manager_event.manager 
                    FROM event
                    JOIN venue
                    ON event.venue = venue.idvenue
                    JOIN manager_event
                    ON event.idevent = manager_event.event
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

        // Function to return all session objects from the database
        function getSessionObjects() {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT session.idsession, session.name, session.numberallowed, event.name,
                    DATE_FORMAT(startdate, '%M %D, %Y at %h:%i %p'), DATE_FORMAT(enddate, '%M %D, %Y at %h:%i %p'), manager_event.manager 
                    FROM session
                    JOIN event
                    ON session.event = event.idevent
                    JOIN manager_event
                    ON event.idevent = manager_event.event
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

        } // Ends getSessionObjects

        //*********************************************
        // ENDS DATABASE GET ALLS
        // BEGINS DATABASE GET INDIVIDUALS 
        //*********************************************

        // Function to get info for one attendee
        function getAttendee( $inputID ) {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT idattendee, name, password, role
                    FROM attendee
                    WHERE idattendee = {$inputID}
                " );
                $stmt->execute();

                while ( $attendee = $stmt->fetch() ) {
                    $data[] = $attendee;
                }

                return $data;

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends getAttendee

        // Function to get info for one venue
        function getVenue( $inputID ) {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT idvenue, name, capacity
                    FROM venue
                    WHERE idvenue = {$inputID}
                " );
                $stmt->execute();

                while ( $venue = $stmt->fetch() ) {
                    $data[] = $venue;
                }

                return $data;

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends getVenue

        // Function to get info for one event
        function getEvent( $inputID ) {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT idevent, name, datestart, dateend, numberallowed, venue
                    FROM event
                    WHERE idevent = {$inputID}
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

        } // Ends getEvent

        // Function to get info for one session
        function getSession( $inputID ) {

            // Executes query
            try {

                $data = array();
                $stmt = $this->dbh->prepare( "
                    SELECT idsession, name, numberallowed, event, startdate, enddate
                    FROM session
                    WHERE idsession = {$inputID}
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

        } // Ends getSession

        //*********************************************
        // ENDS DATABASE GET INDIVIDUALS
        // BEGINS DATABASE UPDATES 
        //*********************************************

        // Function to update info for one attendee
        function updateAttendee( $updateID, $updateName, $updatePassword, $updateRole ) {

            // Executes query
            try {

                $stmt = $this->dbh->prepare( "  
                                                UPDATE attendee 
                                                SET name = '{$updateName}', password = '{$updatePassword}', role = {$updateRole} 
                                                WHERE( idattendee = {$updateID} )
                                            " );

                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends updateAttendee

        // Function to update info for one venue
        function updateVenue( $updateID, $updateName, $updateCapacity ) {

            // Executes query
            try {

                $stmt = $this->dbh->prepare( "  
                                                UPDATE venue 
                                                SET name = '{$updateName}', capacity = {$updateCapacity} 
                                                WHERE( idvenue = {$updateID} )
                                            " );

                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends updateVenue

        // Function to update info for one event 
        function updateEvent( $updateID, $updateName, $updateStart, $updateEnd, $updateAllowed, $updateVenue ) {

            // Executes query
            try {

                $stmt = $this->dbh->prepare( "  
                                                UPDATE event 
                                                SET name = '{$updateName}', datestart = '{$updateStart}', dateend = '{$updateEnd}',
                                                numberallowed = {$updateAllowed}, venue = {$updateVenue} 
                                                WHERE( idevent = {$updateID} )
                                            " );

                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends updateEvent

        // Function to update info for one session 
        function updateSession( $updateID, $updateName, $updateAllowed, $updateEvent, $updateStart, $updateEnd ) {

            // Executes query
            try {

                $stmt = $this->dbh->prepare( "  
                                                UPDATE session 
                                                SET name = '{$updateName}', startdate = '{$updateStart}', enddate = '{$updateEnd}',
                                                numberallowed = {$updateAllowed}, event = {$updateEvent} 
                                                WHERE( idsession = {$updateID} )
                                            " );

                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends updateSession

        //*********************************************
        // ENDS DATABASE UPDATES
        // BEGINS DATABASE INSERTS 
        //*********************************************

        // Function to update info for one attendee
        function addAttendee( $addName, $addPassword, $addRole ) {

            // Executes query
            try {

                $stmt = $this->dbh->prepare("
                    INSERT INTO attendee 
                    ( name, password, role ) 
                    VALUES( '{$addName}', '{$addPassword}', {$addRole} )
                ");

                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends addAttendee

        // Function to update info for one venue
        function addVenue( $addName, $addCapacity ) {

            // Executes query
            try {

                $stmt = $this->dbh->prepare("
                    INSERT INTO venue 
                    ( name, capacity ) 
                    VALUES( '{$addName}', {$addCapacity} )
                ");

                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends addVenue

        // Function to update info for one event
        function addEvent( $addName, $addStart, $addEnd, $addAllowed, $addVenue ) {

            // Executes query
            try {

                $stmt = $this->dbh->prepare("
                    INSERT INTO event 
                    ( name, datestart, dateend, numberallowed, venue ) 
                    VALUES( '{$addName}', '{$addStart}', '{$addEnd}', {$addAllowed}, {$addVenue} )
                ");

                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends addEvent

        // Function to update info for one session
        function addSession( $addName, $addStart, $addEnd, $addAllowed, $addEvent ) {

            // Executes query
            try {

                $stmt = $this->dbh->prepare("
                    INSERT INTO session 
                    ( name, startdate, enddate, numberallowed, event ) 
                    VALUES( '{$addName}', '{$addStart}', '{$addEnd}', {$addAllowed}, {$addEvent} )
                ");

                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends addSession

        //*********************************************
        // ENDS DATABASE INSERTS
        // BEGINS DATABASE DELETIONS 
        //*********************************************

        // Function to delete a record from attendee 
        Function deleteAttendee( $deleteID ) {

            // Executes DELETE query
            try {

                $stmt = $this->dbh->prepare("
                    DELETE FROM attendee
                    WHERE( idattendee = {$deleteID} )
                ");
                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends deleteAttendee

        // Function to delete a record from venue 
        Function deleteVenue( $deleteID ) {

            // Executes DELETE query
            try {

                $stmt = $this->dbh->prepare("
                    DELETE FROM venue
                    WHERE( idvenue = {$deleteID} )
                ");
                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends deleteVenue

        // Function to delete a record from event 
        Function deleteEvent( $deleteID ) {

            // Executes DELETE query
            try {

                $stmt = $this->dbh->prepare("
                    DELETE FROM event
                    WHERE( idevent = {$deleteID} )
                ");
                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends deleteEvent

        // Function to delete a record from session 
        Function deleteSession( $deleteID ) {

            // Executes DELETE query
            try {

                $stmt = $this->dbh->prepare("
                    DELETE FROM session
                    WHERE( idsession = {$deleteID} )
                ");
                $stmt->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            } // Ends try catch

        } // Ends deleteSession

    } // Ends class