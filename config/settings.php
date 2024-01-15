<?php
	return [

		'slider_path' => 'slider-cycle',

		// Numarul de portfolii pe prima pagina
		'home_port_count' => 5,

		// Numarul de articole pe prima pagina
		'home_articles_count' => 3,

		// Numarul de articole paginare blog
		'paginate' => 2,

		// Numarul de comentarii pe pagina blog
		'recent_comments' => 3,

		// Numarul de portfolii pe pagina blog
		'recent_portfolios' => 3,

		// Numarul de alte portfolii pe pagina portofoliu
		'other_portfolios' => 8,

		// Resize image articles
		'articles_img' => [
				'max' => ['width' => 816, 'height' => 282],
				'mini' => ['width' => 55, 'height' => 55]
			],
		// Size image 'path'
		'image' => [
				'width' => 1024, 
				'height' => 768
			],


		'theme' => env('THEME', 'default'),

	];
?>