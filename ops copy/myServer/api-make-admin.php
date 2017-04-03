<?php
	// UPDATE PROPERTY
	header('Access-Control-Allow-Origin: *');
	$sUsername = $_GET['username'];
	
	$sFileNameUsers = "data-users.txt";

	$sajUsers = file_get_contents( $sFileNameUsers );
	$ajUsers = json_decode( $sajUsers );
	if( !is_array($ajUsers ) ){
		$ajUsers = [];
	}

	// edit the object
	for( $i = 0; $i < count($ajUsers) ; $i++ ){
		// check if the ids match
		if( $sUsername ==  $ajUsers[$i]->sUsername  ){

			// update the property based on the position in the array
			$ajUsers[$i]->userType = 'admin';
			break;
		}
	}

	// object to text
	$sajUsers = json_encode( $ajUsers , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

	// save the data in the file
	file_put_contents( $sFileNameUsers , $sajUsers );

	echo '{"status":"ok"}';
?>