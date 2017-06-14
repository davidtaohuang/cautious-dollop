<?php
	session_start();
?>
<html>
<header>
<?php
	echo "Welcome ";
	if ($_SESSION['logged_on_user'])
	{
		echo $_SESSION['logged_on_user']."! <br />";
		echo '<a href="logout.php">Logout</a> <br />';
	}
	else
	{
		echo "Guest! <br />";
		echo '<a href="login.php">Login</a> <br />';
		echo '<a href="create.php">Create a New Account</a> <br />';
	}
?>
</header>
<body>
	<br />
	<a href="basket.php">My cart/account</a>
	<br />
	<a href="browse.php">See items</a>
	<br />
</body>
</html>