<?php 
    if ( isset( $_SESSION['loggedIn'] ) and ( $_SESSION['loggedIn'] == false ) ) {
		header("Location: {$path}index.php");
    }
?>

<h1>Registration</h1>