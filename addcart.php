<?php
	function addcart($name, $quantity)
	{
		session_start();
		if (file_exists('private/carts'))
			$carts = unserialize(file_get_contents('private/carts'));
		else
			$carts = array();
		foreach ($carts as $key => $value)
		{
			if ($value['user'] === $_SESSION['logged_on_user'])
			{
				if ($value['books']['name'] === $name)
				{
					$carts[$key]['books']['quantity'] += $quantity;
					$found = 1;
					break;
				}
			}
		}
		if (!$found)
			$carts[] = ['user' => $_SESSION['logged_on_user'],
				'books' => ['name' => $name, 'quantity' => $quantity],];
		file_put_contents('private/carts', serialize($carts));
	}
?>