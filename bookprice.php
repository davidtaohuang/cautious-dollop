<?php
	function bookprice($name)
	{
		$books = unserialize(file_get_contents('private/books'));
		foreach ($books as $elem)
		{
			if ($elem['name'] === $name)
				return $elem['price'];
		}
		return 0;
	}
?>