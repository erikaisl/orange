<?php
// DELETE PROPERTY
header('Access-Control-Allow-Origin: *');
$sId = $_POST['id'];
$sFileName = "data-properties.txt";

$sajProperties = file_get_contents( $sFileName );
$ajProperties = json_decode( $sajProperties );
if( !is_array($ajProperties ) ){
	echo '{"statusOk":false, "statusMessage":"File is corrupted"}';
	exit;
}

for( $i = 0; $i < count($ajProperties) ; $i++ ){
	// check if the ids match
	if( $sId ==  $ajProperties[$i]->iUniqueId  ){
		array_splice( $ajProperties , $i , 1 );
		echo '{"statusOk":true, "statusMessage":"Property is successfully deleted"}';
		break;
	}
}

// object to text
$sajProperties = json_encode( $ajProperties , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

// save the data in the file
file_put_contents( $sFileName , $sajProperties );




?>