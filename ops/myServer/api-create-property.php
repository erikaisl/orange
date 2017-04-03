<?php
	// CREATE PROPERTY
	header('Access-Control-Allow-Origin: *');
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
		echo '{"statusOk":false, "statusMessage":"File corrupted"}';
		exit();
	}
	$jProperty = json_decode('{}'); // json object
	$jProperty->iUniqueId = count($ajProperties)+100000;
	$jProperty->sAddress = $sAddress; // ->   ->   ->    ->   ->
	$jProperty->iPrice = $iPrice; // ->   ->   ->    ->   ->
	$jProperty->iSize = $iSize; // ->   ->   ->    ->   ->

	// push it to the array
	array_push( $ajProperties , $jProperty );
	// var_dump( $ajProperties );
	// object to text
	$sajProperties = json_encode( $ajProperties , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
	// echo $sajProperties;
	// save the data in the file
	file_put_contents( $sFileName , $sajProperties );

	echo '{"statusOk":true, "statusMessage":"Property successfully created"}';
	// echo '{"status":"error","id":"001","message":"file corrupted"}';
?>