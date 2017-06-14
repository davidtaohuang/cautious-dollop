<?php
	function bookquantupdate($name, $diff)
	{
		foreach ($books as $key => $value)
		{
			if ($value['name'] === $_GET['bname'])
			{
				if ($value['quantity'] > $_GET['quantity'])
				{
					$books[$key]['quantity'] = $value['quantity'] - $_GET['quantity'];
					$error = $_GET['quantity']." copies of ".$value['name']." have been added to your cart.";
					file_put_contents('private/books', serialize($books));
					addcart($value['name'], $_GET['quantity']);
				}
				else
					$error = "You can only add up to ".$value['quantity']."copies of ".
						$value['name']." to your cart.\n<br />";
				break;
			}
		}
	}
?>