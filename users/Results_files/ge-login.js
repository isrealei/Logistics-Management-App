// Define Variables
var isUserLoggedIn = false;
var first;
var profileLang;

var regHost = "reg.usps.com";
var toolsHost = "tools.usps.com";
var storeHost = "store.usps.com";
var catStore = "";
var pfslHost = "pfsl.usps.com"
var lowEnv = false;

// Get current URL
var currentPage = cleanURL(document.URL);
var currentPageIn=currentPage;
var hostname = cleanURL(document.location.hostname);
if (!appID) {
	var appID = "Phoenix";
} else if (appID=="ATG") {
	currentPage="https://"+storeHost+"/store";
	currentPageIn="https://"+storeHost+document.location.pathname+document.location.search;
	currentPageIn=prepURL(currentPageIn);
}
if (document.location.pathname.indexOf("holdmail")!=-1){
	currentPageIn="https://"+storeHost+"/holdmail/";
}
if (document.location.pathname.indexOf("redelivery")!=-1) {
	currentPageIn="https://"+storeHost+"/redelivery/";
}
if (document.location.pathname.indexOf("pse")!=-1) {
	currentPageIn="https://"+storeHost+"/store/pse/";
}
if (document.location.pathname.indexOf("pfs")!=-1) {
	currentPageIn="https://"+storeHost+"/pfs/";
}
if (document.location.pathname.indexOf("pfsLocal-P_PFSLocal")!=-1) {
	currentPageIn="https://"+storeHost+"/store/productpfsl/pfsLocal-P_PFSLocal";
}

if (document.location.hostname.indexOf("informeddelivery")!=-1) {
	currentPage=document.location.origin;
	currentPageIn=document.location.origin;
}
if (document.location.pathname.indexOf("informeddelivery")!=-1) {
	currentPage="https://informeddelivery.usps.com";
	currentPageIn="https://informeddelivery.usps.com";
}
if (document.location.hostname.indexOf("eddm.usps.com")!=-1) {
	currentPage="https://eddm.usps.com/eddm/";
	currentPageIn="https://eddm.usps.com/eddm/";
}

// Clean URL
function cleanURL(x) {
	if (x!=null){
		x = x.replace("<","%3C");
		x = x.replace(">","%3E");
		if (x.indexOf("?") > -1) {
			x = x.substring(0,x.indexOf("?"));
		}
		if (x.indexOf("#") > -1) {
			x = x.substring(0,x.indexOf("#"));
		}
		return x;
	}
}

// Prepare URL for CustReg
function prepURL(x) {
	x = x.replace(/=/g,"%3D");
	x = x.replace(/&/g,"%26");
	x = x.replace(/:/g,"%3A");
	return x;
}

// Cookie Functions
function createMyCookie(name,value) {
	document.cookie = name+"="+value+"; path=/; domain=.usps.com";
}

function readMyCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseMyCookie(name) {
	createMyCookie(name,"",-1);
}

// Setup Cookies
var nameCookieName = "EntRegName";
var prefsCookieName = "EntRegPrefs";

// Verify cookie has value
var nameCookie = readMyCookie(nameCookieName);
var prefsCookie = readMyCookie(prefsCookieName);

// If user manually chose to update language; update the cookie value for the session
function updateLangCookie(sLanguage) {
	if (prefsCookie != null && prefsCookie != "") {
		var prevValue = prefsCookie;
		var newValue = prevValue.replace("lang="+profileLang,"lang="+sLanguage)
		eraseMyCookie(prefsCookieName)
		createMyCookie(prefsCookieName,newValue);
	}
}

if (nameCookie) {
	var user = nameCookie.split("|");
	first = user[0];
	
	if (first) {
		isUserLoggedIn = true;
	}
}

if (isUserLoggedIn) {
	// Add updateLangCookie function to language selectors
	if (prefsCookie != null && prefsCookie != "") {
		//var el = document.getElementsByClassName("multi-link");
		var el = document.querySelectorAll('.multi-lang-link');
		if (el[0].addEventListener) {                    // For all major browsers, except IE 8 and earlier
			el[0].addEventListener("click", function () {updateLangCookie('en')}, false);
		} else if (el[0].attachEvent) {                  // For IE 8 and earlier versions
			el[0].attachEvent("onclick", function () {updateLangCookie('en')});
		}
		if (el[1].addEventListener) {                    // For all major browsers, except IE 8 and earlier
			el[1].addEventListener("click", function () {updateLangCookie('es')}, false);
		} else if (el[1].attachEvent) {                  // For IE 8 and earlier versions
			el[1].attachEvent("onclick", function () {updateLangCookie('es')});
		}
		if (el[2].addEventListener) {                    // For all major browsers, except IE 8 and earlier
			el[2].addEventListener("click", function () {updateLangCookie('zh')}, false);
		} else if (el[2].attachEvent) {                  // For IE 8 and earlier versions
			el[2].attachEvent("onclick", function () {updateLangCookie('zh')});
		}
	}
}

