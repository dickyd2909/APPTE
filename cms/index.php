<?php
session_start();
        
if(isset($_SESSION['admin_username'])){
	die ("<meta http-equiv='refresh' content='0; url=templates/index.php?m=dashboard'>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="assets/css/loginpage.css" rel="stylesheet" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets/images/fav.png" rel="shortcut icon" type="image/x-icon" />
	<title>Login Dashboard</title>
</head>
<body>
<div id="container">
			<div id="containerbox">
				<div id="containerbg" class="clearfix">
					<div class="contkiri">
						<div class="contkiriimg">
							<img src="assets/images/login2.webp" alt="">
						</div>
					</div>
					<div class="contkanan">
						<div id="form">
							<div id="formlogin">
								<div id="formcover">
									<div class="formcovertitle">
										LOGIN
									</div>
									<div class="formcoversubtitle">
										Dashboard
									</div>
									<form action="login.php?action=in" method="post" onSubmit="return validasi(this)">
										<input name="admin_username" type="text" class="formcoverinput" placeholder="Username" required />
										<input name="admin_password" type="password" class="formcoverinput" placeholder="Password" required />
										<div class="formcoverbutton">
											<input type="submit" value="LOGIN" name="login" class="loginbutton">
										</div>
									</form>
								</div>
							</div>
						</div>
						<div id="copyright">
							<div class="copyrightlink">
							<a href='https://olshop.maliniart.com/' target='_blank'>VIEW WEBSITE</a>
						</div>
							<div class="copyrightcopy">
								&copy 2023 all right reserved
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>