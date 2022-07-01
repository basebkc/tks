//jwts part
function getPrinter() {
 getAll();
 var printing = document.getElementById("Combobox1").selectedIndex;
 var myopt = "";
 if(printing == 0) { myopt = "4"; }
 else if(printing == 1) { myopt = "1"; }
 else if(printing == 2) { myopt = "2"; }
 else if(printing == 3) { myopt = "0"; }
 return "myopt=\"" + myopt + "\";"; 
}

function getside() {
 getAll();

 var insadd = "";
 if (getAccessType() == "java") {
   insadd = allinside;
 } else if (getAccessType() == "remoteapp") {
   insadd = alloutside;
 }
 
 if (typeof page_configuration["applications_portal"] != 'undefined' && page_configuration["applications_portal"] != '') {
   insadd += "applications_portal_type = '" + getAccessType() + "'; ";
 }
 
 if (!page_configuration["is_standard"]) {
   window.server = getSelectedServerIp();
   insadd += "server = '" + getSelectedServerIp() + "' ; ";
   if (getSelectedServerPort() != "") {
     insadd += "serverownport = " + getSelectedServerPort() + "; ";
   }
   insadd += "sameasweb = 'no'; ";
 }
 return "username=\"" + (page_configuration["is_webcredentials"] ? "@" : "") + document.getElementById("Editbox1").value + "\"; rdppass=\"" + document.getElementById("Editbox2").value + "\"; mydomain=\"" + document.getElementById("Editbox3").value + "\"; " + insadd;  
}

var temppfad=window.location.pathname.split('/'); temppfad=temppfad[temppfad.length-1];

function getAll() {
 var all=document.getElementsByTagName("input");
 var l=all.length;
 var alli;

 for(var i=0; i<l; i++) { 
  if(all[i].type!="password" && all[i].type!="submit") { 
   alli=all[i].value;
   if(all[i].type=="checkbox" || all[i].type=="radio") { 
    alli=all[i].checked+""; 
   }
   jscreateCookie(temppfad+""+all[i].name+"_"+all[i].id,alli,"365"); 
  }
 } 

 all=document.getElementsByTagName("select");
 l=all.length;

 for(var i=0; i<l; i++) { 
  jscreateCookie(temppfad+""+all[i].name,all[i].options.selectedIndex,"365"); 
 } 
}

function setAll() {
 initCookies();

 var all=document.getElementsByTagName("input");
 var l=all.length;
 var me="";
 for(var i=0; i<l; i++) { 
  if(all[i].type!="password" && all[i].type!="submit") { 
   me=jsreadCookie(temppfad+""+all[i].name+"_"+all[i].id); 
   if(me) { 
    if(all[i].type=="checkbox" || all[i].type=="radio") { 
     if(me=="true") { 
       all[i].checked=true; 
     } else { 
       all[i].checked=false; 
     }
    } else { 
     all[i].value=me;
    }
   }
  }
 }
 
 initHtmlPage();
 
 all=document.getElementsByTagName("select");
 l=all.length;
 for(var i=0; i<l; i++) { 
  me=jsreadCookie(temppfad+""+all[i].name);
  if(me) { 
   all[i].options.selectedIndex=me; 
  } 
 } 

 mainPortalInit();
 getOwnImplementation(); 
}

function getOwnImplementation() {
  document.getElementById("Editbox1").value = window.user;
  document.getElementById("Editbox2").value = window.pass;
  document.getElementById("Editbox3").value = window.domain;

  if (!page_configuration["is_standard"]) {
    onLoginTyped();
  }
}

function CheckKey(e) {
  if(!e) {
   if(window.event) {
     e = window.event;
   } else { return; }
  }

  if(typeof(e.keyCode) == 'number') {
   e = e.keyCode;
  } else if(typeof(e.which) == 'number')  {
    e = e.which;
  } else if(typeof(e.charCode) == 'number') {
    e = e.charCode;
  } else {
    return;
  }
  
  if (e == 13) {
    if (document.getElementById("Editbox1").value == "") { 
      alert("Insert Login please!"); 
      return;
    }
    cplogon();
  }
}

function setWindowVariables() {
  if (getAccessType() == "html5") {
	getAll();
    window.user = (page_configuration["is_webcredentials"] ? "@" : "") + document.getElementById("Editbox1").value;
    window.pass = document.getElementById("Editbox2").value;
    window.domain = document.getElementById("Editbox3").value;
    window.cmdline = cmdline;
    if (page_configuration["is_standard"]) {
	  window.server = server;
	  window.serverhtml5 = serverhtml5;
    } else {
	  window.server = getSelectedServerIp();
	  window.serverhtml5 = getSelectedServerIp();
      if (getSelectedServerPort() != "") {
		window.porthtml5 = getSelectedServerPort();
      }
    }
  }
}

