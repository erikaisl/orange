<?php
	// UPDATE PROPERTY
	header('Access-Control-Allow-Origin: *');
	$sOldUsername = $_GET['oldUsername'];
	$sUsername = $_GET['username'];
	$sPassword = $_GET['password'];
	
	$sFileNameUsers = "data-users.txt";

	$sajUsers = file_get_contents( $sFileNameUsers );
	$ajUsers = json_decode( $sajUsers );
	if( !is_array($ajUsers ) ){
		$ajUsers = [];
	}

	$match = False; 

    // Loop through the array to see if someone with that name already exists.
    for( $i = 0; $i < count($ajUsers) ; $i++ ){
        if( $sUsername == $ajUsers[$i]->sUsername){ //checks if the value of the username is equal to the value in the array.
             $match = True;
        } 
    }

    // If user already exists we don't add him. Instead we print out an error message.
    if($match) {
        echo '{"status":"That username is taken"}'; 
    } else {
		// edit the object
		for( $i = 0; $i < count($ajUsers) ; $i++ ){
			// check if the ids match
			if( $sOldUsername ==  $ajUsers[$i]->sUsername  ){
				// update the property based on the position in the array
				$ajUsers[$i]->sUsername = $sUsername;
				$ajUsers[$i]->sPassword = $sPassword;
				break;
			}
		}

		// object to text
		$sajUsers = json_encode( $ajUsers , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

		// save the data in the file
		file_put_contents( $sFileNameUsers , $sajUsers );

		echo '{"status":"ok"}';
	}

	
?>