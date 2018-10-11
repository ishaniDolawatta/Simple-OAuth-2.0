<link href="assests/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="assests/js/jquery-1.11.1.min.js"></script>
<script src="assests/js/bootstrap.min.js"></script>
<script src="assests/js/config.js"></script>
<link href="assests/css/style.css" rel="stylesheet" id="bootstrap-css">
<link href="assests/css/font-awesome.min.css" rel="stylesheet">

<?php

$token = $_GET["code"];
if (isset($token))
{
?>
	<script src="assests/js/jquery-1.11.1.min.js"></script>
        <script>

			$( document ).ready(function(){

				$.ajax({
					url: 'https://www.googleapis.com/oauth2/v4/token',
					type: 'post',
					header : 'Content-Type: application/x-www-form-urlencoded',
					data: {

						'code': '<?php echo $_GET["code"]; ?>',
						'scope': 'https://www.googleapis.com/auth/drive  https://www.googleapis.com/auth/plus.me',
						'client_id': "610790991984-vikl8floe280nheoau5e016r1le7l78m.apps.googleusercontent.com",
						'client_secret': "50E9GNEOw86l6waROMYQqpBL",
						'grant_type':'authorization_code',
						'redirect_uri':'http://localhost/googleapis/drive/process.php'

					},
					success: function(response){
						console.log(response);
						getUserProfile(response.access_token);
						getDriverfiles(response.access_token);
					},
					error: function (xhr, ajaxOptions, thrownError) {
						var errorMsg = 'Ajax request failed: ' + xhr.responseText;
						console.log('Ajax request failed',errorMsg);
					  }
				});
			});
			function getUserProfile(access_token){
				var url = 'https://www.googleapis.com/plus/v1/people/me?access_token=';
				var res = url.concat(access_token);
				$.ajax({
					url: res,
					type: 'GET',
					header : 'Content-Type: application/x-www-form-urlencoded',
					success: function(response){
							console.log('getUserProfile',response);
							$('#name').text(response.displayName);
							$("#pImage").attr("src",response.image.url);
							$("#name").attr("href",response.url);
							if (response.cover){
								$("#pCover").attr("src",response.cover.coverPhoto.url);
							}
							else {
								$("#pCover").attr("src","http://confirmado.com.ve/conf/conf-upload/uploads/2017/08/Google-Play-630x360.png");
							}

					},
					error: function (xhr, ajaxOptions, thrownError) {
							var errorMsg = 'Ajax request failed: ' + xhr.responseText;
							console.log('Ajax request failed',errorMsg);
						  }
				});
			}

			function getDriverfiles(access_token){
				var url = 'https://www.googleapis.com/drive/v2/files?access_token=';
				var res = url.concat(access_token);
				$.ajax({
					url: res,
					type: 'GET',
					header : 'Content-Type: application/x-www-form-urlencoded',
					success: function(response){
							console.log('getDriverfiles',response);
							var list = response.items;
							$("#fileList").append(list);
					},
					error: function (xhr, ajaxOptions, thrownError) {
							var errorMsg = 'Ajax request failed: ' + xhr.responseText;
							console.log('Ajax request failed',errorMsg);
						  }
				});
			}
        </script>
<?php } ?>

<html>
 <body background="assests/images/background.jpg">
<div class="container">
	<div class="row">
				<div>
            <div class="card hovercard">
				<div class="xx">
				<img  alt="" id="pCover">
                </div>
                <div class="avatar">
                    <img alt="" id="pImage"/>
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" id="name"></a>
                    </div>
                </div>
                <div class="bottom">
                </div>
            </div>
        </div>
	</div>

		<div class="row" >
				<div>
            <div class="card hovercard">
                <div class="info">
                    <div class="title">
						<h3>Google drive files</h3>
                    </div>
										
					<ul id="fileList">
					<?php foreach($array as $key=>$value){ ?>
						<li>
							<a><?php echo $value.title; ?></a>
						</li>
						<?php } ?>
					</ul>

                </div>
                <div class="bottom">
                </div>
            </div>
        </div>
			</div>
</div>
</body>
</html>