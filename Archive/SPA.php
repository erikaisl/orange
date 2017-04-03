<!doctype html>
<html>    
    <head> 
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="spa.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">  
    </head>
    <body>
        <h3 id="loggedInUsername"></h3>
        <button id="logoutButton" type="button" style="display:none;">Logout</button>

        <div class="flex-container">

			<!-- SUPER ADMIN REGISTRATION WINDOW -->
            <div class="login-window-wraps" id="superAdminRegisterWindow">
                <form class="signUpForms" id="super-admin-signUpForm">
                    <fieldset class="fieldset">
                        <legend id="signUp">Register superadmin first.</legend>
                        <label for="signUpUsername">Select username</label>
                        <input type="text" name="signUpUsername" id="signUpUsername" required ><!-- username --><br>
    
                        <label for="signUpPassword">Select password</label>
                        <input type="text" name="signUpPassword" id="signUpPassword" required><!-- password --><br>
                        <input type="text" name="signUpUserId" id="signUpUserId" value=""><!-- user id --><br>
                        
                        <button type="button" class="signUpButtons">Register</button>
                    </fieldset>
                </form>
            </div>
            <!--------------------------------------------------------------------------------------------->
        
        	<!-- LOGIN WINDOW -->
            <div class="login-window-wraps" id="loginWindow">
                <form id="loginForm">
                    <fieldset class="fieldset">
                        <legend id="login">Login.</legend>
                        <label for="loginUsername">User</label>
                        <input type="text" name="loginUsername" id="loginUsername" required><!-- username --><br>
    
                        <label for="loginPassword">Password</label>
                        <input type="text" name="loginPassword" id="loginPassword" required><!-- password --><br>
                        
                        <button type="button" id="logInButton">Login</button>
                    </fieldset>
                </form>
                <div id="go-to-registration">I am not a user yet</div>
            </div>
            <!--------------------------------------------------------------------------------------------->


			<!-- REGISTRATION WINDOW -->
            <div class="login-window-wraps" id="signUpWindow">
                <form class="signUpForms" id="normal-user-signUpForm">
                    <fieldset class="fieldset">
                        <legend id="signUp">Sign Up. It's free.</legend>
                        <label for="signUpUsername">User</label>
                        <input type="text" name="signUpUsername" id="signUpUsername" required ><!-- username --><br>
    
                        <label for="signUpPassword">Password</label>
                        <input type="text" name="signUpPassword" id="signUpPassword" required><!-- password --><br>
                        <input type="text" name="signUpUserId" id="signUpUserId" value=""><!-- user id --><br>
                        
                        <button type="button" class="signUpButtons">Register</button>
                    </fieldset>
                </form>
                <div id="go-to-login">I already have an account</div>
            </div>
            <!--------------------------------------------------------------------------------------------->
        </div>

    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        
        <?php require_once('profile_wdw.php'); ?>

    	<!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->


        <ul id="propertiesList">
        </ul>

        <form id="createPropertyForm" style="display:none;">
            <fieldset>
                <legend>Property user:</legend>
                <label for="createPropertyPrice">Price</label>
                <input type="text" name="createPropertyPrice" id="createPropertyPrice" required><br>

                <label for="createPropertyAddress">Address</label>
                <input type="text" name="createPropertyAddress" id="createPropertyAddress" required><br>

                <input id="createPropertyButton" type="submit" value="Submit">
            </fieldset>
        </form>


        <ul id="userList">
        </ul>

        <form id="createForm" style="display:none;">
            <fieldset>
                <legend>Create user:</legend>
                <label for="createUsername">User</label>
                <input type="text" name="createUsername" id="createUsername" required><br>

                <label for="createPassword">Password</label>
                <input type="text" name="createPassword" id="createPassword" required><br>

                <input id="createButton" type="submit" value="Submit">
            </fieldset>
        </form>

        <div id="stat">
            
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <script src="SPA.js"></script>                
    </body>
</html>