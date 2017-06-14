<?php
	session_start();
	if ($_GET['submit'] === 'OK' && $_SESSION['logged_on_user'] != '' && $_GET['oldpw'] != ''
		&& $_GET['newpw'] != '' && $_GET['oldpw'] !== $_GET['newpw'])
	{
		$file = file_get_contents('private/passwd');
		$array = unserialize($file);
		foreach ($array as $key => $value)
		{
			if ($value['login'] === $_SESSION['logged_on_user'])
			{
				if ($value['passwd'] === hash('whirlpool', $_GET['oldpw']))
				{
					$array[$key]['passwd'] = hash('whirlpool', $_GET['newpw']);
					file_put_contents('private/passwd', serialize($array));
					$error = "Password changed successfully.\n";
				}
				else
					$error = "Invalid old password.\n";
				break;
			}
		}
	}
	elseif (!$_GET['submit'])
		$error = '';
	elseif (!$_GET['oldpw'])
		$error = "Invalid old password.\n";
	elseif (!$_GET['newpw'])
		$error = "Invalid new password.\n";
	elseif ($_GET['oldpw'] === $_GET['newpw'])
		$error = "New password cannot be the same as the old password.\n";
?>
<html>
<header>
<?php
	echo "Welcome ";
	if ($_SESSION['logged_on_user'])
		echo $_SESSION['logged_on_user'];
	else
		echo "Guest";
	echo "!\n";
?>
</header>

<body>
<?php
	if ($error)
		echo $error;
?>
<form method="get" action="modif.php">
	Old Password: <input type="password" name="oldpw" />
	<br />
	New Password: <input type="password" name="newpw" />
	<br />
	<input type="submit" name="submit" value="OK" />
</form>
<a href="basket.php">Back to cart</a>
<br />
<a href="index.php">Back to index</a>
<br />
</body>
</html>
