<?php
    $_SESSION['loggedIn'] = false;
    session_unset();
    session_destroy();
    header("Location: {$path}index.php");
?>