var loginAnchor_Onclick="";
var loginSignin_Onclick="";
var loginForgot_Onclick="";
var loginSignup_Onclick="";
var loginProfile_Onclick="";
var loginSignout_Onclick="";

if(typeof loginAnchor_BeaconDoer == 'function') {
	loginAnchor_Onclick=' onclick="loginAnchor_BeaconDoer()" ';
}
if(typeof loginSignin_BeaconDoer == 'function') {
  loginSignin_Onclick=' onclick="loginSignin_BeaconDoer()" ';
}
if(typeof loginForgot_BeaconDoer == 'function') {
  loginForgot_Onclick=' onclick="loginForgot_BeaconDoer()" ';
}
if(typeof loginSignup_BeaconDoer == 'function') {
  loginSignup_Onclick=' onclick="loginSignup_BeaconDoer()" ';
}
if(typeof loginProfile_BeaconDoer == 'function') {
  loginProfile_Onclick=' onclick="loginProfile_BeaconDoer()" ';
}
if(typeof loginSignout_BeaconDoer == 'function') {
  loginSignout_Onclick=' onclick="loginSignout_BeaconDoer()" ';
}

// Non-logged in User
var nonLoggedInUser = '';

// Logged in User
var loggedInUser = 	'<div class="nav-pipe"></div><div id="nav-tool-login" class="nav-tool"><h2><a class="anchor" href="#" tabindex="0" id="anchor-login" name="anchor-login" '+
        loginAnchor_Onclick+
        '>Hi, '+cleanURL(first)+'</a></h2>'+
					'<div class="nav-window" style="height: 0px; overflow: hidden;">'+
						'<div class="wrapper col_3">'+
							'<div class="background-s">'+
							'<div class="content">'+
								'<div class="reg inner">'+
									'<div>'+
										'<p>'+cleanURL(first)+',</p>'+
										'<ul class="fontStyle9">'+
											'Thanks for registering for an account. Get started using USPS.com by shopping or shipping.'+
										'</ul>'+
									'</div>'+
									'<div id="accountLinks" class="cta fontStyle7 clearfix">'+
										'<a id="link-activity" href="https://'+storeHost+'/store/myaccount/profile.jsp" '+
										loginProfile_Onclick+
										'>My Profile &rsaquo;</a>'+
										
										'<a href="https://'+regHost+'/logout?app='+appID+'&appURL='+currentPage+'">Sign Out</a>'+	
									'</div>'+
									'<div id="accountSubLinks" class="clearfix">'+
										'<ul>'+
											'<li>'+
										
												'<a href="https://'+storeHost+'/store/myaccount/myOrders.jsp">Activity History &rsaquo;</a>'+
											'</li>'+
											'<li>'+
												'<a href="https://'+storeHost+'/store/myaccount/paymentInfo.jsp ">Stored Payments &rsaquo;</a>'+
											'</li>'+
										'</ul>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div></div><div class="nav-pipe"></div>';
var mloggedInUser = '<div class="mobile-sign"><a class="m-sign-log" id="link-activity" href="https://'+storeHost+'/store/myaccount/profile.jsp">Hi, '+cleanURL(first)+'</a><a class="m-sign-log"  href="https://'+regHost+'/logout?app='+appID+'&appURL='+currentPage+'">Sign Out</a>';
					
// Display based on cookie
if (isUserLoggedIn) {
	document.getElementById('login-register-header').href="#";
	document.getElementById('login-register-header').innerHTML = loggedInUser;
	document.getElementById('msign').innerHTML = mloggedInUser;
	// Check for language cookie
	if (prefsCookie != null && prefsCookie != "") {
		// Parse Cookie for 'lang'
		var tempArray = new Array();
		var prefValues = prefsCookie.split("|");
		for (var c=0; c<prefValues.length; c++) {
			tempArray = prefValues[c].split("=");
			if(tempArray[0]=="lang") {
				profileLang = tempArray[1];
				break;
			}
		}
		// If they aren't already on the translated site, redirect them
		if (hostname.indexOf(profileLang) == -1 && profileLang != null) {
			OneLink(profileLang);
		}
	}
	//Make name fit
	try {
		var obj = document.getElementById('anchor-login');
		if(obj!=null){
			//anything over 96, need to expand it
			var maxLength = 96;
			var length = obj.innerHTML.length;
			if (length > 96) {
				var diff = (length-maxLength)*5;
				document.getElementById('nav-tool-login').style.width = 148+diff+"px";
				document.getElementById('nav-tool-login').lastChild.style.left = -328+diff+"px";
			}
		}
	} catch(e){}
} else {
	document.getElementById('login-register-header').href="https://"+regHost+"/entreg/LoginAction_input?app="+appID+"&appURL="+currentPageIn;
	document.getElementById('login-register-header').innerHTML = "Register / Sign In";
	var mobilesign = '<a href="https://'+regHost+'/entreg/LoginAction_input?app='+appID+'&appURL='+currentPageIn+'">Sign In</a>';
	document.querySelector('.mobile-sign').innerHTML = mobilesign;
}

// Search Client Hostname
var search_client_hostname = "https://about.usps.com";