function startInsideOutside() {
  if (document.getElementById("Editbox1").value == "") { 
    alert("Insert Login please!"); 
    return;
  }

  var hostGateway = '';
  if (!page_configuration["is_standard"]) {
    var splitGateway = getSelectedServerIp().split('/~~');
    if (splitGateway.length == 2) {
      hostGateway = window.location.protocol + "//" + splitGateway[0] + ":" + getSelectedServerPort() + "/~~" + splitGateway[1] + "/";
    }
  }
  
  var p = '';
  if (typeof page_configuration["applications_portal"] != 'undefined' && page_configuration["applications_portal"] != '') {
    p = page_configuration["applications_portal"];
  }
  
  if (getAccessType() == "java") {
    if (p == '') {
	  p = 'software/javaconnect.html';
	  window.name = " " + window.opforfalse;
	  if (cpwin != false) {
		cpwin.name = window.opforfalse;
		cpwin.location.href = hostGateway + jwtsclickLinkBefore(getside(), p);
	  } else {
		window.open(hostGateway + jwtsclickLinkBefore(getside(), p), window.opforfalse);
	  }
	} else {
	  h = jwtsclickLinkBefore(getside(), p) + '#';
	  window.name = window.opforfalse;
      location.href = hostGateway + h;
	}
  } else if (getAccessType() == "remoteapp") {
    if (p == '') {
	  p = 'software/remoteapp.html';
	  window.name = " " + window.opforfalse;
	  if (cpwin != false) {
		cpwin.name = window.opforfalse;
		cpwin.location.href = hostGateway + jwtsclickLinkBefore(getside(), p);
	  } else {
		window.open(hostGateway + jwtsclickLinkBefore(getside(), p), window.opforfalse);
	  }
	} else {
	  h = jwtsclickLinkBefore(getside(), p) + '#';
	  window.name = window.opforfalse;
      location.href = hostGateway + h;
	}
  } else if (getAccessType() == "html5") {
    var k = forHTML5();
	if (p == '') {
	  p = hostGateway + 'software/html5.html';
	  if (cpwin != false) {
		window.name = " " + k;
		cpwin.name = k;
		cpwin.location.href = p;
	  } else {
	    window.name = " " + k;
		if (navigator.userAgent.match(" CriOS")) {
		  tmpwin = window.open(p, '');
		  tmpwin.name = k;
		} else {
		  window.open(hostGateway + p, k);
		}
	  }
	} else {
	  window.name = " " + k;
      location.href = hostGateway + p + '#';
	}
  }
}

function forHTML5() {
 var randm=Math.floor(Math.random()*1000);
 return jsencode64(escape('var randomnum = ' + randm + ';window.cmdline=\'' + window.cmdline + '\';window.user=\'' + window.user + '\';window.pass=\'' + window.pass + '\';window.server=\'' + window.serverhtml5 + '\';window.port=\'' + window.porthtml5 + '\';window.webport=\'' + window.porthtml5 + '\';window.lang=\'' + window.lang + '\';window.domain=\'' + window.domain + '\';')).replace(/=/g, '_');
}

function addevents() {
 if(document.addEventListener) {
  document.addEventListener('keydown', CheckKey, false);
 } else if(document.attachEvent) {
  document.attachEvent('onkeydown', CheckKey);
 } else {
  document.onKeyDown = CheckKey;
 }
}

//jwts part end

// CP part start
var loginIsOk = false;
var passwordIsOk = false;
var xhrLoginIsRunning = false;

var cpwin = false;

var serversListingType = "unknown";

function initHtmlPage()
{
  if (page_configuration["show_domain"]) {
    show("tr-domain", "table-row");
  }
  if (page_configuration["show_password"]) {
    show("tr-password", "table-row");
  }
  access_types = page_configuration["access_type"].split("+");
  if (access_types.length > 1) {
    show("accesstypeuserpanel", "block");
    for (var i = 0; i < access_types.length; i++) {
      switch (access_types[i]) {
        case "java": show("label_accesstypeuserchoice_java"); break;
        case "remoteapp": show("label_accesstypeuserchoice_remoteapp"); break;
        case "html5": show("label_accesstypeuserchoice_html5"); break;
      }
    }
  }
}

function initCookies()
{
  if (!page_configuration["remember_credentials"]) {
    jscreateCookie = function (name,value,days) { }
	jsreadCookie = function (name) { }
	document.cookie = temppfad + 'Login_Editbox1=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	document.cookie = temppfad + 'Domain_Editbox3=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }
}

function getAccessType()
{
  if (page_configuration["access_type"] == "java" || page_configuration["access_type"] == "remoteapp" || page_configuration["access_type"] == "html5") {
    return page_configuration["access_type"];
  } else {
    accesstypeuserchoice = document.forms['logonform'].elements['accesstypeuserchoice'];
    for (var i = 0; i < accesstypeuserchoice.length; i++) {
      if (accesstypeuserchoice[i].checked) {
        return accesstypeuserchoice[i].value;
      }
    }
  }
  return "";
}

