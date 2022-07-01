user = "";
pass = "";
server = "";
port = 3389; //correct for localhost, please no 80/443 by localhost!!!

portvnc = "5900"; //performs well with DFMirage and TightVNC Server
                  //example to prefer vnc connection, in server field instead home.server.com add # at begin -> #home.server.com

domain = ""; //domain, if present
lang = "as_browser"; //initial values "as_browser" or "as_gateway" or own like "de_de", "en_us", "fr_fr"

clipboard = "yes"; //or "no"
clipboardnew = true; //or false for old method...
                     //true=strg+v for inserting, strg+c for copy back, each new strg+c request creates new http connection, unstable on long distances
                     //false=strg+v for inserting, strg+c+c(during 1 second when icon indicates the arrived clipboard text) for copy back, very stable.

clipansicode = "windows-1252"; //conversation table for ansi clip text, no value means auto or windows-1252

filetransfer = "yes"; //yes or "no"
filelisting = "no"; //no, all, pc, mobile, ios

filehtmluploadbutton = "all"; //no, all, pc, mobile, ios - is also fast access upload button for quick file upload to rdp session

filerdpuploadbutton = "all"; //no, all, pc, mobile, ios - is also rdp session side upload to users browser

force_download_dialog = "all"; //no, all, pc, mobile, ios - forces the dialog for file downloading

fake_file_extension = false; //if set to true and file dialog forced, this will add fake file extension on downloadable files

dropboxonnewfile = 2; //when you create new file inside rdp session,
                      //1 the drop box opens automatically/refresh dropbox
                      //2 try to download file/refresh dropbox
                      //0 disabled

f5_for_refresh = true; //send F5 after file upload to refresh programs listening to F5 button

openonclipblur = false; //when set to true and clipboard data arrived, the changing focus of window will popup the window to access clipboard

rdpfilesdelete = "yes"; //or "no" delete user files stored on the gateway after exiting rdp session
                        //shared folder is not involved! files stored there remain until removed by someone

attachloginonfolder = "yes"; //to access files remotely the login name can be attached to unique folder for administrators purpose.
                             //set to no if you experience problems with logins containing non latin characters.

sharedfolder = "no"; //or yes.. include sharedfolder to be accessible by every user

xhrreverse = true; //use xhr instead websockets, if recognized the usage of reverse proxies in environment, it may help 50/50,
                   //old reverse proxies do not allow persistent connections for each request, neither websocket are supported by them
                   //this option does not ensure the auto recognizing of the reverse proxy usage by browser
                   //if reverse proxy does not support Websockets, try to set below> disable_web_socket = true

xhrprintfilefolder = ""; //additionally separate folder for print/files can be given helping in rare case to override xhr limits.
                         //usable with reverse proxy like apache.

xhrprintfilefolderport = 0; //different port to fake new xhr request for print/files

xhrmaxsize = 40000; //max size of xhr packet

disablewebsocket = false; //IMPORTANT, disabling Websockets is very dangerous due instability of used XHR-polling instead
                          //especially on long distances, use it on your own risk!
                          //Do not touch, if Websocket connection can be established! Xhr-polling helps sometimes by reverse proxies.

forcesslforxhr = true; //force always ssl for xhr due stability on long ping distances
                       //the HTML5 RDP client supports on same port https and http
                       //so if user calls http page, it reloads the page to https alternative on same port
                       //as example, before http://server.com/software/html5.html (port 80 by default)
                       //after https://server.com:80/software/html5.html
                       //websockets are not handled like xhr, so wished layer is used by default main portal protocol.

forcealways_ssl = false; //if set to true, the page will always forward to https address enforcing secured connection (on same port)

startfolder = "software"; //to correctly recognize, if reverse proxy used, it is needed to know, which folder 
                          //follows after main domain name. On reverse proxies it follows after proxy link folder
                          //the software folder is standard in this installation.

showinputbutton = false; //for fast input access of mobile keyboard show red input field when user enters an
                         //editable area. Very useful, if user wants to reposition the cursor fast

show_button_prefer_soft = true; //When software keyboard activated, prefer it in place of native keyboard

alertonorientationchange = false; //if you want to be alerted, when orientation changes, set to true.

usebinaryifpossible = "yes"; //use binary transfer for websocket, when possible and supported by browser environment.
                             //set to no if problems experienced with such browsers

showmainmenu = "all";      //possible all, no, mobile > when set to mobile, the menu is showed only on mobile devices.

newstylemenu = true;       //new style menu (work on Native Android browser partially only -> newstyleforceon_bad_browsers)

