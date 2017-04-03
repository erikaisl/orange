<?php

$sPictureFilename 		= $_FILES['the-uploaded-picture']['name'];
$sTemporaryPath			= $_FILES['the-uploaded-picture']['tmp_name'];
$sTargetDirectory		= 'uploads/'; // CHANGE FOLDERNAME HERE!
$sFinalPath				= $sTargetDirectory . $sPictureFilename;
$sImageFileType			= pathinfo( $sFinalPath, PATHINFO_EXTENSION) ;
$sFileWoExtension		= basename( $sPictureFilename, '.' . $sImageFileType );
$bValidationOk			= true; // by default






// Lets find mistakes:


// Here we check for special characters in the filename:
if( preg_match('/[^-a-z0-9_]/i', $sFileWoExtension )) {
	$sStatusMessage		= 'Filename can only contain "a-z", "0-9" and "-" characters. No space, no capital letters.';
	$bValidationOk		= false;
}

if( $sPictureFilename === 'fuck.png' ){
	$sStatusMessage		= 'Do not upload filenames like this.';
	$bValidationOk 		= false;
}







// Only upload if validation is okay:
if( $bValidationOk ){
	if( move_uploaded_file( $sTemporaryPath, $sFinalPath ) ){
		$sResponse = '{
				"statusOk"	: true,
				"filename"	: "' . $sPictureFilename . '"
			}';
	} else {
		$sResponse = '{
				"statusOk"		: false,
				"statusMessage"	: "' . $sStatusMessage . '"
			}';
	}
}

// If it is not okay, then get error message:
else {
	$sResponse = '{
			"statusOk"		: false,
			"statusMessage"	: "' . $sStatusMessage . '"
		}';
}

echo $sResponse;

?>