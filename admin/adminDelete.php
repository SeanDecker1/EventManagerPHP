<?php
	$page = 'Admin Page';
    $path='../';
	include($path.'../Project1/header.php');
?>

<?php

    // Checks to see if the user is logged in  
    if ( isset( $_SESSION['loggedIn'] ) and ( $_SESSION['loggedIn'] == false ) ) {
		header("Location: {$path}index.php");
	}

	require_once "{$path}classes/Admin.PDO.DB.class.php";
	$db = new DB();

	if ( isset( $_GET['id'] ) and isset( $_GET['table'] ) ) {
		$selectID = $_GET['id'];
		$selectTable = $_GET['table'];
	}

	// Checks which table to delete from
	if ( isset( $selectTable ) and $selectTable == "attendee" ) {

		// Deletes the record and relocates
		$db->deleteAttendee( $selectID );
		header("Location: {$path}admin/index.php");

	} else if ( isset( $selectTable ) and $selectTable == "venue" ) {

		// Deletes the record and relocates
		$db->deleteVenue( $selectID );
		header("Location: {$path}admin/index.php");

	} else if ( isset( $selectTable ) and $selectTable == "event" ) {

		// Deletes the record and relocates
		$db->deleteEvent( $selectID );
		header("Location: {$path}admin/index.php");

	} else if ( isset( $selectTable ) and $selectTable == "session" ) {

		// Deletes the record and relocates
		$db->deleteSession( $selectID );
		header("Location: {$path}admin/index.php");

	}

?>

<?php
	include ($path.'../Project1/footer.php');
?>