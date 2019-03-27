<?php 

    // Checks to see if the user is logged in  
    if ( isset( $_SESSION['loggedIn'] ) and ( $_SESSION['loggedIn'] == false ) ) {
		    header("Location: {$path}index.php");
    }

    require_once "{$path}classes/Admin.PDO.DB.class.php";
    $db = new DB();

?>

    <h1 class="centerHeader">Admin</h1>
    <hr />
        
    <div class='col-sm-1'></div> 
    <div class="col-sm-10 list-group text-center">

<?php
    // Checks if the current user has admin permissions
    if ( isset( $_SESSION['userPermissions'] ) and $_SESSION['userPermissions'] == 1 ) {
?>   

        <!--- BEGIN DISPLAY ALL ATTENDEE INFO --->
        <h2>Users</h2>

        <?php

            // Returns information for all attendee records
            $attendeeData = $db->getAttendeeObjects();

            // Loops through all attendee records
            for ( $i = 0; $i <= count($attendeeData) - 1; $i++ ) {
                
                // Displays all attendee information
                echo "
                    <div class='list-group-item postContainer text-center'>
                        <p><b>{$attendeeData[$i][1]}</b></p>
                        <p>Password: {$attendeeData[$i][2]}</p> 
                        <p>Role: {$attendeeData[$i][3]}</p>
                        
                        <a href='adminDelete.php?id={$attendeeData[$i][0]}&table=attendee' class='btn redButton'>Delete</a>    
                        <a href='adminEdit.php?id={$attendeeData[$i][0]}&table=attendee' class='btn greenButton'>Edit</a>
                    </div>
                ";

            } // Ends attendeeData for loop

        ?>

        <a href='adminAdd.php?table=attendee' class='btn blueButton'>Add User</a>
        <!--- END DISPLAY ALL ATTENDEE INFO --->

        <hr />

        <!--- BEGIN DISPLAY ALL VENUE INFO --->
        <h2>Venues</h2>

        <?php

            // Returns information for all venue records
            $venueData = $db->getVenueObjects();

            // Loops through all venue records
            for ( $i = 0; $i <= count($venueData) - 1; $i++ ) {
                
                // Displays all venue information
                echo "
                    <div class='list-group-item postContainer text-center'>
                        <p><b>{$venueData[$i][1]}</b></p>
                        <p>Capacity: {$venueData[$i][2]}</p>
                        
                        <a href='adminDelete.php?id={$venueData[$i][0]}&table=venue' class='btn redButton'>Delete</a>    
                        <a href='adminEdit.php?id={$venueData[$i][0]}&table=venue' class='btn greenButton'>Edit</a>
                    </div>
                ";

            } // Ends venueData for loop

        ?>

        <a href='adminAdd.php?table=venue' class='btn blueButton'>Add Venue</a>
        <!--- END DISPLAY ALL VENUE INFO --->

        <hr />

<?php
    } // Ends admin if
    // Checks if the current user has admin or event manager permissions
    if ( isset( $_SESSION['userPermissions'] ) and ( ( $_SESSION['userPermissions'] == 1 ) or ( $_SESSION['userPermissions'] == 2 ) ) ) {
?>

        <!--- BEGIN DISPLAY ALL EVENT INFO --->
        <h2>Events</h2>

        <?php

            // Returns information for all event records
            $eventData = $db->getEventObjects();

            // Loops through all event records
            for ( $i = 0; $i <= count($eventData) - 1; $i++ ) {
                
                // Displays all event information
                echo "
                    <div class='list-group-item postContainer text-center'>
                        <p><b>{$eventData[$i][1]}</b></p>
                        <p>Start: {$eventData[$i][2]}</p>
                        <p>End: {$eventData[$i][3]}</p>
                        <p>Allowed: {$eventData[$i][4]}</p>
                        <p>Venue: {$eventData[$i][5]}</p>
                ";

                if ( ( $_SESSION['userPermissions'] == 1 ) or ( $eventData[$i][6] == $_SESSION['userID'] ) ) {
        
                    echo "
                        <a href='adminDelete.php?id={$eventData[$i][0]}&table=event' class='btn redButton'>Delete</a>    
                        <a href='adminEdit.php?id={$eventData[$i][0]}&table=event' class='btn greenButton'>Edit</a>
                    ";

                }

                echo "
                    </div>
                ";

            } // Ends eventData for loop

        ?>

        <a href='adminAdd.php?table=event' class='btn blueButton'>Add Event</a>
        <!--- END DISPLAY ALL EVENT INFO --->

        <hr />

        <!--- BEGIN DISPLAY ALL SESSION INFO --->
        <h2>Sessions</h2>

        <?php

            // Returns information for all session records
            $sessionData = $db->getSessionObjects();

            // Loops through all session records
            for ( $i = 0; $i <= count($sessionData) - 1; $i++ ) {
                
                // Displays all session information
                echo "
                    <div class='list-group-item postContainer text-center'>
                        <p><b>{$sessionData[$i][1]}</b></p>
                        <p>Allowed: {$sessionData[$i][2]}</p>
                        <p>Event: {$sessionData[$i][3]}</p>
                        <p>Start: {$sessionData[$i][4]}</p>
                        <p>End: {$sessionData[$i][5]}</p>
                ";

                if ( ( $_SESSION['userPermissions'] == 1 ) or ( $sessionData[$i][6] == $_SESSION['userID'] ) ) {
                    echo "
                        <a href='adminDelete.php?id={$sessionData[$i][0]}&table=session' class='btn redButton'>Delete</a>    
                        <a href='adminEdit.php?id={$sessionData[$i][0]}&table=session' class='btn greenButton'>Edit</a>
                    ";
                }

                echo "
                    </div>
                ";

            } // Ends sessionData for loop

        ?>

        <a href='adminAdd.php?table=session' class='btn blueButton'>Add Session</a>
        <!--- END DISPLAY ALL SESSION INFO --->

    </div>
    <div class='col-sm-1'></div> 

<?php 
    } // Ends admin and event manager if
    if ( isset( $_SESSION['userPermissions'] ) and $_SESSION['userPermissions'] == 3 ) {
        echo "<h1>You do not have permissions to use this page</h1>";
    } // Ends attendee if
?>