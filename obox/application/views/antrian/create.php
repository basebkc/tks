  <?php //$this->load->view('antrian/antrian_sweetalert') ?>
    <style type="text/css">
  .img{
    position: relative;
    z-index: 1;
    top: 0px;
  }
  .pp{
    position: absolute;
    top: 25px;
    font-size: 250%;
    font-weight: bold;
    z-index: 2;
    color: #fff;
  }
  .pp2{
    text-align: center;
    font-size: 150%;
    margin-bottom: 5%;
    font-weight: bold;
  }
  </style>
 <h1 class="mt-4">Interface</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Forms Input Antrian <? cur(); ?></li>
                        </ol>
<table width="100%">
  <tr>
    <td style="padding-left: 10%">
      <div class="contact1-form validate-form ">
      <form method="post" action="<?= site_url(empty($button)?'antrian/create_action':'antrian/update_action') ?>">
        <input type="text" hidden="hidden" class="form-control" name="no_antrian" id="no_antrian" placeholder="no_antrian" value="<?= no_antrian(); ?>" />
       
            <?php if (!empty($no_antrian)): ?>
          <input hidden class="form-control py-4" type="text" name="id_antrian" placeholder="id_antrian" value="<?= empty($id_antrian)?null:$id_antrian; ?>"> 
          <input hidden class="form-control py-4" type="text" name="no_antrian" placeholder="no_antrian" value="<?= empty($no_antrian)?null:$no_antrian; ?>"> 
            <?php endif ?>

        <div class="wrap-input1 validate-input">
          <input class="form-control py-4" type="text" name="nama" placeholder="Nama" value="<?= empty($nama)?null:$nama; ?>">  
        </div>

        <div class="wrap-input1 validate-input">
          <input class="form-control py-4" type="text" name="no_ktp" placeholder="NO KTP" value="<?= empty($no_ktp)?null:$no_ktp; ?>">
        </div>
        <div class="wrap-input1 validate-input">
          <input class="form-control py-4" type="text" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= empty($tempat_lahir)?null:$tempat_lahir; ?>" />
        </div>

        <div class="wrap-input1 validate-input">
          <table>
            <tr><td>Tgl Lahir</td></tr>
            <tr>
              <td>
                <div class="dates">
                    <input type="text" name="tgl_lahir" autocomplete="off" id="datepkr" class="form-control" placeholder="yyyy-mm-dd"   onchange="get_age()" value="<?= empty($tgl_lahir)?null:$tgl_lahir; ?>">
                  </div>
              </td>
              <td>
                <input class="form-control " type="text" name="umur" id="umur" placeholder="Umur Pegawai" data-date-format="yyyy-mm-dd" required readonly="readonly">
                  
              </td>
            </tr>
          </table>
        </div>
              
        <div class="wrap-input1 validate-input" >
          <input name="file" id="uploadfile" type="file" />
            <div id="progress"></div>
        </div>

        <div class="container-contact1-form-btn">
          <button class="btn btn-primary">
            <span>
              <?= empty($button)?"Ambil Antrian":"Update"; ?>
              <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </span>
          </button>
        </div>
      </form>
      </div>
    </td>
      <td>
        <img  src="<?= base_url('assets/images/bg_antrian4.png') ?>" alt="IMG">
      <div class="contact1-pic ">
        <?php if (empty($sukses)|| !empty($button)){?>
          <div class="pp2" >
          <font face="Arial Black" >NO ANTRIAN ANDA</font></div>
          <div style="margin-bottom: 6%" align="center" >
          <img width="20%"  src="<?= base_url('assets/images/panah.png') ?>" alt="IMG">
          </div>
          <div class="img">
          <img  src="<?= base_url('assets/images/bg_antrian4.png') ?>" alt="IMG">
          <p  style="margin-left: 8.5%" class="pp" >
            <!-- <?= empty($button)?$sukses:$no_antrian; ?> -->
              584.3/00001/PD.BPR-BABAKAN/03/2020
            </p>
          </div>
        <?php }else{ ?>
          <img src="<?= base_url('assets/images/antrian.png') ?>" alt="IMG">
        <?php } ?>
