var iLastUserId;
var sUserType;
var sErrorMessage;
var sActualWindow;
var jAdminInfo = {};

// Before anything would happen, check if there is superadmin:
fnCheckSuperAdmin();


// Right click to homepage (except if not logged in yet):
$(document).mousedown(function(event) {
	if( sActualWindow !== '#loginWindow' && sActualWindow !== '#superAdminRegisterWindow' && sActualWindow !== '#signUpWindow' ){
		
		// Prevent context menu:
		$(document).on("contextmenu",function(){
		   return false;
		});
		
		// Go home on right click:
		if(event.which === 3){
			fnShowSelectedWindow( '#homePageWindow' );
		}
	}
});

// Registration button is clicked:
$(document).on("click", ".signUpButtons", function(){
	
	// Select the parent of parent of clicked button (this):
	"use strict";
	var sIdOfTheFormsParent = $(this).parent().parent().attr('id');
	
	// Get users:
	var sURL = 'myServer/data-users.txt';
	$.ajax({
		"method"	: "post",
		"url"		: sURL,
		"dataType"	: "json"
	})
	.done(function( ajUsers ){
		
		// Check if there is any user registered into 'data-users.txt':
		if( ajUsers.length < 1 ){
			$('#signupUserId').val('1');
		}
		
		// If we don't have a user yet:
		else {
			
			// Loop through all the users:
			for(var i = 0; i < ajUsers.length; i++){
				
				// Get the user:
				var jUser = ajUsers[i];
				//console.log( jUser.id );
				
				// Get user's id:
				var sUserID = jUser.sUserID;
				
				// Change last ID's value:
				iLastUserId = sUserID;
			}
			
			// Increase new user's id with '1':
			var iNewId = iLastUserId + 1;
			
			// Change input's value:
			$('#signupUserId').val(iNewId);
		}
		if( fnValidation( sIdOfTheFormsParent ) === true ){
			var sBackEndUrl = 'myServer/api-signup.php';
			var sDataToPass = $( '#' + sIdOfTheFormsParent ).serialize();
			$.ajax({
				"method"	: "post",
				"url"		: sBackEndUrl,
				"data"		: sDataToPass,
				"dataType"	: "json"
			})
			.done(function( sResponse ){
	
				// give response:
				fnShowResponseBar( sResponse.status );
			});
		}
		else {
	
			// give response:
			fnShowResponseBar( sErrorMessage );
		}
	});
	
});

// Login button is clicked:
$(document).on("click", "#logInButton", function() {
	
	// Getting user list:
	var sURL = 'myServer/data-users.txt';
	$.ajax({
		"method"	: "post",
		"url"		: sURL,
		"dataType"	: "json"
	})
	.done(function( ajUsers ){
		
		var sUsernameInputValue = $('#loginUsername').val();
		var sPasswordInputValue = $('#loginPassword').val();
		var sMessage;
		var bLoggedIn;
		var sUsername;
		var sEmail;
		
		// Looping through all users to compare their username and password:
		for(var i = 0; i < ajUsers.length; i++){
			var jUser = ajUsers[i];
			
			// If they match:
			if( sUsernameInputValue === jUser.sUsername && sPasswordInputValue === jUser.sPassword ){
				
				// Change message variable to 'logged in':
				sMessage = 'Welcome ' + jUser.sUsername;
				bLoggedIn = true;
				sUserType = jUser.userType;
				sUsername = jUser.sUsername;
				sEmail = jUser.sEmail;
				
				// Only here you break the for loop so you dont continue the loop:
				break;
				
			// If they dont match:
			} else {
				
				// Change message variable to 'not logged in':
				sMessage = 'Username or password is incorrect';
				bLoggedIn = false;
			}
		}
		
		// Check if user is logged in:
		if( bLoggedIn ){
			
			// Add info to the admin JSON object:
			jAdminInfo.user_type = sUserType;
			jAdminInfo.username = sUsername;
			jAdminInfo.email = sEmail;
			
			// Show only the homepage window:
			fnShowSelectedWindow( '#homePageWindow' );
		}
		
		// Give response:
		fnShowResponseBar( sMessage );
	});
});

