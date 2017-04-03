<!doctype html>
<html>    
    <head> 
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="spa.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">  
        <title>Mi Casa</title>
    </head>
    <body>

    <div id="response-bar-wrap">
        <div id="response-bar">
            <div id="message-title"></div>
            <div id="message-content"></div>
        </div>
    </div>

       <div class="menu MenuHide">
        <div class="logo">
            <h1>Mi casa</h1>
        </div>
        <div class="menuItem">
            <div data-go-to="wdw-lists" class="link menuItem notLoggedIn hideFromUser">Lists</div>
            <div data-go-to="wdw-create-property" class="link menuItem notLoggedIn hideFromUser">Properties</div>
            <div data-go-to="wdw-create-user" class="link menuItem notLoggedIn hideFromUser">Users</div>
            <div data-go-to="wdw-sign-in" class="link menuItem loggedIn hideFromUser">Sign in/sign up</div>
            <div data-go-to="wdw-logout" class="link menuItem btnlogout notLoggedIn hideFromUser">Logout</div>
        </div>
    </div>

        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

        <h3 id="loggedInUsername"></h3>
        <button id="logoutButton" type="button" style="display:none;">Logout</button>

        <div class="flex-container">

			<!-- SUPER ADMIN REGISTRATION WINDOW -->
            <div class="windows" id="superAdminRegisterWindow">
                <form class="signUpForms" id="super-admin-signUpForm">
                    <fieldset class="fieldset">
                        <legend id="signUp">Register superadmin first.</legend>
                        <label for="signUpUsername">Select username*</label>
                        <input type="text" name="signUpUsername" class="cannot-be-empty" id="signUpUsername" required><!-- username --><br>
    
                        <label for="signUpPassword">Select password*</label>
                        <input type="password" name="signUpPassword" class="password-fields cannot-be-empty" id="signUpPassword" required><!-- password --><br>
    
                        <label for="signUpPasswordRepeat">Repeat password*</label>
                        <input type="password" class="password-repeats cannot-be-empty" id="signUpPassword" required><!-- password --><br>
    
                        <label for="signUpEmail">Select email*</label>
                        <input type="email" name="signUpEmail" class="email-fields cannot-be-empty" id="signUpEmail" required><!-- email --><br>
                        <input type="hidden" name="signUpUserId" id="signUpUserId" value=""><!-- user id --><br>
                        
                        <button type="button" class="signUpButtons">Register</button>
                    </fieldset>
                </form>
            </div>
            <!--------------------------------------------------------------------------------------------->
        
        	<!-- LOGIN WINDOW -->
            <div class="windows" id="loginWindow">
                <form id="loginForm">
                    <fieldset class="fieldset">
                        <legend id="login">Login</legend>
                        <label for="loginUsername">User</label>
                        <input type="text" name="loginUsername" id="loginUsername" required><!-- username --><br>
    
                        <label for="loginPassword">Password</label>
                        <input type="password" name="loginPassword" id="loginPassword" required><!-- password --><br>
                        
                        <button type="button" id="logInButton">Login</button>
                        <div id="go-to-registration">I am not a user yet</div>
                    </fieldset>
                </form>
            </div>
            <!--------------------------------------------------------------------------------------------->


			<!-- REGISTRATION WINDOW -->
            <div class="windows" id="signUpWindow">
                <form class="signUpForms" id="normal-user-signUpForm">
                    <fieldset class="fieldset">
                        <legend id="signUp">Sign Up. It's free.</legend>
                        <label for="signUpUsername">Username*</label>
                        <input type="text" name="signUpUsername" class="cannot-be-empty" id="signUpUsername" required ><!-- username --><br>
    
                        <label for="signUpPassword">Password*</label>
                        <input type="password" name="signUpPassword" class="password-fields cannot-be-empty" id="signUpPassword" required><!-- password --><br>
    
                        <label for="signUpPasswordRepeat">Password repeat*</label>
                        <input type="password" class="password-repeats cannot-be-empty" id="signUpPassword" required><!-- password --><br>
    
                        <label for="signUpEmail">Select email*</label>
                        <input type="email" name="signUpEmail" class="email-fields cannot-be-empty" id="signUpEmail" required><!-- email --><br>
                        <input type="hidden" name="signUpUserId" id="signUpUserId" value=""><!-- user id --><br>
                        
                        <button type="button" class="signUpButtons">Register</button>
                    	<div id="go-to-login">I already have an account</div>
                    </fieldset>
                </form>
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
                <input type="password" name="createPassword" id="createPassword" required><br>

                <input id="createButton" type="submit" value="Submit">
            </fieldset>
        </form>

        <div id="stat">
            
        </div>
        
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->
        <!-- ********************************************************************** -->

     


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <script src="SPA.js"></script>                
    </body>
</html>