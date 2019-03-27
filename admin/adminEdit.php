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

	// Checks to see if attendee is being updated
	if ( isset( $_POST['updateAttendee'] ) ) {

		// Sanitizes all input data
		foreach($_POST as $key => $value) {
			$value = ( $ci->validateAndSanitize( $value ) );
		}

		// Updates record and relocates
		$db->updateAttendee( $_POST['id'], $_POST['name'], $_POST['password'], $_POST['role'] );
		header("Location: {$path}admin/index.php");

	}

	// Checks to see if venue is being updated
	if ( isset( $_POST['updateVenue'] ) ) {

		// Sanitizes all input data
		foreach($_POST as $key => $value) {
			$value = ( $ci->validateAndSanitize( $value ) );
		}

		// Updates record and relocates
		$db->updateVenue( $_POST['id'], $_POST['name'], $_POST['capacity'] );
		header("Location: {$path}admin/index.php");

	}

	// Checks to see if event is being updated
	if ( isset( $_POST['updateEvent'] ) ) {

		// Sanitizes all input data
		foreach($_POST as $key => $value) {
			$value = ( $ci->validateAndSanitize( $value ) );
		}

		// Updates record and relocates
		$db->updateEvent( $_POST['id'], $_POST['name'], $_POST['start'], $_POST['end'], $_POST['allowed'], $_POST['venue'] );
		header("Location: {$path}admin/index.php");

	}

	// Checks to see if session is being updated
	if ( isset( $_POST['updateSession'] ) ) {

		// Sanitizes all input data
		foreach($_POST as $key => $value) {
			$value = ( $ci->validateAndSanitize( $value ) );
		}

		// Updates record and relocates
		$db->updateSession( $_POST['id'], $_POST['name'], $_POST['allowed'], $_POST['event'], $_POST['start'], $_POST['end'] );
		header("Location: {$path}admin/index.php");

	}

?>

<?php

	if ( isset( $_GET['id'] ) and isset( $_GET['table'] ) ) {
		$selectID = $_GET['id'];
		$selectTable = $_GET['table'];
	}

	// DISPLAYS WHEN EDITING ATTENDEE RECORD
	if ( isset( $selectTable ) and ( $selectTable == "attendee" ) ) {
		
		$attendeeData = $db->getAttendee( $selectID );
?>

		<!--- Begins the form to edit attendee --->
        <form name="attendeeForm" action="" method="post">
			<input type="hidden" name="id" value="<?php echo $attendeeData[0][0]; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $attendeeData[0][1]; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" class="form-control" id="password" name="password" value="<?php echo $attendeeData[0][2]; ?>" required>
			</div>
			<div class="form-group">
                <label for="role">Role:</label>
                <input type="text" class="form-control" id="role" name="role" value="<?php echo $attendeeData[0][3]; ?>" required>
			</div>
			<input type="hidden" name="updateAttendee" value="update">
            <button type="submit" id="updateButton" class="btn blueButton">Update</button>
        </form>
        <!--- Ends the form to edit attendee --->

<?php
	} else if ( isset( $selectTable ) and ( $selectTable == "venue" ) ) {
		// DISPLAYS WHEN EDITING VENUE RECORD
		$venueData = $db->getVenue( $selectID );
?>

		<!--- Begins the form to edit venue --->
        <form name="venueForm" action="" method="post">
			<input type="hidden" name="id" value="<?php echo $venueData[0][0]; ?>">
            <div class="form-group">
                <label for="name">Venue Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $venueData[0][1]; ?>" required>
            </div>
            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo $venueData[0][2]; ?>" required>
			</div>
			<input type="hidden" name="updateVenue" value="update">
            <button type="submit" id="updateButton" class="btn blueButton">Update</button>
        </form>
        <!--- Ends the form to edit venue --->

<?php
	} else if ( isset( $selectTable ) and ( $selectTable == "event" ) ) {
		// DISPLAYS WHEN EDITING EVENT RECORD
		$eventData = $db->getEvent( $selectID );
?>

		<!--- Begins the form to edit event --->
        <form name="eventForm" action="" method="post">
			<input type="hidden" name="id" value="<?php echo $eventData[0][0]; ?>">
            <div class="form-group">
                <label for="name">Event Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $eventData[0][1]; ?>" required>
            </div>
            <div class="form-group">
                <label for="start">Start Date:</label>
                <input type="text" class="form-control" id="start" name="start" value="<?php echo $eventData[0][2]; ?>" required>
			</div>
			<div class="form-group">
                <label for="end">End Date:</label>
                <input type="text" class="form-control" id="end" name="end" value="<?php echo $eventData[0][3]; ?>" required>
			</div>
			<div class="form-group">
                <label for="allowed">Number Allowed:</label>
                <input type="number" class="form-control" id="allowed" name="allowed" value="<?php echo $eventData[0][4]; ?>" required>
			</div>
			<div class="form-group">
                <label for="venue">Venue:</label>
                <input type="number" class="form-control" id="venue" name="venue" value="<?php echo $eventData[0][5]; ?>" required>
			</div>
			<input type="hidden" name="updateEvent" value="update">
            <button type="submit" id="updateButton" class="btn blueButton">Update</button>
        </form>
        <!--- Ends the form to edit event --->

<?php
	} else if ( isset( $selectTable ) and ( $selectTable == "session" ) ) {
		// DISPLAYS WHEN EDITING SESSION RECORD
		$sessionData = $db->getSession( $selectID );
?>

		<!--- Begins the form to edit session --->
        <form name="sessionForm" action="" method="post">
			<input type="hidden" name="id" value="<?php echo $sessionData[0][0]; ?>">
            <div class="form-group">
                <label for="name">Session Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $sessionData[0][1]; ?>" required>
            </div>
            <div class="form-group">
                <label for="start">Start Date:</label>
                <input type="text" class="form-control" id="start" name="start" value="<?php echo $sessionData[0][5]; ?>" required>
			</div>
			<div class="form-group">
                <label for="end">End Date:</label>
                <input type="text" class="form-control" id="end" name="end" value="<?php echo $sessionData[0][4]; ?>" required>
			</div>
			<div class="form-group">
                <label for="allowed">Number Allowed:</label>
                <input type="number" class="form-control" id="allowed" name="allowed" value="<?php echo $sessionData[0][2]; ?>" required>
			</div>
			<div class="form-group">
                <label for="event">Event:</label>
                <input type="number" class="form-control" id="event" name="event" value="<?php echo $sessionData[0][3]; ?>" required>
			</div>
			<input type="hidden" name="updateSession" value="update">
            <button type="submit" id="updateButton" class="btn blueButton">Update</button>
        </form>
        <!--- Ends the form to edit session --->

<?php
	}
?>

<?php
	include ($path.'../Project1/footer.php');
?>