<?php
	header('Access-Control-Allow-Origin: *');
	$sFileName = "data-users.txt";
    

    $sajUsers = file_get_contents( $sFileName ); //gets the content of the file into a string.
    $ajUsers = json_decode( $sajUsers ); //turns the string it into an array.
    
    if( !is_array($ajUsers ) ){ //checks the arrays validity.
        $ajUsers = []; // if its not valid then replaces the file with an empty array.
    }

    // SUCCESS
    // $sajProperties = json_encode( $ajProperties , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    //$sajUsers = json_encode( $ajUsers , JSON_UNESCAPED_UNICODE );
    

    echo $sajUsers;
?>