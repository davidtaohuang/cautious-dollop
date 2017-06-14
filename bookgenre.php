<?php
	function bookgenre($name)
	{
		$books = unserialize(file_get_contents('private/books'));
		foreach ($books as $elem)
		{
			if ($elem['name'] === $name)
				return $elem['genre'];
		}
		return 0;
	}
?>