// When "go-to-registration" is clicked:
$(document).on("click", "#go-to-registration", function(){
	
	// Show only the selected window (sign up):
	fnShowSelectedWindow( "#signUpWindow" );
});

// When "go-to-login" is clicked:
$(document).on("click", "#go-to-login", function(){
	
	// Show only the selected window (login):
	fnShowSelectedWindow( "#loginWindow" );
});

// Open create new user window:
$(document).on("click", "#addNewUserButton", function(){
	fnShowSelectedWindow( '#createUserWindow' );
});

// Open create new property window:
$(document).on("click", "#addNewPropertyButton", function(){
	fnShowSelectedWindow( '#createPropertyWindow' );
});

// Submit create new user or property:
$(document).on("click", ".submitButtons", function(){
	
	var sClickedButtonId = $(this).attr('id');
	var sClickedButtonRole = $(this).attr('data-button-role');
	var sFormWrapId;
	var sFormIdToValidate;
	var sApiFile;
	
	if( sClickedButtonId === 'createUserButton' ){
		
		sFormWrapId = 'user-form';
		sFormIdToValidate = 'create-user-column2';
		
		
		if( sClickedButtonRole === 'new-item' ){
			sApiFile = 'api-create-user.php';
		} else if( sClickedButtonRole === 'update-item' ){
			sApiFile = 'api-update-user.php';
		}
		
	} else if( sClickedButtonId === 'createPropertyButton' ){
		
		sFormWrapId = 'property-form';
		sFormIdToValidate = 'create-property-column2';
		
		if( sClickedButtonRole === 'new-item' ){
			sApiFile = 'api-create-property.php';
		} else if( sClickedButtonRole === 'update-item' ){
			sApiFile = 'api-update-property.php';
		}
		
	}
	
	// Validate the selected form's inputs:
	if( fnValidation( sFormIdToValidate ) === true ){
		
		// Register new user:
		var sApiLink = 'myServer/' + sApiFile;
		var sFormWrapSelector = '#' + sFormWrapId; // <- will be either '#user-form' or '#property-form'
		var sFormToValidateSelector = '#' + sFormIdToValidate; // <- will be either '#create-user-column2' or '#create-property-column2'
		var sFormValues = $( sFormWrapSelector + ' ' + sFormToValidateSelector ).serialize(); // <- will be for example "$( '#user-form #create-user-column2' ).serialize()"

		$.ajax({
			"method"	: "post",
			"url"		: sApiLink,
			"data"		: sFormValues,
			"dataType"	: "json"
		})
		.done(function( jData ){
			
			if( jData.statusOk === true ){
				fnShowSelectedWindow('#homePageWindow');
				
				fnNotifyMe( jData.statusMessage );
			}
			
			// Get response from the server and pass it to response bar showing function:
			fnShowResponseBar( jData.statusMessage );
		});
	} else {
		
		// Get error message and pass it to response bar showing function:
		fnShowResponseBar( sErrorMessage );
	}
});

// Clicking on edit icons:
$(document).on("click", ".edit-icons", function(){
	var sItemId = $(this).attr('data-item-id'); // anything which is written in data-properties or data-users
	var sItemType = $(this).attr('data-item-type'); // user/property
		

	if( sItemType === 'property' ){
		
		// Open 'edit' property window
		fnShowSelectedWindow( '#createPropertyWindow', sItemId );
		
	} else if( sItemType === 'user' ){
		
		// Open 'edit' user window
		fnShowSelectedWindow( '#createUserWindow', sItemId );
	}
});

