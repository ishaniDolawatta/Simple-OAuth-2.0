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
							var list = '<ul>'
							for (var i = 0; i < response.items.length; i++) {
								list +="<li style=\"padding-bottom: 15px;\"> <img style=\"padding-right: 15px;\" src="+response.items[i].iconLink+"></img> <a target=\"_blank\" style=\"padding: 12px;display: contents;font-size: 20px;\" href="+response.items[i].embedLink+">"+response.items[i].title+"</a></li>";
							}
							list += '</ul>';
							$("#fileList").append(list);
							document.getElementById("files").innerHTML = list;
					},
					error: function (xhr, ajaxOptions, thrownError) {
							var errorMsg = 'Ajax request failed: ' + xhr.responseText;
							console.log('Ajax request failed',errorMsg);
						  }
				});
			}
// 			function uploadFile(){
// 				$client = getClient();
// 				$service = new Google_Service_Drive($client);

// 				$optParams = array(
// 				'pageSize' => 10,
// 				'fields' => 'nextPageToken, files(id, name)'
// 				);
// 				$results = $service->files->listFiles($optParams);

// 				if (count($results->getFiles()) == 0) {
// 					print "No files found.\n";
// 				} else {
// 					print "Files:\n";
// 					foreach ($results->getFiles() as $file) {
// 						printf("%s (%s)\n", $file->getName(), $file->getId());
// 					}
// }
// 			}
			
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
	<div>
	<div class="row" >
		<div class="card hovercard">
			<form action="https://accounts.google.com/o/oauth2/v2/auth?client_id=610790991984-vikl8floe280nheoau5e016r1le7l78m.apps.googleusercontent.com&response_type=code&scope=https://www.googleapis.com/upload/drive/v2/"+exampleFormControlFile1+"&redirect_uri=http://localhost/googleapis/drive/process.php&access_type=offline" method="post">
				<div class="form-group">
						<div class="title">
						<h2 style="color: darkgray;">Upload  files</h2>
						</div>
					<input  style="padding: 16px;width: fit-content;font-size: 20px;color: #428bca;"type="file" class="form-control-file" id="exampleFormControlFile1">
					<button type="submit" class="btn-primary btn-lg">Upload File</button>
				</div>
			</form>
		</div>
	</div>

		<div class="row" >
				<div>
            <div class="card hovercard">
                <div class="info">
                    <div class="title">
						<h2 style="color: darkgray;">Drive Files</h2>
                    </div>
					<div id="files">
						
                    </div>				

                </div>
                <div class="bottom">
                </div>
            </div>
        </div>
			</div>
</div>
</body>
</html>