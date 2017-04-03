<?php
	// UPDATE PROPERTY
	header('Access-Control-Allow-Origin: *');
	$sId = $_POST['propertyId'];
	$sAddress = $_POST['createPropertyAddress'];
	$iPrice = $_POST['createPropertyPrice'];
	$iSize = $_POST['createPropertySize'];

	$sFileName = "data-properties.txt";

	// file which one ?
	// properties.txt [{}]
	$sajProperties = file_get_contents( $sFileName );
	$ajProperties = json_decode( $sajProperties );
	if( !is_array($ajProperties ) ){
		$ajProperties = [];

		echo '{"statusOk":false, "statusMessage":"File is corrupted"}';
		exit;
	}

	// edit the object
	for( $i = 0; $i < count($ajProperties) ; $i++ ){
		// check if the ids match
		if( $sId ==  $ajProperties[$i]->iUniqueId  ){
			// echo $ajProperties[$i]->iUniqueId;
			// update the property based on the position in the array
			$ajProperties[$i]->sAddress = $sAddress;
			$ajProperties[$i]->iPrice = $iPrice;
			$ajProperties[$i]->iSize = $iSize;
			break;
		}
	}


	// object to text
	$sajProperties = json_encode( $ajProperties , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

	// save the data in the file
	file_put_contents( $sFileName , $sajProperties );

	echo '{"statusOk":true, "statusMessage":"Property successfully updated"}';
	// echo '{"status":"error","id":"001","message":"file corrupted"}';
	

?>