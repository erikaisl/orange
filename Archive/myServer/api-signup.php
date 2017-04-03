<?php
/*SIGN UP */
    header('Access-Control-Allow-Origin: *');
    
    session_start();

    $sUsername = $_POST['signUpUsername']; // extracts from url
    $sPassword = $_POST['signUpPassword']; // extracts from url

    $sFileName = "data-users.txt"; //stores variable

    $sajUsers = file_get_contents( $sFileName ); //gets the content of the file into a string.
    $ajUsers = json_decode( $sajUsers ); //turns the string it into an array.
    if( !is_array( $ajUsers ) ){ //checks the arrays validity.
        $ajUsers = []; // if its not valid then replaces the file with an empty array.
    }

    //$match = False; 

    // Loop through the array to see if someone with that name already exists.
    for( $i = 0; $i < count($ajUsers) ; $i++ ){
        if( $sUsername == $ajUsers[$i]->sUsername){ //checks if the value of the username is equal to the value in the array.
             //$match = True;
            echo '{"status":"Username taken"}';
            exit();
        } 
    }

    // If user already exists we don't add him. Instead we print out an error message.
    //if($match == True) {
    //    echo '{"status":"That username is taken"}'; 
    //} else {
        $userType = '';

        if(empty($ajUsers)) { // Add user type
            $userType = 'superAdmin';
        }
        else {
            $userType = 'normal';
        }

        $jUsers = json_decode('{}'); // json object
        $jUsers->sUserID = count($ajUsers)+1; // takes the length of the array and adds 1.
        $jUsers->sUsername = $sUsername; // adds username to the json array.
        $jUsers->sPassword = $sPassword; // adds password to the json array.
        $jUsers->userType = $userType; // adds type to the json array

        $_SESSION['currentUser'] = $sUsername; 

        // push the users to the json array.
        array_push( $ajUsers , $jUsers );

        // Takes the json array and converts it to a string . With Pretty print added to improve readability for humans.
        $sajUsers = json_encode( $ajUsers , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

        // save the data in the file
        file_put_contents( $sFileName , $sajUsers );

        echo '{"status":"ok", "message":"successfully registered your account!"}';
    //      }
    