// Clicking on delete icons:
$(document).on("click", ".delete-icons", function(){
	var sItemId = $(this).attr('data-item-id'); // anything which is written in data-properties or data-users
	var sItemType = $(this).attr('data-item-type'); // user/property
	var oThisItem = $(this);
	var sApiFile;
	var sApiPath;
		
	if( sItemType === 'property' ){
		
		sApiFile = 'api-delete-property.php';
		sApiPath = 'myServer/' + sApiFile;
		
		
		
		
		$.ajax({
			"method" : "post",
			"url" : sApiPath,
			"data" : {"id":sItemId},
			"dataType" : "json"
		})
		.done(function( jResponse ){
			
			// Show response:
			fnShowResponseBar( jResponse.statusMessage );
			
			// If we could successfully delete the item:
			if( jResponse.statusOk ){
				oThisItem.parent().parent().fadeOut();
			}
		});
		
	} else if( sItemType === 'user' ){
		
		sApiFile = 'api-delete-user.php';
		sApiPath = 'myServer/' + sApiFile;
		
		$.ajax({
			"method" : "post",
			"url" : sApiPath,
			"data" : {"user_id":sItemId},
			"dataType" : "json"
		})
		.done(function( jResponse ){
			
			// Show response:
			fnShowResponseBar( jResponse.statusMessage );
			
			// If we could successfully delete the item:
			if( jResponse.statusOk ){
				oThisItem.parent().parent().fadeOut();
			}
		});
	}
});

// Clicking on converter icons:
$(document).on("click", ".convert-icons", function(){
	
	var sUrl = 'myServer/api-convert-user.php';
	var user_id = $(this).attr('data-item-id');
	
	// If it is a circle:
	if($(this).hasClass('fa-circle-o')){
		
		// Replace circle icon with checkmark:
		$(this).removeClass('fa-circle-o');
		$(this).addClass('fa-check');
		
		// Exchange data with user converter api:
		$.ajax({
			"method" : "post",
			"url" : sUrl,
			"data" : { "convert_into" : "admin", "user_id" : user_id },
			"dataType" : "json"
		})
		.done(function( sResponse ){
		
			// Give response
			fnShowResponseBar( sResponse.statusMessage );
		});
	}
	
	// If it is a checkmark:
	else if($(this).hasClass('fa-check')){
		
		// Replace circle icon with checkmark:
		$(this).removeClass('fa-check');
		$(this).addClass('fa-circle-o');
		
		// Exchange data with user converter api:
		$.ajax({
			"method" : "post",
			"url" : sUrl,
			"data" : { "convert_into" : "normal", "user_id" : user_id },
			"dataType" : "json"
		})
		.done(function( sResponse ){
		
			// Give response
			fnShowResponseBar( sResponse.statusMessage );
		});
	}
});




// Validating function:
function fnValidation( sIdOfFormToValidate ){
	var aoInputs = [];
	var bValidationOk = true; // by default
	var sFormInputs = $( '#' + sIdOfFormToValidate + ' input' );
	sErrorMessage = ''; // before we would start the validation
	
	// Add every single selected element to the array:
	$( sFormInputs ).each(function(){
		aoInputs.push( $(this) );
	});
	
	// Loop through every single elements in the array:
	for( var i = 0; i < aoInputs.length; i++ ){
		var oActualInput = aoInputs[i];
		
		// Password validation:
		if( oActualInput.hasClass('cannot-be-empty') ){
			
			if( oActualInput.val() === "" || oActualInput.val() === null ){
				bValidationOk = false;
				sErrorMessage = 'The marked fields should not be empty';
			}
		}
		
		// Password validation:
		if( oActualInput.hasClass('password-fields') && bValidationOk ){
			var sRepeatedPassword = $( '#' + sIdOfFormToValidate + ' .password-repeats');

			if( oActualInput.val() !== sRepeatedPassword.val() ){
				bValidationOk = false;
				sErrorMessage = 'password and password repeat should match';
			}
		}
		
		// Email validation:
		if( oActualInput.hasClass('email-fields') && bValidationOk ){
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if( regex.test( oActualInput.val() ) === false ){
				bValidationOk = false;
				sErrorMessage = 'please write a valid email format';
			}
		}
	}
	
	return bValidationOk;
}





