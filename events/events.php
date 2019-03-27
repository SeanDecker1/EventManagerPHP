<?php 

    // Checks to see if the user is logged in
    if ( isset( $_SESSION['loggedIn'] ) and ( $_SESSION['loggedIn'] == false ) ) {
		    header("Location: {$path}index.php");
    }

    require_once "{$path}classes/Events.PDO.DB.class.php";
    $db = new DB();

?>

    <h1 class="centerHeader">Events</h1>

    <!--- Begins container that displays all event information --->
    <div class='col-sm-1'></div> 
    <div class="col-sm-10 list-group">
        <?php

            // Returns information for all event records
            $eventData = $db->getEventObjects();

            // Loops through all event records
            for ( $i = 0; $i <= count($eventData) - 1; $i++ ) {

                // Returns all session information for the specified event
                $eventSessions = $db->getEventSessions( $eventData[$i][0] );
                
                // Displays the name of the event
                echo "
                    <div class='list-group-item postContainer'>
                        <h3><b>{$eventData[$i][1]}</b></h3>
                        <h3>Sessions:</h3> 
                ";

                // Loops through all sessions and displays the session name, date, and time
                for ( $j = 0; $j <= count($eventSessions) - 1; $j++ ) {
                    echo "<p>{$eventSessions[$j][0]} 
                        on {$eventSessions[$j][1]} 
                        from {$eventSessions[$j][2]} 
                        to {$eventSessions[$j][3]}</p>";
                } // Ends eventSessions for loop

                // Displays the name of the venue 
                echo "
                        <h3>{$eventData[$i][2]}<h3>
                    </div>
                ";

            } // Ends eventData for loop

        ?>
    </div>
    <div class='col-sm-1'></div> 
    <!--- Ends container that displays all event information --->