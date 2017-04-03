<?php
// DELETE PROPERTY

header('Access-Control-Allow-Origin: *');
$iUserId = $_POST['user_id'];
$sFileNameUsers = "data-users.txt";

$sajUsers = file_get_contents( $sFileNameUsers );
$ajUsers = json_decode( $sajUsers );
if( !is_array($ajUsers ) ){
	echo '{"statusOk":false, "statusMessage":"File is corrupted"}';
	exit;
}


for( $i = 0; $i < count($ajUsers) ; $i++ ){
	// check if the ids match
	if( $iUserId == $ajUsers[$i]->iUserID  ){
		array_splice( $ajUsers , $i , 1 );
		break;
	}
}

// object to text
$sajUsers = json_encode( $ajUsers , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

// save the data in the file
file_put_contents( $sFileNameUsers , $sajUsers );

echo '{"statusOk":true, "statusMessage":"User is successfully deleted"}';


?>