<?php
	// UPDATE PROPERTY
	header('Access-Control-Allow-Origin: *');
	$iUserId = $_POST['userId'];
	$sUsername = $_POST['createUsername'];
	$sPassword = $_POST['createPassword'];
	$sEmail = $_POST['createEmail'];
	
	$sFileNameUsers = "data-users.txt";

	$sajUsers = file_get_contents( $sFileNameUsers );
	$ajUsers = json_decode( $sajUsers );
	if( !is_array($ajUsers ) ){
		$ajUsers = [];
        echo '{"statusOk":false, "statusMessage":"File corrupted"}'; 
		exit;
	} 

    // Loop through the array to see if someone with that name already exists.
    for( $i = 0; $i < count($ajUsers) ; $i++ ){
        if( $sUsername == $ajUsers[$i]->sUsername && $iUserId != $ajUsers[$i]->iUserID ){ //checks if the value of the username is equal to the value in the array.
             
			// If user already exists we don't add him. Instead we print out an error message.
			echo '{"statusOk":false, "statusMessage":"That username is taken"}'; 
			exit;
        } 
		
		
        if( $sEmail == $ajUsers[$i]->sEmail && $iUserId != $ajUsers[$i]->iUserID ){ //checks if the value of the username is equal to the value in the array.

			// If user already exists we don't add him. Instead we print out an error message.
			echo '{"statusOk":false, "statusMessage":"That email is taken"}'; 
			exit;
        } 
    }
	// edit the object
	for( $i = 0; $i < count($ajUsers) ; $i++ ){
		// check if the ids match
		if( $iUserId == $ajUsers[$i]->iUserID ){
			// update the property based on the position in the array
			$ajUsers[$i]->sUsername = $sUsername;
			$ajUsers[$i]->sPassword = $sPassword;
			$ajUsers[$i]->sEmail = $sEmail;
			break;
		}
	}

	// object to text
	$sajUsers = json_encode( $ajUsers , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

	// save the data in the file
	file_put_contents( $sFileNameUsers , $sajUsers );

	echo '{"statusOk":true, "statusMessage":"User successfully updated"}';


	
?>