// Function which checks if there is super admin already:
function fnCheckSuperAdmin(){
	
	// Get users:
	var sURL = 'myServer/data-users.txt';
	$.ajax({
		"method"	: "post",
		"url"		: sURL,
		"dataType"	: "json"
	})
	.done(function( ajUsers ){
		
		// Check if there is any user registered into 'data-users.txt':
		if( ajUsers.length < 1 ){

			// Show selected window (super admin register):
			fnShowSelectedWindow( '#superAdminRegisterWindow' );
		}
		
		// If there is any user:
		else {

			// Show login window:
			fnShowSelectedWindow( '#loginWindow' );
		}
	});
}






// Function which shows ONLY the selected "window":
function fnShowSelectedWindow( sTheIdOfWindowToShow, sOptionalItemId ){

	// Hide EVERY SINGLE ELEMENT which has the class of 'windows':
	$('.windows').css("display","none");
	
	// Show ONLY THE ELEMENT which has the ID we passed through function parameter:
	$( sTheIdOfWindowToShow ).css("display","block");
	
	// Update 'sActualWindow':
	sActualWindow = sTheIdOfWindowToShow;
	
	
	
	
	
	
	// If the window is:
	if( sTheIdOfWindowToShow === '#homePageWindow' ){
		var sHomePageTitle;
		var sBluePrint;
		
		// Check admin user type:
		if( jAdminInfo.user_type === 'superAdmin' ){
			sBluePrint = 
				'<div class="item-list-wraps">\
					<h1>User list</h1>\
					<table class="responsive-table">\
						<tbody id="user-list">\
						</tbody>\
					</table>\
					<button id="addNewUserButton">Add new user</button>\
				</div>\
				<div class="item-list-wraps">\
					<h1>Property list</h1>\
					<table class="responsive-table">\
						<tbody id="property-list">\
					</table>\
					<button id="addNewPropertyButton">Add new property</button>\
				</div>';
				
		} else if( jAdminInfo.user_type === 'admin' ){
			sBluePrint = 
				'<div class="item-list-wraps">\
					<h1>Property list</h1>\
					<table class="responsive-table">\
						<tbody id="property-list">\
					</table>\
					<button class id="addNewPropertyButton">Add new property</button>\
				</div>';
				
		} else if( jAdminInfo.user_type === 'normal' ){
			sBluePrint = 
				'<div class="item-list-wraps">\
					<h1>Property list</h1>\
					<table class="responsive-table">\
						<tbody id="property-list">\
					</table>\
				</div>';
		}
		
		// Empty dashboard first, then add blue print to it:	
		$('#dashboard').empty();
		$('#dashboard').append( sBluePrint );
			
		// Refresh item lists:
		fnRefreshItemList( 'user-list' );
		fnRefreshItemList( 'property-list' );
		
	} else if( sTheIdOfWindowToShow === '#createPropertyWindow' || sTheIdOfWindowToShow === '#createUserWindow' ){
		
		var sUrl;
		var sWindowTitleSelector;
		var sWindowTitle;
		var sSubmitButtonSelector;
		var sSubmitButtonRole;
		
		// Check if there is item id:
		if( typeof( sOptionalItemId ) === 'undefined' ){
			if( sTheIdOfWindowToShow === '#createPropertyWindow' ){
				
				sWindowTitleSelector = '#create-property-column1 h1';
				sWindowTitle = 'Add new property';
				sSubmitButtonSelector = '#create-property-column2 button';
				sSubmitButtonRole = 'new-item';
		
			
				$( sWindowTitleSelector ).text( sWindowTitle );
				$( sSubmitButtonSelector ).attr( 'data-button-role', sSubmitButtonRole );
				
			} else if( sTheIdOfWindowToShow === '#createUserWindow' ){
				
				sWindowTitleSelector = '#create-user-column1 h1';
				sWindowTitle = 'Add new user';
				sSubmitButtonSelector = '#create-user-column2 button';
				sSubmitButtonRole = 'new-item';
		
			
				$( sWindowTitleSelector ).text( sWindowTitle );
				$( sSubmitButtonSelector ).attr( 'data-button-role', sSubmitButtonRole );
				
			}
			
		} else {
			
			if( sTheIdOfWindowToShow === '#createPropertyWindow' ){
				sUrl = 'myServer/data-properties.txt';
				fnFillUpdateWindow( sUrl, 'property', sOptionalItemId );
				
			} else if( sTheIdOfWindowToShow === '#createUserWindow' ){
				sUrl = 'myServer/data-users.txt';
				fnFillUpdateWindow( sUrl, 'user', sOptionalItemId );
				
			}
		}
	}
}




