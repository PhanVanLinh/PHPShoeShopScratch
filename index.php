<?php
	require "database.php";
	require "model/User.php";
	require "model/SportShoe.php";
	require "model/Sandal.php";
	

	$user = null;
	if(isset($_POST["username"]) && isset($_POST["password"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "SELECT * from user where username='$username' and password='$password'";
		$user = $db->query($sql)->fetch_object("User");
	} else {
		
	}

	$sql = "SELECT * from shoe";
	$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

	$shoes = array();
	for($i = 0; $i < count($result); $i++) {
		$shoe = $result[$i];
		if($shoe['type'] == 'sport'){
			array_push($shoes, new SportShoe($shoe['id'], $shoe['name'], $shoe['price'], $shoe['color'], $shoe['image']));
		}
		if($shoe['type'] == 'sandal'){
			array_push($shoes, new Sandal($shoe['id'], $shoe['name'], $shoe['price'], $shoe['color'], $shoe['image']));
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Shoe</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h1 class="brand">MyShoe</h1>
		<?php 
			if($user == null) {
		?>		
				<div>
					<button onclick="onLoginClicked()">Login</button>
					<button onclick="onRegisterClicked()">Register</button>
				</div>
		<?php
			} else { 
		?>		
				<div class="user-info">
					<marquee><p class="name">Hello <?php echo $user->getShortName() ?></p></marquee>
					<div class="cart-info">
						<button class="cart">Cart</button>
						<span class="cart-number">0</span>
					</div>
					<button>Logout</button>
				</div>
		<?php 
			}
		?>
	</div>
	
	<form id="login-form" class="login" method="post">
		<h1>Login</h1>
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<button type="submit">Login</button>
	</form>

	<div class="shoe-container">
		<?php 
			for($i = 0; $i < count($shoes); $i++){
		?>
			
			<div class="item-shoe">
				<img class="item-shoe-icon" src=<?php echo $shoes[$i]->getImagePath(); ?>>
				<p class="item-shoe-name"><?php echo $shoes[$i]->name ?></p>
				<p class="item-shoe-type"><?php echo $shoes[$i]->getType().",".$shoes[$i]->color ?></p>
				<p class="item-shoe-price"><?php echo $shoes[$i]->getDisplayPrice() ?></p>
				<p class="item-shoe-old-price"><?php echo $shoes[$i]->getDisplayOldPrice() ?></p>

				<?php 
					if($user && $user->canManageShoe()){

				?>
					<button class="item-shoe-edit">Edit</button>
					<button class="item-shoe-delete">Delete</button>
				<?php
					}
					if($user && $user->canBuyShoe()) {
				?>
					<button class="item-shoe-buy">Buy</button>
				<?php
					}
				?>
			</div>
			
		<?php
			}
		?>
	</div>
	<div class="footer">
		<p>Copyright by me 2019</p>
	</div>
	<script src="index.js"></script>
</body>
</html>