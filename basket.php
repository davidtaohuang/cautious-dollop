<?php
	include 'countcart.php';
	include 'bookprice.php';
	include 'bookquant.php';

	session_start();

	$carts = unserialize(file_get_contents('private/carts'));
	$books = unserialize(file_get_contents('private/books'));

	if ($_GET['submit'] === 'Update' && $_GET['name'] != '')
	{
		
	}
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
	if ($_SESSION['logged_on_user'])
	{
		echo '<a href="modif.php">Change Password</a> <br />';
		echo '<a href="delete.php">Delete Account</a> <br />';
	}
?>
<br />
<a href="index.php">Back to index</a>
<br />

<?php
	if ($carts)
	{
		$count = countcart($carts);
		$total;
		echo 'You have '.$count.' items in your cart. <br /><br />';
		foreach ($carts as $elem)
		{
			if ($elem['user'] === $_SESSION['logged_on_user'])
			{
				echo bookquant($elem['books']['name']);
				$price = bookprice($elem['books']['name']);
				$total += $price * $elem['books']['quantity'];
				echo "Name: ".$elem['books']['name'].'<br />'."\n";
				echo '<form action="browse.php" method="get">'."\n";
				echo '<input type="number" min=0 max='.bookquant($elem['books']['name']).' name="quantity" value="'.
					$elem['books']['quantity'].'" >'."\n";
				echo '<input type="hidden" name="name" value="'.$elem['books']['name'].'"'.">\n";
				echo '<input type="submit" name="submit" value="Update">'."\n";
				echo 'Price: $'.$price.'<br />';
				echo 'Subtotal: $'.($price * $elem['books']['quantity']).'<br /';
				echo "</form><br />\n";
			}
		}
	}
	else
		echo 'You have 0 items in your cart. <br />';
	echo '<br />';
	echo 'Total: $'.$total.'<br />';
?>
</body>
</html>
