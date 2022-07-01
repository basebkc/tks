var YOUR_CLIENT_ID = '750447779561-1jj0pchgfq34ma68o6i8a9iluketkc23.apps.googleusercontent.com';
  //var YOUR_REDIRECT_URI = 'http://cirebonproperty.id/antrian/index.php/Antrian/create';
      
  var YOUR_REDIRECT_URI = 'http://cirebonproperty.id/IDEB/index.php/Antrian/create';
  //var YOUR_REDIRECT_URI = 'http://127.0.0.1/antrian/index.php/Antrian/create';
  var fragmentString = location.hash.substring(1);
  var access_token ='';
  // Parse query string to see if page request is coming from OAuth 2.0 server.
  var params = {};
  var regex = /([^&=]+)=([^&]*)/g, m;
  while (m = regex.exec(fragmentString)) {
    params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
  }
  if (Object.keys(params).length > 0) {
    localStorage.setItem('oauth2-test-params', JSON.stringify(params) );
    if (params['state'] && params['state'] == 'try_sample_request') {
      trySampleRequest();
    }
  }

  function trySampleRequest() {
    var params = JSON.parse(localStorage.getItem('oauth2-test-params'));
    if (params && params['access_token']) {
      access_token = params['access_token'];
      var xhr = new XMLHttpRequest();
      xhr.open('GET',
      'https://www.googleapis.com/drive/v3/about?fields=user&' +
      'access_token=' + params['access_token']);
      xhr.onreadystatechange = function (e) {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log(xhr.response);
        } else if (xhr.readyState === 4 && xhr.status === 401) {
          // Token invalid, so prompt for user permission.
          oauth2SignIn();
        }
      };
      xhr.send(null);
    } else {
      oauth2SignIn();
    }
    //console.log(params);
  }

  function oauth2SignIn() {
    // Google's OAuth 2.0 endpoint for requesting an access token
    var oauth2Endpoint = 'https://accounts.google.com/o/oauth2/v2/auth';

    // Create element to open OAuth 2.0 endpoint in new window.
    var form = document.createElement('form');
    form.setAttribute('method', 'GET'); // Send as a GET request.
    form.setAttribute('action', oauth2Endpoint);

    // Parameters to pass to OAuth 2.0 endpoint.
    var params = {'client_id': YOUR_CLIENT_ID,
                  'redirect_uri': YOUR_REDIRECT_URI,
                  'scope': 'https://www.googleapis.com/auth/drive',
                  'state': 'try_sample_request',
                  'include_granted_scopes': 'true',
                  'response_type': 'token'};

    // Add form parameters as hidden input values.
    for (var p in params) {
      var input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', p);
      input.setAttribute('value', params[p]);
      form.appendChild(input);
    }

    // Add form to page and submit it to open the OAuth 2.0 endpoint.
    document.body.appendChild(form);
    form.submit();
  }
 
  const accessToken = access_token; // Please set access token here.

  document.getElementById("uploadfile").addEventListener("change", run, false);

  function run(obj) {
    var LINK = window.location.href;
    document.getElementById("LINK").value=LINK;
    trySampleRequest();
    const file = obj.target.files[0];
    if (file.name != "") {
      let fr = new FileReader();
      fr.fileName = file.name;
      fr.fileSize = file.size;
      fr.fileType = file.type;
      fr.readAsArrayBuffer(file);
      fr.onload = resumableUpload;
      // console.log(fr.fileName);
    }
  }

  function resumableUpload(e) {
    document.getElementById("progress").innerHTML = "Initializing.";
    const f = e.target;
    const resource = {
      fileName: f.fileName,
      fileSize: f.fileSize,
      fileType: f.fileType,
      fileBuffer: f.result,
      accessToken: accessToken
    };
    
    const ru = new ResumableUploadToGoogleDrive();
    ru.Do(resource, function(res, err) {
      if (err) {
        console.log(err);
        return;
      }
      var a = JSON.stringify(res.result);
      document.getElementById("getRes").value = a;
      console.log(JSON.stringify(a));
      let msg = "";
      if (res.status == "Uploading") {
        msg =
          Math.round(
            (res.progressNumber.current / res.progressNumber.end) * 100
          ) + "%";
      } else {
        msg = res.status;
      }
      var stat = document.getElementById("progress").innerText = msg;
      if (stat=="Done") {
        document.getElementById("myBtn").disabled = false;
      }
    });

  }

    
      

    function cek() {
       var nama = document.getElementById("nama").value;
       var no_ktp = document.getElementById("no_ktp").value;
       var tempat_lahir = document.getElementById("tempat_lahir").value;
       var tgl_lahir = document.getElementById("datepkr").value;
       if (nama!='' &&no_ktp!='' &&tempat_lahir!=''&&tgl_lahir!='') {
            document.getElementById("uploadfile").disabled = false;
       }else{
            document.getElementById("uploadfile").disabled = true;

       }
    }

    function tanpa_file(){
        document.getElementById("myBtn").disabled = false;     
        document.getElementById("uploadfile").required = false;     
    }
    function dengan_file(){
        document.getElementById("myBtn").disabled = true;     
    }