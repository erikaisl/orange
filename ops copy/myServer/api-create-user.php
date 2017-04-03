<?php
	// CREATE USER
	// header('Access-Control-Allow-Origin: *');
	$sUsername = $_POST['createUsername'];
	$sPassword = $_POST['createPassword'];
	$sEmail = $_POST['createEmail'];
	$sFileNameUsers = "data-users.txt";
	$sStatusMessage;

	// file which one ?
	// users.txt [{}]
	$sajUsers = file_get_contents( $sFileNameUsers );
	$ajUsers = json_decode( $sajUsers );
	
	if( !is_array( $ajUsers ) ){
		$ajUsers = [];
	}

	// by default:
	$match = false; 

    // Loop through the array to see if someone with that name already exists.
    for( $i = 0; $i < count($ajUsers) ; $i++ ){
		
		// Avoid username duplications:
        if( $sUsername == $ajUsers[$i]->sUsername){ //checks if the value of the username is equal to the value in the array.
            $match = true;
        	$sStatusMessage = '{"statusOk":false, "statusMessage":"That username is taken"}'; 
        } 
		
		// Avoid email duplications:
        if( $sEmail == $ajUsers[$i]->sEmail){ //checks if the value of the username is equal to the value in the array.
            $match = true;
       		$sStatusMessage = '{"statusOk":false, "statusMessage":"That email is taken"}'; 
        } 
		
    }

    // If user already exists we don't add him. Instead we print out an error message.
    if( !$match ){
		$iLastUserId = $ajUsers[ count($ajUsers)-1 ]->iUserID;
		
		$jUsers = json_decode('{}'); // json object
		$jUsers->iUserID = $iLastUserId + 1;
		$jUsers->sUsername = $sUsername;
		$jUsers->sPassword = $sPassword; 
		$jUsers->sEmail = $sEmail;
		$jUsers->userType = "normal";

		// push it to the array
		array_push( $ajUsers , $jUsers );
		// var_dump( $ajProperties );
		// object to text
		$sajUsers = json_encode( $ajUsers , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
		// echo $sajProperties;
		// save the data in the file
		file_put_contents( $sFileNameUsers , $sajUsers );

		$sStatusMessage = '{"statusOk":true, "statusMessage":"User successfully created"}';
		
	}
	
	echo $sStatusMessage;
	
?>