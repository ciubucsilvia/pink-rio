<?php

namespace Corp\Repositories;

use Corp\Slider;

class SlidersRepository extends Repository
{
	
	function __construct(Slider $slider)
	{
		$this->model = $slider;
	}
}
?>