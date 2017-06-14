<?php
	session_start();
	include "addcart.php";

	$books = unserialize(file_get_contents('private/books'));
	if ($_GET['bname'] != '' && $_GET['quantity'] !== 0 && $_GET['submit'] === 'Add to cart')
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
	elseif (!$_GET['submit'])
		$error ='';
	elseif (!$_GET['quantity'])
		$error = "Must add at least 1 book to cart\n <br />";
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
	echo '<a href="basket.php">My cart/account</a> <br />';
?>
</header>

<body>
<?php
	if ($error)
		echo $error;
	echo "<br />";
	foreach ($books as $key => $value)
	{
		echo "Title: ".$value['name']." [Quantity available: ".$value['quantity']."] ";
		echo "[Price: $".$value['price']."] ";
		echo '<form method="get" action="browse.php?">'."\n";
		echo 'Quantity to buy: <input type="number" name="quantity" min="1" value=1>'."\n";
		echo '<input type="hidden" name="bname" value="'.$value['name'].'"'.">\n";
		echo '<input type="submit" name="submit" value="Add to cart">'."\n";
		echo "</form>\n";
	}
?>
</body>

<footer>
<br />
<a href="index.php">Back to index</a>
<br />
</footer>

</html>
