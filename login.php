
    <div class="col-sm-1"></div> 

    <div class="col-sm-10">
        <h1 class="centerHeader">Login</h1>

        <?php

            require_once "classes/Attendee.PDO.DB.class.php";
            require_once "classes/CleanInput.class.php";

            $db = new DB();
            $ci = new CleanInput();
            $loginStatus = 6;
            
            if ( isset( $_POST['name'] ) and isset( $_POST['password'] ) ) {
                
                foreach($_POST as $key => $value) {
                    $key = ( $ci->validateAndSanitize( $value ) );
                }

                $loginStatus = $db->checkLogin( $_POST['name'], $_POST['password'] );
            }
            
            if ( $loginStatus == 1 ) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['userID'] = $db->getAttendeeID( $_POST['name'] );
                $_SESSION['userPermissions'] = $db->getAttendeeRole( $_SESSION['userID'] );
                header("Location: {$path}events/index.php");
            } else {
                $_SESSION['loggedIn'] = false;
            }

        ?>

        <!--- Begins the form to login the user --->
        <form name="loginForm" action="" method="post">

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="name" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" id="loginButton" class="btn blueButton">Login</button>

            <hr/>

        </form>
        <!--- Ends the form to login the user --->

    </div>

    <div class="col-sm-1"></div> 