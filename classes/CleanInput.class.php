<?php 

    class CleanInput {

        function validateAndSanitize( $data ) {
            $data = trim( $data );
            $data = stripslashes( $data );
            $data = strip_tags( $data );
            $data = htmlspecialchars( $data );
            return $data;
        } // Ends validateAndSanitize

    } // Ends class

?>