newstyleforceonbadbrowsers = false; //not recommended, when set to true, the Android 2.* mobile will reuse it too
                                    //but the menu will not be showed when zoomed, therefore false to stay by old design for these browsers

nowarnings = false; //when set to true, you will get no warnings at all, or set to false to inform about

followcursor = true; //when set to true, the round menu will follow cursor on mobile browsers

imgsizemobile = 9; //=1/9 of screen size (size of mouse menu)
imgsizepc = 17;    //=1/17 of screen size
imgswitchpos = 75; //initial position of mouse icon on 75% of left side, where supported

actionnewposition = 50; //50% position of action button on screen for new design

imgswitchposnewdesign = 90; //initial position of mouse notify icon(moving, clicking etc) by new design for compatibility purpose

ctraltdel = "mobile";      //possible all, no, mobile -> handles if the menu entry should initiate the action

imgswitchpospersistent = true; //when set to true, after moving the mouse icon the position will be saved persistently
                               //on new style menu the action button position will be saved.

imgtomenuratio = 0.8;   //the size of menu images in correlation to mouse image on mobile devices
imgtomenuratiopc = 1.1; //the size of menu images in correlation to mouse image on pc devices
imgtomenurationewdesign = 1.2;   //the size of round icon in correlation to "imgtomenuratio" for new design

onkeybnewdesignhide = true; //to avoid static toolbar bug in iOS Safari when entering keyboard mode on new design the toolbar gets auto hidden

imgmenuresize = false; //when set to true, the round menu-icon will adjust its size to device view
                       //when set to false, the menu-icon will resize with the rest page.

imgcurtomenutop = 2.8; //divider 100/3 = 33% cursor covering image position in correlation to each other from top
imgcurtomenuleft = 2.8; //divider 100/3 = 33% cursor covering image position in correlation to each other from left

menucenterdouble = false; //when set to true, short touch inside mouse menu produces double click
                          //when set to false, just mouse down/up, also usual click.

showprintbutton = "all"; //mobile, all, no
lefttopasmiddlepoint = false; //the left top corner of mouse pad should act as screen or as pad middle point
showmousescroll = "yes"; //yes or no, refers only to mobile version old style, by default off on pc (mouse scroll icon in menu)
showmouseoncebegin = "new"; //show mouse icon on session entering only once: "both", "old", "new", "none" (mobile browsers only)
addspacebymousepad = true; //when mouse pad is showed, the body view gets 50% of size added

preferchars = true;  //makes sense only on PC browsers! Mobile browsers use it by default!
                     //when set to true, than the keys are retrieved from chars instead keycodes, this method should be used,
                     //when keycodes deliver wrong codes and the target system uses only one language.
                     //but if everything works fine by default with "false", do not change than!

cmdline = ""; //initial parameter

clickoutofcursor = true; //or false, when set to true the touching out of cursor area will move mouse + produce mouse down mouse up action on end.
                         //when set to false the touching out of cursor will just move the cursor to wished position
                         //touching on cursor area will always produce mouse down mouse up action. Fast double touches are not involved.

mousefollowontouches = true; //follow mouse on touches, true or false

autoiconjump = false; //use automatic jumping or not (only when mouse_follow_ontouches false)
                      //own implementations can be added in autojump.js

extrakeypadhandling = 2; //0 disable, 1 keypad without conversion, 2 keypad without conversion + auto numlock activation

logintoconsole = false; //win2003 etc.
sendidlemovements = true; //send idle movements to avoid disconnection

allowtheming = 3;    //0 = disable all

default_color = 16; //15, 16, 24, 32

forceoldprintstyle = "all"; //no, all, pc, mobile, ios

forceprinttext = "<p><strong><font color=\"#68838B\"><center>&nbsp;Action&nbsp;complete&nbsp;-&nbsp;click&nbsp;to&nbsp;view&nbsp;PDF&nbsp;<\/center><\/p>";
downfiletext = "<p><strong><font color=\"#68838B\"><center>&nbsp;Action&nbsp;complete&nbsp;-&nbsp;click&nbsp;to&nbsp;download&nbsp;file&nbsp;<\/center><\/p>";

chromeignoreprintissue = false; //true causes autopopup of chromes pdf module which produces engine pause issue while displayed and leading so to connections timeout.
forceoldfilestyle = "no"; //no, all, pc, mobile, ios

forcefiletext = "<p><strong><font color=\"#68838B\">POPUP&nbsp;BLOCKED!&nbsp;CLICK&nbsp;PLEASE!<\/font><\/strong><\/p>";