// Function which refreshes item lists:
function fnFillUpdateWindow( sUrl, sItemType, sOptionalItemId ){
		
	var sWindowTitle;
	var sSubmitButtonRole;
	var sWindowTitleSelector;
	var sSubmitButtonSelector;
	var sPropertyIdInput;
	var sPropertyPriceInput;
	var sPropertySizeInput;
	var sPropertyAddressInput;
	var sUserIdInput;
	var sUserUsernameInput;
	var sUserPasswordInput;
	var sUserEmailInput;
	var iItemIdSelector;
	
	$.ajax({
		"method"	: "post",
		"url"		: sUrl,
		"dataType"	: "json"
	})
	.done(function( ajItems ){
	
		// Looping through all the properties:
		for( var i = 0; i < ajItems.length; i++ ){
			var sFoundItem = ajItems[i];
			
			
			
			
			if( sItemType === 'user' ){
				
				iItemIdSelector = sFoundItem.iUserID;
				
				sWindowTitleSelector = '#create-user-title';
				sWindowTitle = 'Update user';
				
				sSubmitButtonSelector = '#create-user-column2 button';
				sSubmitButtonRole = 'update-item';
				
				sUserUsernameInput = $('#createUsername');
				sUserPasswordInput = $('#createPassword');
				sUserEmailInput = $('#createEmail');
				sUserIdInput = $('#createUserId');
				
			} else if( sItemType === 'property' ){
				
				iItemIdSelector = sFoundItem.iUniqueId;
				
				sWindowTitleSelector = '#create-property-title';
				sWindowTitle = 'Update property';
				
				sSubmitButtonSelector = '#create-property-column2 button';
				sSubmitButtonRole = 'update-item';
				
				sPropertyPriceInput = $('#createPropertyPrice');
				sPropertySizeInput = $('#createPropertySize');
				sPropertyAddressInput = $('#createPropertyAddress');
				sPropertyIdInput = $('#createPropertyId');
			}
			
			
			
			
			
			
			// If we find the item and it is a property:
			if( iItemIdSelector == sOptionalItemId && sItemType === 'property' ){
				
				var iPrice = sFoundItem.iPrice;
				var iSize = sFoundItem.iSize;
				var iId = sFoundItem.iUniqueId;
				var sAddress = sFoundItem.sAddress;
				
				sPropertyPriceInput.val( iPrice );
				sPropertySizeInput.val( iSize );
				sPropertyAddressInput.val( sAddress );
				sPropertyIdInput.val( iId );




				$( sWindowTitleSelector ).text( sWindowTitle );
				$( sSubmitButtonSelector ).attr( 'data-button-role', sSubmitButtonRole );
				
			}
			
			// If we find the item and it is a user:
			else if( iItemIdSelector == sOptionalItemId && sItemType === 'user' ){
				
				
				var sUsername = sFoundItem.sUsername;
				var sPassword = sFoundItem.sPassword;
				var sEmail = sFoundItem.sEmail;
				var iUserId = sFoundItem.iUserID;
				
				sUserUsernameInput.val( sUsername );
				sUserPasswordInput.val( sPassword );
				sUserEmailInput.val( sEmail );
				sUserIdInput.val( iUserId );




				$( sWindowTitleSelector ).text( sWindowTitle );
				$( sSubmitButtonSelector ).attr( 'data-button-role', sSubmitButtonRole );
			}
		}
	});
}




