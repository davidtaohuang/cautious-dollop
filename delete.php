<?php
	include 'auth.php';

	session_start();
	if ($_SESSION['logged_on_user'] != '' && $_SESSION['logged_on_user'] !== 'admin' &&
		$_GET['passwd'] != '' && $_GET['submit'] === 'OK')
	{
		$file = file_get_contents('private/passwd');
		$array = unserialize($file);
		foreach ($array as $key => $value)
		{
			if ($value['login'] === $_SESSION['logged_on_user'])
			{
				if ($value['passwd'] === hash('whirlpool', $_GET['passwd']))
				{
					unset($array[$key]);
					array_values($array);
					file_put_contents('private/passwd', serialize($array));
					header('Location: logout.php');				}
				else
					$error = "Invalid password.\n";
				break;
			}
		}
	}
	elseif (!$_GET['submit'])
		$error = '';
	elseif ($_SESSION['logged_on_user'] === 'admin')
		$error =  "ERROR: You cannot delete the admin account.\n";
	elseif (!$_GET['passwd'])
		$error = "Invalid password.\n";
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
<?php
	if ($error)
		echo $error;
?>
<form method="get" action="delete.php">
	Are you sure you want to delete your account?
	<br />
	Enter your password and click ok to proceed.
	<br />
	Password: <input type="password" name="passwd" />
	<br />
	<input type="submit" name="submit" value="OK" />
</form>
<br />
<a href="index.php">Back to index</a>
<br />
<a href="basket.php">Back cart/account</a>
<br />
</body>
</html>
