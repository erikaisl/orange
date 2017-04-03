<?php
// UPDATE PROPERTY
header('Access-Control-Allow-Origin: *');
$iUserId = $_POST['user_id'];
$sConvertInto = $_POST['convert_into']; // admin/normal

$sFileNameUsers = "data-users.txt";

$sajUsers = file_get_contents( $sFileNameUsers );
$ajUsers = json_decode( $sajUsers );
if( !is_array($ajUsers ) ){
	$ajUsers = [];
	echo '{"statusOk":false, "statusMessage":"File corrupted"}'; 
	exit;
}

// edit the object
for( $i = 0; $i < count($ajUsers) ; $i++ ){
	// check if the ids match
	if( $iUserId == $ajUsers[$i]->iUserID ){
		// update the property based on the position in the array
		$ajUsers[$i]->userType = $sConvertInto;
		break;
	}
}

// object to text
$sajUsers = json_encode( $ajUsers , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

// save the data in the file
file_put_contents( $sFileNameUsers , $sajUsers );

echo '{"statusOk":true, "statusMessage":"User successfully converted into ' . $sConvertInto . ' user"}';


	
?>