function onPasswordTyped() { /* Kept for legacy bug fixing and to avoid having to regenerate the index.html web access page */ }
function onPassword2Focused() { /* Kept for legacy bug fixing and to avoid having to regenerate the index.html web access page */ }

function onPasswordFocused()
{
  if (!page_configuration["is_standard"]) {
    passwordIsOk = false;
    document.getElementById("Editbox2").value = "";
  }
}

function onLoginTyped()
{
  if (!page_configuration["is_standard"]) {
    checkLogin();
    initLoadBalancing();
  }
}

function checkPassword()
{
  password = document.getElementById("Editbox2").value;
  login = document.getElementById("Editbox1").value.toLowerCase();
  domain = document.getElementById("Editbox3").value.toLowerCase();
  if ((password != "" || page_configuration["allow_empty_password"]) && login != "" && loginIsOk) {
    login = (page_configuration["is_webcredentials"] ? "@" : "") + document.getElementById("Editbox1").value.toLowerCase();
    loadIsPasswordOk(login, password, domain);
  } else {
    passwordIsOk = false;
    refreshCredentialsStatusDisplay();
  }
}

function checkLogin()
{
  login = document.getElementById("Editbox1").value.toLowerCase();
  if (login != "") {
    if (serversListingType == "userassigned") {
      loadServersList((page_configuration["is_webcredentials"] ? "@" : "") + login);
  	} else {
	  loginIsOk = true;
	  hide("span-login-ko");
	  show("span-login-ok");
	  show("select-server");
	  refreshCredentialsStatusDisplay()
	  }
  } else {
	loginIsOk = false;
	hide("select-server");
	refreshCredentialsStatusDisplay();
  }
}

function loadIsPasswordOk(login, password, domain)
{
  try {
    xhrPassword = new XMLHttpRequest();
  } catch(e) {
    try {
      xhrPassword = new ActiveXObject('MSXML2.XMLHTTP');
    } catch(e) {
       try {
         xhrPassword = new ActiveXObject('Microsoft.XMLHTTP');
       } catch(e) { }
    }
  }

  _password = encodeURIComponent(password).replace("~","%7E").replace("!","%21").replace("*","%2A").replace("(","%28").replace(")","%29").replace("'","%27");
  
  xhrPassword.onreadystatechange = processIsPasswordOkResponse;
  xhrPassword.open("GET", "/cgi-bin/hb.exe?action=cp&l=" + login.toLowerCase() + "&p=" + _password + "&d=" + domain + "&t=" + new Date().getTime(), true);
  xhrPassword.send(null);
}

function cplogon()
{
  setWindowVariables();
  
  if (page_configuration["is_standard"]) {
	startInsideOutside();
  } else {
	checkPassword();
	
	if (typeof page_configuration["applications_portal"] == 'undefined' || page_configuration["applications_portal"] == '') { // if we need to open the connexion client in a new tab/popup
	  // The following is to avoid a forbidden window.open on an async event, because window.open must be called directly on the click event.
	  if (getAccessType() == "java" || getAccessType() == "remoteapp") {
		jwtsclickLinkBefore(getside(), "");
		n = opforfalse;
	  } else if (getAccessType() == "html5") {
	    n = forHTML5();
	  }
	  cpwin = window.open("about:blank", n);
	  cpwin.document.title = document.title;
	}
  }
}

function loadServersList(login)
{
  xhrLoginIsRunning = true;

  try {
      xhrLogin = new XMLHttpRequest();
  } catch(e) {
      try {
        xhrLogin = new ActiveXObject('MSXML2.XMLHTTP');
      } catch(e) {
         try {
           xhrLogin = new ActiveXObject('Microsoft.XMLHTTP');
         } catch(e) { return ""; }
      }
  }

  xhrLogin.onreadystatechange = processServersList;
  xhrLogin.open("GET", "/software/java/img/cp/" + login.toLowerCase() + ".dat?t=" + new Date().getTime(), true);
  xhrLogin.send(null);
}

function processIsPasswordOkResponse()
{
  if (xhrPassword.readyState == 4) {
    if (xhrPassword.status == 200) {
      if (xhrPassword.responseText == "ko\r\n" || xhrPassword.responseText == "disabled-by-security-check\r\n") {
        passwordIsOk = false;
      } else if (xhrPassword.responseText == "ok\r\n") {
        passwordIsOk = true;
      }
      refreshCredentialsStatusDisplay();
    }
  }
}

