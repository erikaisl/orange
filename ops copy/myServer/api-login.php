<?php
    /* LOGIN */

    session_start();

    /* Gets data from login form via url*/
    header('Access-Control-Allow-Origin: *');
   
    $sUsername = $_GET['username']; // extracts from url.
    $sPassword = $_GET['password']; // extracts from url

    /* Checks data against that data in the database (data-users.txt) */
    $sFileName = "data-users.txt";

    
    $sajUsers = file_get_contents( $sFileName ); //gets the content of the file into a string.
    
    $ajUsers = json_decode( $sajUsers ); //turns the string it into an array.
    if( !is_array($ajUsers ) ){ //checks the arrays validity.
        $ajUsers = []; // if its not valid then replaces the file with an empty array.
    }

    $match = False; 

    //Next we loop through the array and check to see if the login credentials match.
    for( $i = 0; $i < count($ajUsers) ; $i++ ){
        if( $sUsername == $ajUsers[$i]->sUsername &&  $sPassword == $ajUsers[$i]->sPassword){ //checks if the value of the username is equal to the value in the array.
             $match = True;
        } 
    }

    $_SESSION['currentUser'] = $sUsername; 

    if($match) {
        echo '{"status":"match"}'; 
    } else {
        echo '{"status":"nomatch"}';
    }
?>