flipprintprot = false; //flip protocol for printing, avoid some browser connection limits
flipfileprot = false; //flip protocol for file download, avoid some browser connection limits

playsound = true; //true or false to play sound
playSoundFlashFallback = true; //If no one Web audio api supported, use Flash fallback!
fillBufferMax = 3; //number of prebufferred audio packets before playing

reconnectonresize = false; //when true, the resizing will cause reconnect enforcing new session size
full_screen = 0; //when 0, usual mode, 1 = full screen with fixed task bar, 2 = full screen size, by no fullscreen support it gets disabled.
mobilescroll = 0; //scrolling direction on mobile devices, 0 = default, 1 = opposite direction
callparentclose = false; //if page runs under iframe, call parents close on page closing.

preferunicode = true; //by unrecognized char code map or chinese, japanese, korean etc. prefer direct unicode input.
handlecapslock = false; //if true, the capslock activated out of focus may be so recognized.

newmenuopacity = "60"; //by default 60% opacity

smartfit = true; //only for PCs in RDP mode, when set to true, the html5 client will try to fit the session into screen and it will be squeezed into available area and will be resized by changing the browsers dimensions.

smart_fit_save = false; //the recognized best view will be saved and restored by true.

server_follow = false; //when true, the page will reload to real server if differs allowing so direct connection.

webport = ""; //when set, port will be preferred to follow instead recognized from main server.

gooutofiframe = true; //if true, the client will reload to top layer.

splashonclickremove = true; //if true, the splash screen can be fast removed by onclick event.

viewportwidth = "1024"; //initial width of session on mobile devices, height gets computed by browser.

landscape_fitratio = false; //if mobile device is in landscape mode, the width will be multipled with width to height ratio.

connectiontimeout = "40"; //between 20-160 seconds in 10 seconds step, or 0 to disable timeout.
connectionmessage = true; //if true, the message countdown for any new connection will be shown.

disconnectmessage = true; //if true, the message on disconnect will be shown.

send_logoff = true; //if true, by event of browser closing (if notificated by browser), the session disconnets and logoff command gets sent to session.

printenabled = true; //if false, the printing gets disabled.

topButtonWidth = "100%"; //top menu icons size

ios_cursor_into_view = true; //if true, this may avoid ios scrolling to touched finger but scroll to cursor instead.

base64onbinary = false; //if true, the binary transfer will use base64 encoding.

emulate_tab = "ios"; //on iOS devices the switching button for editable fields will emulate Tab button, other systems do not have such extra buttons.

write_via_temp_file = false; //if true, the file written to rdp drive will be written firstly to temporary file before moving to final file.

frame_numbers = "80:120"; //frame tiles number low and upper limit.

showrightclick = false; //mobile only, if true, the right click button in new menu visible.

showmousedrag = false; //mobile only, the mouse drag button in new menu visible.

softMobileKeyboard = "mobile"; //use software emulated keyboard.

newMenuHideOnSoftKeybShow = true; //When new menu used and soft keyboard called, unroll the menu after keyboard appeared.

sendTimeZone = true; //Send browsers time offset - requests activated time zone redirection with gpedit.msc on server

show_fix_keyb_button = true; //When true, the button for pinning the soft keyboard displayed.

maxLoudness = 0.2; //Max loudness which will be auto adjusted.

nativerdp = "all"; //no, all, pc, mobile, when enabled, the native rdp protocol will be forced (Websockets only, xhr is too fragil for native RDP).

nativerdp_compression_level = 4; //0=no compression, 9=max compression, higher values are not really better.

touch3_keyboard_show = true; //Mobile only, when true, and editable cursor displayed, as example in editable field, any 3 fingers touching will call keyboard if 3 touch supported by device.

splashscreencontent = "<br /><br /><br /><TABLE BGCOLOR=\'#FFFFFF\' BORDER=0 BORDERCOLOR=\'#FFFFFF\' CELLPADDING=0 CELLSPACING=0 width=\'100%\'><TR><TD WIDTH=\'100%\' HEIGHT=\'100%\' BGCOLOR=\'#FFFFFF\' ALIGN=\'CENTER\' VALIGN=\'MIDDLE\'><br /><br /><h1 font-family: Segue UI; style=\'color:#68838B\'> Your online security is important to us.<br /> Please wait while we secure your connection ...</h1><br /><IMG SRC=\'html5/imgs/ring64.gif\' BORDER=0><br /><br /></TD></TR></TABLE>"; //splash screen message