// Function which refreshes item lists:
function fnRefreshItemList( sItemListType ){
	"use strict";
	
	var sURL;
	var sHeader_ItemTitle;
	var sHeader_ItemInfo;
	var sBluePrint_tableHeader =
		  '<tr>\
			<th>{{item-title-tableheader}}</th>\
			<th>{{item-info-tableheader}}</th>\
			<th data-th="Delete">Delete</th>\
			<th data-th="Edit">Edit</th>\
			<th data-th="Convert">Make admin</th>\
		  </tr>';
		
	var sBluePrint_tableRows = // ###here
		'<tr>\
			<td data-th="{{item-title-tablerows}}">{{item-title}}\
	        </td>\
	        <td data-th="{{item-info-tablerows}}">{{item-info}}\
	        </td>\
	        <td data-th="Delete">\
	          <div class="link fa {{delete-icon}} fa-fw delete-icons" data-item-type="{{data-item-type-delete}}" data-item-id="{{data-item-id-delete}}"></div>\
	        </td>\
	        <td data-th="Edit">\
	          <div class="link fa fa-edit fa-fw edit-icons" data-item-type="{{data-item-type-edit}}" data-item-id="{{data-item-id-edit}}"></div>\
	        </td>\
	        <td data-th="Convert">\
	          <div class="link fa {{convert-icon}} fa-fw convert-icons" data-item-id="{{data-item-id-convert}}"></div>\
	        </td>\
		</tr>';
		  
		
	// Empty deprecated table rows first:
	$('#' + sItemListType).empty();
	
	// Check the type of refreshed item list:
	if( sItemListType === 'user-list' ){
		
		sHeader_ItemTitle = 'Username';
		sHeader_ItemInfo = 'Email';
		sURL = 'myServer/data-users.txt';
		
	} else if( sItemListType === 'property-list' ){
		
		sHeader_ItemTitle = 'Address';
		sHeader_ItemInfo = 'Price';
		sURL = 'myServer/data-properties.txt';
		
	}
	
	// Replace our self-defined "variables":
	var sBlueprintCopy_tableHeader = sBluePrint_tableHeader;
		sBlueprintCopy_tableHeader = sBlueprintCopy_tableHeader.replace('{{item-title-tableheader}}', sHeader_ItemTitle);
		sBlueprintCopy_tableHeader = sBlueprintCopy_tableHeader.replace('{{item-info-tableheader}}', sHeader_ItemInfo);
	
	// Add table header before doing anything with the rows:
	$('#' + sItemListType).append(sBlueprintCopy_tableHeader);
	
	// Get user or property data from the "server" (sURL):
	$.ajax({
		"method"	: "post",
		"url"		: sURL,
		"dataType"	: "json"
	})
	.done(function( ajReceivedData ){
		
		// Loop through all the users:
		for(var i = 0; i < ajReceivedData.length; i++){
			var sItemTitle;
			var sItemInfo;
			var sItemId;
			var sItemType;
			var jItem = ajReceivedData[i];
		
			var sBlueprintCopy_tableRows = sBluePrint_tableRows;
			if( sItemListType === 'user-list' ){
				
				sItemTitle = jItem.sUsername;
				sItemInfo = jItem.sEmail;
				sItemId = jItem.iUserID;
				sItemType = 'user';
				
			} else if( sItemListType === 'property-list' ){
				
				sItemTitle = jItem.sAddress;
				sItemInfo = jItem.iPrice;
				sItemId = jItem.iUniqueId;
				sItemType = 'property';
			}
			
			// Replace our self-defined "variables":
			sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{item-title-tablerows}}', sItemTitle);
			sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{item-title}}', sItemTitle);
			sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{item-info-tablerows}}', sItemInfo);
			sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{item-info}}', sItemInfo);
			sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{data-item-id-delete}}', sItemId);
			sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{data-item-type-delete}}', sItemType);
			sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{data-item-id-edit}}', sItemId);
			sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{data-item-type-edit}}', sItemType);
			sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{data-item-id-convert}}', sItemId);
			
			// Set differend admin converter icons and row style for normal users and admins:
			if( sItemType === 'user' ){
				if( jItem.userType === 'normal' ){
					sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{convert-icon}}', 'fa-circle-o');
					sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{delete-icon}}', 'fa-trash'); // since trash logo is not defined in superadmin case, it won't appear in super admin row
				} else if( jItem.userType === 'admin' ){
					sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{convert-icon}}', 'fa-check');
					sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{delete-icon}}', 'fa-trash'); // since trash logo is not defined in superadmin case, it won't appear in super admin row
				}
			} else {
				sBlueprintCopy_tableRows = sBlueprintCopy_tableRows.replace('{{delete-icon}}', 'fa-trash'); // define trash icon for property list
			}
	
			// Add table rows on each looping:
			$('#' + sItemListType).append(sBlueprintCopy_tableRows);
			
			// Disable every user except super admin to convert users:
			if( jAdminInfo.user_type !== 'superAdmin' || sItemType !== 'user' ){ // also remove it if it is not a user list
				$('#' + sItemListType + ' [data-th="Convert"]').remove();
			}
			
			// Disable normal users to CRUD items:
			if( jAdminInfo.user_type === 'normal' ){
				$('#' + sItemListType + ' [data-th="Edit"]').remove();
				$('#' + sItemListType + ' [data-th="Delete"]').remove();
				$('#' + sItemListType + ' [data-th="Edit"]').remove();
				$('#' + sItemListType + ' [data-th="Edit"]').remove();
			}
		}
	});
}




