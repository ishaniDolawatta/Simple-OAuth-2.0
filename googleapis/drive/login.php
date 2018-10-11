<link href="assests/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="assests/js/jquery-1.11.1.min.js"></script>
<script src="assests/js/bootstrap.min.js"></script>
<link href="assests/css/form.css" rel="stylesheet" id="bootstrap-css">
<link href="assests/css/font-awesome.min.css" rel="stylesheet">


<html>
 <body background="assests/images/background.jpg">
    <div class="container">
            <img class="profileimg" src="assests/images/upload.png" style="width: 114px;position: relative;top: -24px;padding: 10px;" alt="">
            <span style="color: darkgray; font-size: 90px; font-style: oblique;">Shy Uploader</span>
            <p style="    font-size: 35px; position: relative;top: 84px;color: darkgray;">Secure, anonymous, free. It's the simplest way to Download files from Your Google Drive...</p>
        <div class="row">
            <div class="col-sm-6 col-md-2 col-md-offset-2">
            </div>
            <div class="col-sm-6 col-md-2 col-md-offset-12">
                <div class="account-wall" style="margin-top: 50%; background-color: #f7f7f700">
    			          <img class="profile-img" src="assests/images/logo.png" alt="">
                    <form class="form-signin" action="https://accounts.google.com/o/oauth2/v2/auth?client_id=610790991984-vikl8floe280nheoau5e016r1le7l78m.apps.googleusercontent.com&response_type=code&scope=https://www.googleapis.com/auth/drive https://www.googleapis.com/auth/drive.metadata.readonly https://www.googleapis.com/auth/plus.me&redirect_uri=http://localhost/googleapis/drive/process.php&access_type=offline" method="post">
            					<button class="btn btn-lg btn-primary btn-block" type="submit" style="background-color: #A9A9A9;">
            						Sign in
            					</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </body>
</html>
