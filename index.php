<!-- //page de connexion -->
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>se connecter</title>
	<link rel="icon" href="logo.jpg" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
		crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		body {
			background-color: #ffffff;
			opacity: 1;
			background-image: radial-gradient(#6D95C9 2px, transparent 2px), radial-gradient(#6D95C9 2px, #ffffff 2px);
			background-size: 80px 80px;
			background-position: 0 0, 40px 40px;
		}

		.white-bloc {
			background: white;
			border-radius: 5px;
			margin-top: 30%;
			box-shadow: 0px 2px 12px 4px #0000001a;
		}

		.error {
			width: 30%;
			margin-left: 35%;
			margin-top: 30px;
			position: absolute;
		}
	</style>


</head>


<body>
	<!-- <?php
// try
// {
// 	$bdd = new PDO('mysql:host=localhost;dbname=gsb_frais_structure;charset=utf8', 'root', '');
// }
// catch (Exception $e)
// {
//         die('Erreur : ' . $e->getMessage());
// }

  

	
	?> -->
	<section class="ftco-section">
		<div class="container">

			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5  white-bloc">
						<div class="text-center" style="margin-bottom:8px">
							<img width="290px" src="./data/logo.jpg" />

						</div>
						<h3 class="text-center mb-4"></h3>
						<form action="./connexion/login.php" method="POST" class="login-form">
							<div class="form-group " style="margin-bottom:5px">
								<input name="login" type="text" class="form-control rounded-left" placeholder="Username"
									required autocomplete="off">
							</div>
							<div class="form-group d-flex" style="margin-bottom:15px">
								<input name="pass" type="password" class="form-control rounded-left"
									placeholder="Password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn rounded submit px-3"
									style="background-color:#6D95C9;color:white">Login</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>