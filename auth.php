<?php
	function auth($login, $passwd)
	{
		$file = file_get_contents('private/passwd');
		$array = unserialize($file);
		foreach ($array as $elem)
		{
			if ($elem['login'] === $login)
			{
				if ($elem['passwd'] === $passwd)
					return true;
				else
					return false;
			}
		}
		return false;
	}
?>