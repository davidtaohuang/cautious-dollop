<?php
	function countcart($carts)
	{
		session_start();
		$count = 0;
		foreach ($carts as $elem)
		{
			if ($elem['user'] === $_SESSION['logged_on_user'])
				$count++;
		}
		return $count;
	}
?>