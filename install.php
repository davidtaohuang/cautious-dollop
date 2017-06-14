<?php
	if (!file_exists('private'))
		mkdir('private');
	if (!file_exists('private/passwd'))
	{
		$users[] = ['login' => 'admin', 'passwd' => 'anadminisme',];
		file_put_contents('private/passwd', serialize($users));
	}
	if (!file_exists('private/categories'))
	{
		$categories[] = ['genre' => 'fiction'];
		$categories[] = ['genre' => 'nonfiction'];
		$categories[] = ['genre' => 'fantasy'];
		$categories[] = ['genre' => 'sci-fi'];
		file_put_contents('private/categories', serialize($categories));
	}
	if (!file_exists('private/books'))
	{
		$books[] = ['name' => 'The Hitchhiker\'s Guide to the Galaxy',
			'price' => 10,
			'quantity' => 42,
			'genre' => ['fiction' => 1,
				'nonfiction' => 0,
				'fantasy' => 0,
				'sci-fi' => 1,],
			];
		$books[] = ['name' => 'Super Sad True Love Story',
			'price' => 10,
			'quantity' => 15,
			'genre' => ['fiction' => 1,
				'nonfiction' => 0,
				'fantasy' => 0,
				'sci-fi' => 0,],
			];
		$books[] = ['name' => 'Bluh',
			'price' => 10,
			'quantity' => 6,
			'genre' => ['fiction' => 0,
				'nonfiction' => 1,
				'fantasy' => 0,
				'sci-fi' => 0,],
			];
		file_put_contents('private/books', serialize($books));
	}
	echo "Setup done.\n";
?>