<button onclick="trySampleRequest();">Try sample request</button>
        
      </div>
    </td>
  </tr>
</table>


<script>
  var YOUR_CLIENT_ID = '736313212879-26s278elr4oa39poeo5psf2d54sk2g5f.apps.googleusercontent.com';
  var YOUR_REDIRECT_URI = 'http://192.168.0.109/antrian/index.php/home/upload_file';//http://localhost/GMF/coba/cobain';
  var fragmentString = location.hash.substring(1);

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


// state: "try_sample_request"
// access_token: "ya29.a0Adw1xeWSL0O8l6KnsxcH5Pb3tSgcH_PwsWbBz_KUfxqNvBTeHIgWRMydM7p6w2Dp_hG8ypbMmZrLnXs9vwzVHJfB_9SAtu9E28BUoAey14-0Kr7MQ4HwoURSACGjUmg47HAwWEUY06G5hq8a-zQPHtH-SZaSrgDWVyw"
// token_type: "Bearer"
//ya29.a0Adw1xeUVTL_ROKdvX_BbCBtuSFmLMdlkkvPDBG9CAFL6HPJm0fw0jEgppczBrhctw0Fj2VU8UqIEieSg3KcikyQ2oTuI-janvwAiGXK1V0c4jztNQRAlKahgoxZLISKASrhZHP0pfvF33X50lL8G9jDNFIFH-_K3lX0"



  // If there's an access token, try an API request.
  // Otherwise, start OAuth 2.0 flow.
  function trySampleRequest() {
    var params = JSON.parse(localStorage.getItem('oauth2-test-params'));
    if (params && params['access_token']) {
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
    console.log(params);
  }

  /*
   * Create form to request access token from Google's OAuth 2.0 server.
   */
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
                  'scope': 'https://www.googleapis.com/auth/drive.metadata.readonly',
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
    // {
    //   "access_token": "ya29.a0Adw1xeXmlQj1UnG5FZTKu8cLw_fUY2MGyzpcJgeH_Xvo4N_ukyiMWaM_zkuVZtpa6W-PJGdJaLQQa6MGxQ1y39qXUV8d94TUicnJmwkLam4VRBahOjPZlISjSTtHhjUQCj3ergWrDpkd_MdMvZSJhGulO30R4EViccw", 
    //   "scope": "https://www.googleapis.com/auth/drive", 
    //   "token_type": "Bearer", 
    //   "expires_in": 3599, 
    //   "refresh_token": "1//04_ymgXZxHglsCgYIARAAGAQSNwF-L9IrSeArTj-WtXMEPGxztPeNMEQn-pX75Kzcy2gMEjenpGzbFBfUnDQEeMkZJ2ZWiHMMp2g"
    // }

    // {
    //   "access_token": "ya29.Il_BBy2hLeA3vWwBHGdypD_D_B7zlRDsTT4F03_cab7S1pTS6HprmSBFQQNdO-oP2Xs7A_M_qgzuXEh-gMdsfd7R0u9mSm-R-snzOE-I83VIIdoQ-q1XuauAC-5Bxy6Vag", 
    //   "scope": "https://www.googleapis.com/auth/drive", 
    //   "expires_in": 3599, 
    //   "token_type": "Bearer"
    // }
  var access_token = params['access_token'];//'ya29.a0Adw1xeXmlQj1UnG5FZTKu8cLw_fUY2MGyzpcJgeH_Xvo4N_ukyiMWaM_zkuVZtpa6W-PJGdJaLQQa6MGxQ1y39qXUV8d94TUicnJmwkLam4VRBahOjPZlISjSTtHhjUQCj3ergWrDpkd_MdMvZSJhGulO30R4EViccw';
  const accessToken = access_token; // Please set access token here.

  document.getElementById("uploadfile").addEventListener("change", run, false);

  function run(obj) {
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
      console.log(res);
      let msg = "";
      if (res.status == "Uploading") {
        msg =
          Math.round(
            (res.progressNumber.current / res.progressNumber.end) * 100
          ) + "%";
      } else {
        msg = res.status;
      }
      document.getElementById("progress").innerText = msg;
    });
  }
</script>

