<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Untitled Document</title>
    </head>
    
    <body>
    	<div id="preview-image" style="width:200px;height:200px;border:1px solid gray;background-size:cover;background-position:center;">
        	<div style="background:white">Preview</div>
        </div>
        
    	<div id="uploaded-image" style="width:200px;height:200px;border:1px solid gray;background-size:cover;background-position:center;">
        	<div style="background:white">Uploaded</div>
        </div>
        
        <form id="picture-upload-form" action="picture-backend.php" method="post" enctype="multipart/form-data">
        
        	<input name="the-uploaded-picture" id="browser-button" type="file">
            <button type="submit">Upload new picture</button>
            
        </form>
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script>
		
		$('#picture-upload-form').on('submit',(function(e) {
		
			// Do not submit the form (kill default event):
			e.preventDefault();
			
			// Put form and its data (this) into a new FormData:
			var oFormData	= new FormData( this );
			var sURL			= 'picture-backend.php'; // CHANGE FILENAME HERE!
			
			$.ajax({
				type		: 'POST',
				url			: sURL,
				data		: oFormData,
				cache		: false,
				contentType	: false,
				processData	: false,
				
				success : function( sData ){
					var jData = JSON.parse(sData);
					
					// If upload was succesful:
					if( jData.statusOk === true ){
						var sTargetDirectory	= 'uploads/';
						var sPictureFile		= sTargetDirectory + jData.filename;
						var sBackgroundCode		= 'url(' + sPictureFile + ')';
						alert( sBackgroundCode );
						
						$('#uploaded-image').css('background-image', sBackgroundCode);
					}
				},
							
				error : function( sData ){
					var jData = JSON.parse(sData);
					
					// If upload was unsuccesful:
					if( jData.statusOk === false ){
						
					}
				}
			});
		}));

    </script>
    </body>
</html>