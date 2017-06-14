<?php
	include 'auth.php';

	session_start();
	if ($_GET['login'])
	{
		if (auth($_GET['login'], hash('whirlpool', $_GET['passwd'])))
		{
			$_SESSION['logged_on_user'] = $_GET['login'];
			header('Location: basket.php');
		}
		else
		{
			$_SESSION['logged_on_user'] = '';
			$error = "Invalid username/password.\n";
		}
	}
?>
<html>
<body>
<?php
	if ($error)
		echo $error;
?>
<form method="get" action="login.php">
	Username: <input type="text" name="login" value="<?php echo $_GET['login']; ?>"/>
	<br />
	Password: <input type="password" name="passwd" />
	<br />
	<input type="submit" name="submit" value="OK" />
</form>
<br />
<a href="index.php">Back to index</a>
<br />
</body>
</html>
