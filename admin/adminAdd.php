<?php

	$page = 'Admin Page';
    $path='../';
	include($path.'../Project1/header.php');

	// Checks to see if the user is logged in  
    if ( isset( $_SESSION['loggedIn'] ) and ( $_SESSION['loggedIn'] == false ) ) {
		header("Location: {$path}index.php");
	}

	require_once "{$path}classes/Admin.PDO.DB.class.php";
	require_once "{$path}classes/CleanInput.class.php";

	$db = new DB();
	$ci = new CleanInput();

	// Checks to see if record is being added to attendee
	if ( isset( $_POST['addAttendee'] ) ) {

		// Sanitizes all input data
		foreach($_POST as $key => $value) {
			$value = ( $ci->validateAndSanitize( $value ) );
		}

		// Adds the record and relocates
		$db->addAttendee( $_POST['name'], $_POST['password'], $_POST['role'] );
		header("Location: {$path}admin/index.php");

	}

	// Checks to see if record is being added to venue
	if ( isset( $_POST['addVenue'] ) ) {

		// Sanitizes all input data
		foreach($_POST as $key => $value) {
			$value = ( $ci->validateAndSanitize( $value ) );
		}

		// Adds the record and relocates
		$db->addVenue( $_POST['name'], $_POST['capacity'] );
		header("Location: {$path}admin/index.php");

	}

	// Checks to see if record is being added to event
	if ( isset( $_POST['addEvent'] ) ) {

		// Sanitizes all input data
		foreach($_POST as $key => $value) {
			$value = ( $ci->validateAndSanitize( $value ) );
		}

		// Adds the record and relocates
		$db->addEvent( $_POST['name'], $_POST['start'], $_POST['end'], $_POST['allowed'], $_POST['venue'] );
		header("Location: {$path}admin/index.php");

	}

	// Checks to see if record is being added to event
	if ( isset( $_POST['addSession'] ) ) {

		// Sanitizes all input data
		foreach($_POST as $key => $value) {
			$value = ( $ci->validateAndSanitize( $value ) );
		}

		// Adds the record and relocates
		$db->addSession( $_POST['name'], $_POST['start'], $_POST['end'], $_POST['allowed'], $_POST['event'] );
		header("Location: {$path}admin/index.php");

	}
?>

<?php
    
	if ( isset( $_GET['table'] ) ) {
		$selectTable = $_GET['table'];
	}

	// Displays if the record is in the attendee table
	if ( $selectTable == "attendee" ) {
?>

		<!--- Begins the form to add attendee --->
        <form name="attendeeForm" action="" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" class="form-control" id="password" name="password" required>
			</div>
			<div class="form-group">
                <label for="role">Role:</label>
                <input type="text" class="form-control" id="role" name="role" required>
			</div>
			<input type="hidden" name="addAttendee" value="add">
            <button type="submit" id="addButton" class="btn blueButton">Add</button>
        </form>
        <!--- Ends the form to add attendee --->

<?php
	} else if ( $selectTable == "venue" ) {
?>

		<!--- Begins the form to add venue --->
		<form name="venueForm" action="" method="post">
            <div class="form-group">
                <label for="name">Venue Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="number" class="form-control" id="capacity" name="capacity" required>
			</div>
			<input type="hidden" name="addVenue" value="add">
            <button type="submit" id="addButton" class="btn blueButton">Add</button>
        </form>
        <!--- Ends the form to add venue --->

<?php
	} else if ( $selectTable == "event" ) {
?>

		<!--- Begins the form to add event --->
		<form name="eventForm" action="" method="post">
			<div class="form-group">
				<label for="name">Event Name:</label>
				<input type="text" class="form-control" id="name" name="name" required>
			</div>
			<div class="form-group">
                <label for="start">Start Date:</label>
                <input type="text" class="form-control" id="start" name="start" required>
			</div>
			<div class="form-group">
                <label for="end">End Date:</label>
                <input type="text" class="form-control" id="end" name="end" required>
			</div>
			<div class="form-group">
                <label for="allowed">Number Allowed:</label>
                <input type="number" class="form-control" id="allowed" name="allowed" required>
			</div>
			<div class="form-group">
                <label for="venue">Venue:</label>
                <input type="number" class="form-control" id="venue" name="venue" required>
			</div>
			<input type="hidden" name="addEvent" value="add">
			<button type="submit" id="addButton" class="btn blueButton">Add</button>
		</form>
		<!--- Ends the form to add event --->

<?php
	} else if ( $selectTable == "session" ) {
?>
		
		<!--- Begins the form to add session --->
		<form name="sessionForm" action="" method="post">
			<div class="form-group">
				<label for="name">Session Name:</label>
				<input type="text" class="form-control" id="name" name="name" required>
			</div>
			<div class="form-group">
				<label for="start">Start Date:</label>
				<input type="text" class="form-control" id="start" name="start" required>
			</div>
			<div class="form-group">
				<label for="end">End Date:</label>
				<input type="text" class="form-control" id="end" name="end" required>
			</div>
			<div class="form-group">
				<label for="allowed">Number Allowed:</label>
				<input type="number" class="form-control" id="allowed" name="allowed" required>
			</div>
			<div class="form-group">
				<label for="event">Event:</label>
				<input type="number" class="form-control" id="event" name="event" required>
			</div>
			<input type="hidden" name="addSession" value="add">
			<button type="submit" id="addButton" class="btn blueButton">Add</button>
		</form>
		<!--- Ends the form to add session --->

<?php
	}		
?>

<?php
	include ($path.'../Project1/footer.php');
?>