// Showing response bar:
function fnShowResponseBar( sResponseMessage ){
			
	// Set the text of response bar's message content:
	$('#response-bar-wrap #message-content').text( '' ); // modify #message-content by emptying previous message first because we dont need it
	$('#response-bar-wrap #message-content').text( sResponseMessage ); // modify it to new message
		
	// Show response bar:
	$('#response-bar-wrap').slideDown();
	
	// Hide after 3secs:
	setTimeout(function(){
		$("#response-bar-wrap").fadeOut();
		$('#response-bar-wrap #message-content').text( '' ); // empty message on hiding
	}, 3000);

	// Hide on click:
	$(document).on("click", "#response-bar-wrap", function(){
		$(this).fadeOut();
		$('#response-bar-wrap #message-content').text( '' ); // empty message on hiding
	});
}





// Showing notifications:
function fnNotifyMe( message ) {
	// Does the browser support notifications?
	if (!("Notification" in window)) {
			
		alert('This browser does not support push notifications.');
	}
	
	// Check whether notification permissions have already been granted
	else if( Notification.permission === "granted" ) {
		// If it's okay let's create a notification
		var notification = new Notification( message );
	}
	
	// Otherwise, we need to ask the user for permission
	else if( Notification.permission !== "denied" ) {
		Notification.requestPermission( function( permission ) {
			
		  // If the user accepts, let's create a notification
		  if ( permission === "granted" ) {
			var notification = new Notification("From now you will get notified.");
		  }
		});
	}
	
	// At last, if the user has denied notifications, and you 
	// want to be respectful there is no need to bother them any more.
}



fnBlinkTitle();
// Page title blinking
function fnBlinkTitle( message ){
	var iHowManyBlinks = 3;
	
	for( var i = 0; i < iHowManyBlinks; i++ ){
		
	}
		
}


// When ".map-marker" is clicked:
//$(document).on("click", "#map-marker", function(){
	
	// Show only the selected window ():
	//fnShowSelectedWindow( "#map" );
//});