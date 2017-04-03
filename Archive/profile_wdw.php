<html>    
    <head> 
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="spa.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

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
				 height:80%;
				 align-items:center;
				 justify-content:space-around;
			 }
			 
			 .item-lists {
				width:300px;
				height:300px;
				border:1px solid red; 
			 }
			 
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

        </style>

    </head>

    <body>

    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

     <div  class="wdw login-window-wraps" id="homePageWindow">
     	<h1 id="home-page-title"><!-- JS --></h1>

     	<div id="dashboard">
            <div class="item-list-wraps">
            	<h1>User list</h1>
            	<ul class="item-lists" id="user-list"><!-- JS --></ul>
            </div> 
            
            <div class="item-list-wraps">
            	<h1>Property list</h1>
            	<ul class="item-lists" id="property-list"><!-- JS --></ul>
            </div>
        </div>
        
    </div>

    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

     <div class="wdw login-window-wraps" id="createPropertyWindow">

     
        <form id="property-form">
        		<div id="create-property-column1">
        		<h1>Create property</h1>
        		<img src="house-icon-3.png" alt="property-picture" >
        		</div>

        		<div id="create-property-column2">
                <label for="createPropertyPrice">Price</label>
                <input type="text" name="createPropertyPrice" id="createPropertyPrice" required><br>

                <label for="createPropertySize">Size</label>
                <input type="text" name="createPropertySize" id="createPropertySize" required><br>

                <label for="createPropertyAddress">Address</label>
                <input type="text" name="createPropertyAddress" id="createPropertyAddress" required><br>

                <input id="createPropertyButton" type="submit" value="Submit">
                </div>
        </form>    
        
    </div>

    
    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

        <div class="wdw login-window-wraps" id="createUserWindow">

     
        <form id ="user-form">
        		<div id="create-user-column1">
        		<h1>Create User</h1>
        		<img src="profile-icon-9.png" alt="profile-picture" >
        		</div>

        		<div id="create-user-column2">
                <label for="createUsername">Username</label>
                <input type="text" name="createUsername" id="createUsername" required><br>

                <label for="createPassword">Password</label>
                <input type="text" name="createPassword" id="createPassword" required><br>

                <input id="createPropertyButton" type="submit" value="Submit">
                </div>
        </form>    
        
    </div>

    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

    </body>
</html>