function processServersList()
{
  if (xhrLogin.readyState == 4) {
    resetDropDownMenu();
    if (xhrLogin.status == 200) {
      loginIsOk = true;
	  hide("span-login-ko");
      show("span-login-ok");
      show("select-server");
      displayServersList(xhrLogin.responseText);
    } else {
      loginIsOk = false;
	  hide("span-login-ok");
      show("span-login-ko");
      hide("select-server");
    }
	xhrLoginIsRunning = false;
    refreshCredentialsStatusDisplay();
  }
}

function refreshCredentialsStatusDisplay() {
  if (!page_configuration["is_standard"]) {
    password = document.getElementById("Editbox2").value;
    login = document.getElementById("Editbox1").value.toLowerCase();
    
    if (!xhrLoginIsRunning) {
      if (loginIsOk) {
        hide("span-login-ko");
        show("span-login-ok");
      } else {
        hide("span-login-ok");
        if (login != "") {
          show("span-login-ko");
        } else {
	      hide("span-login-ko");
	    }
      }
    }
    
	if (passwordIsOk) {
		hide("span-password-ko");
		show("span-password-ok");
	} else {
		hide("span-password-ok");
		if (password != "") {
			show("span-password-ko");
		} else {
			hide("span-password-ko");
		}
	}
    
    if (loginIsOk && passwordIsOk) {
      hide("span-credentials-ko");
	  if (serversListingType != "unknown") {
    	startInsideOutside();
      } else {
	    if (cpwin != false) { cpwin.close(); }
		cpwin = false;
	  }
    } else {
      if (password != "" && login != "") {
        show("span-credentials-ko");
      } else {
        hide("span-credentials-ko");
	  }
	  if (cpwin != false) { cpwin.close(); }
	  cpwin = false;
    }
  }
}

function displayServersList(serversList)
{
  servers = serversList.split("\r\n");
  for (i in servers) {
    serverData = servers[i].split('|');
	if (serverData.length >= 2) {
      serverName = serverData[0];
      serverIPPort = serverData[1].split(':');
      serverport = "";
      if  (serverIPPort.length > 1) {
        serverport = serverIPPort[1];
      }
      addServerToDropDownMenu(serverName, serverIPPort[0], serverport);
	}
  }
}

function getSelectedServerIp()
{
  select = document.getElementById("select-server");
  ipport = select.options[select.selectedIndex].value.split(':');
  return ipport[0];
}

function getSelectedServerPort()
{
  select = document.getElementById("select-server");
  ipport = select.options[select.selectedIndex].value.split(':');
  serverport = "";
  if (ipport.length > 1) {
    serverport = ipport[1];
  }
  return serverport;
}

function initLoadBalancing()
{
  try {
      xhrLoadBalancing = new XMLHttpRequest();
  } catch(e) {
      try {
        xhrLoadBalancing = new ActiveXObject('MSXML2.XMLHTTP');
      } catch(e) {
         try {
           xhrLoadBalancing = new ActiveXObject('Microsoft.XMLHTTP');
         } catch(e) { return ""; }
      }
  }

  xhrLoadBalancing.onreadystatechange = processLoadBalancing;
  xhrLoadBalancing.open("GET", "/cgi-bin/hb.exe?action=gateway&t=" + new Date().getTime() + "&d=" + document.getElementById("Editbox3").value + "&l=" + (page_configuration["is_webcredentials"] ? "@" : "") + document.getElementById("Editbox1").value, true);
  xhrLoadBalancing.send(null);
}

function processLoadBalancing()
{
  if (xhrLoadBalancing.readyState == 4) {
    if (xhrLoadBalancing.status == 200) {
	  if (xhrLoadBalancing.responseText == "loadbalancing-off") {
	    serversListingType = "userassigned";
	    checkLogin();
	  } else {
	    serversListingType = "loadbalanced";
		s = xhrLoadBalancing.responseText.split("|");
		lessLoadedServerName = s[1];
		lessLoadedServerAddress = s[2];
        lessLoadedServerPort = s[4];
        resetDropDownMenu();
        addServerToDropDownMenu(lessLoadedServerName, lessLoadedServerAddress, lessLoadedServerPort);
        disableDropDownMenu();
	  }
	}
  }
}

function resetDropDownMenu()
{
  select = document.getElementById("select-server");
  select.options.length = 0;
}

function addServerToDropDownMenu(serverName, serverAddress, serverPort)
{
  if (serverPort != "") {
    serverPort = ":" + serverPort;
  }
  select = document.getElementById("select-server");
  select.options[select.options.length] = new Option(serverName, serverAddress + serverPort);
}

function disableDropDownMenu()
{
  select = document.getElementById("select-server");
  select.disabled = "disabled";
}

function hide(id)
{
  if (document.getElementById(id)) {
    document.getElementById(id).style.display = "none";
  }
}

function show(id, disp)
{
  if (typeof(disp)==='undefined') {
    disp = "inline";
  }
  if (document.getElementById(id)) {
    document.getElementById(id).style.display = disp;
  }
}
// CP part end 
