<html>    
    <head> 
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="sp.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>

        	img{
				width: 200px;
        		background-color: #ffffff;
			    border: #c5c5c5 solid 2px;
			    border-radius: 8px;
			    padding-left: 3px;
			    padding-right: 3px;
			    text-align: center;
			    display: block;
			    padding: 8px 8px 7px 8px;
			    font-size: 16px;
			    margin-top: 50px;
     
        	 }

        	 #property-form {
			    background-color: #4CAF50;
			    display: inline-flex;
			    padding: 20px;
			    border-radius: 8px;
			 }

			  #user-form {
			    background-color: #4CAF50;
			    display: inline-flex;
			    padding: 20px;
			    border-radius: 8px;
			 }

			 #create-property-column2{
			 	padding-left: 60px;
			 	padding-top: 8px;
			 }

			 #create-user-column2{
			 	padding-left: 60px;
			 	padding-top: 60px;
			 }
			 
			 #homePageWindow {
				 display:flex;
				 width:100%;
				 height:100%;
				 align-content:center;
				 justify-content:center;
			 }
			 
			 #dashboard {
				 display:flex;
				 background:white;
				 width:80%;
				 height:100%;
				 align-items:center;
				 justify-content:space-around;
			 }
			 
			 /*.item-lists {
				width:300px;
				height:300px;
				border:1px solid red; 
			 }*/
			 
			 .item-list-items {
				 display:flex;
				 list-style:none;
				 background:green;
				 align-items:center;
				 margin-bottom:1em;
			 }
			 
			 .item-pictures {
				 min-width:3em;
				 height:3em;
				 background:red;
			 }
			 
			 .item-titles {
				 width:100%;
			 }
			 
			 .item-managing-icons {
				 display:flex;
				 width:3em;
			 }

			 /* Table Styling */
		    .responsive-table {
 			margin: auto;
  			color: #555;
  			border-radius: 15px;
  			border-collapse: collapse;
  			overflow: hidden;
  		    }

  			.responsive-table tr {
   			 border-top: 1px solid #ddd;
    		border-bottom: 1px solid #ddd;
    		background-color: #f5f5f5; 
    		}

    		.responsive-table tr:first-child {
      		border-top: none;
      		color: #fff; 
      		}

            .responsive-table tr:nth-child(odd):not(:first-child) {
      		background-color: #eeeeee; 
      		}

  			.responsive-table th {
    		text-align: left;
    		padding: 1em;
    		background-color: #4caf50; 
    		}

  			.responsive-table td {
    		text-align: left;
    		padding: 1em; 
    		}

    		tbody {
    			-moz-border-radius:10px;
                -webkit-border-radius:10px;
    			border-radius:10px
    		}

    		#map {
        	height: 400px;
        	width: 400px;
       		}

            /* List button styling */
            input#addNewUserButton {
                margin-top: 1em;
                margin-left: 18em;
            }

            input#addNewPropertyButton {
                margin-top: 1em;
                margin-left: 16.5em;
            }

            /* small images */
             img#extraimage1, #extraimage2 {
                width: 80px;
                height: 80px
            }

            img#extraimage1 {
                margin-right: 20px;
            }

            #smallimages{
                    display:flex;
                    flex-direction: row;
            }

            input, button{   
                background-color: #ffffff;
                border: #c5c5c5 solid 2px;
                border-radius: 8px;
                padding-left: 3px;
                padding-right: 3px;
                text-align: center;
                display: block;
                padding: 8px 8px 7px 8px;
                font-size: 16px;
            }

            div#create-property-column2 {
                margin-left: 40px;
                margin-top: 90px;
            }
            </style>

    </head>

    <body>

    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

     <div  class="wdw windows" id="homePageWindow">
     	<h1 id="home-page-title"></h1>
     	<div id="dashboard"></div>
	 </div>

    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

     <div class="wdw windows" id="createPropertyWindow">

     
        <div id="property-form">
            <div id="create-property-column1">
                <h1 id="create-property-title"><!-- Create / update property --></h1>
                <img src="house-icon-3.png" alt="property-picture" >
                <div id="smallimages">
                    <img id="extraimage1" src="house-icon-3.png" alt="property-picture" >
                    <img id="extraimage2" src="house-icon-3.png" alt="property-picture" >
                </div>
            </div>

            <div class="icons">
            <div class="map-marker">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            <div>    
            <div class="envelope">    
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </div>    
            </div>

            <form id="create-property-column2">
                <label for="createPropertyPrice">Price*</label>
                <input type="text" name="createPropertyPrice" class="cannot-be-empty" id="createPropertyPrice" required><br>

                <label for="createPropertySize">Size*</label>
                <input type="text" name="createPropertySize" class="cannot-be-empty" id="createPropertySize" required><br>

                <label for="createPropertyAddress">Address*</label>
                <input type="text" name="createPropertyAddress" class="cannot-be-empty" id="createPropertyAddress" required><br>
                
                <input type="hidden" name="propertyId" id="createPropertyId" value="">

                <button type="button" class="submitButtons" class="cannot-be-empty" id="createPropertyButton" data-button-role="">Submit</button>
            </form>
        </div>    
        
    </div>

    
    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

        <div class="wdw windows" id="createUserWindow">

     
        <div id="user-form">
        		<div id="create-user-column1">
                    <h1 id="create-user-title"><!-- Create / update user --></h1>
                    <img src="profile-icon-9.png" alt="profile-picture" >
        		</div>

        		<form id="create-user-column2">
                    <label for="createUsername">Username*</label>
                    <input type="text" name="createUsername" class="cannot-be-empty" id="createUsername" required><br>
    
                    <label for="createPassword">Password*</label>
                    <input type="password" name="createPassword" class="password-fields cannot-be-empty" id="createPassword" required><br>
    
                    <label for="createPassword">Password repeat*</label>
                    <input type="password" name="createPasswordRepeat" class="password-repeats cannot-be-empty" id="createPasswordRepeat" required><br>
    
                    <label for="createPassword">Email*</label>
                    <input type="email" name="createEmail" class="email-fields cannot-be-empty" id="createEmail" required><br>
    
                	<input type="hidden" name="userId" id="createUserId" value="">
                
                    <button type="button" class="submitButtons" id="createUserButton" data-button-role="new-item">Submit</button>
                </form>
        </div>    
        
    </div>

    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

        <div class="wdw-map" id="map">

        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script async defer
    			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGuLx_kVPKhkalbyGavSMAS7xkmZkQJAc&callback=initMap">
    	</script>
    </body>
</html>