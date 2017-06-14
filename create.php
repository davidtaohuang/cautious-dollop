<?php
	session_start();
	if ($_GET['submit'] === 'OK' && $_GET['login'] != '' && $_GET['passwd'] != '')
	{
		if (!file_exists('private'))
			mkdir('private');
		if (file_exists('private/passwd'))
		{
			$file = file_get_contents('private/passwd');
			$array = unserialize($file);
			foreach ($array as $elem)
			{
				if ($elem['login'] === $_GET['login'])
				{
					$error = "User already exists.\n";
					break ;
				}
			}
		}
		if (!$error)
		{
			$array[] = ['login' => $_GET['login'], 'passwd' => hash('whirlpool', $_GET['passwd']),];
			file_put_contents('private/passwd', serialize($array));
			header('Location: index.php');
		}
	}
	elseif (!$_GET['passwd'])
		$error = "Invalid password.\n";
?>
<html>
<body>
<?php
	if ($error)
		echo $error;
?>
<form method="get" action="create.php">
	Username: <input type="text" name="login" value="<?php echo $_GET['login']; ?>" />
	<br />
	Password: <input type="password" name="passwd" />
	<br />
	<input type="submit" name="submit" value="OK" />
</form>
</body>
</html>
