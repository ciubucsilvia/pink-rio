<?php

namespace Corp\Repositories;

use Config;

abstract class Repository{
	
	protected $model = FALSE;

	public function get($select = '*', $take = FALSE, $pagination = FALSE, $where = FALSE){

		$builder = $this->model->select($select);

		if($where) {
			$builder->where($where[0], $where[1]);
		}

		if($take) {
			$builder->take($take);
		}

		if($pagination) {
			return $this->check($builder->paginate(Config::get('settings.paginate')));
		}

		return $this->check($builder->get());
	}

	protected function check($result){
		
		if($result->isEmpty()){
			return FALSE;
		}

		$result->transform(function($item, $key){
			if(is_string($item->img)
			 	&& is_object(json_decode($item->img))
				&& (json_last_error() == JSON_ERROR_NONE)
			 	){
				$item->img = json_decode($item->img);
			}

			return $item;
		});

		return $result;
	}

	public function one($alias, $attr = []) {
		
		$result = $this->model->where('alias', $alias)->first();

		return $result;
	}

	public function transliterate($string) {
		$str = mb_strtolower($string, 'UTF-8');

		// $leter_array = [
		// 	'a' => 'a',
		// 	'b' => 'b',
		// 	// ....
		// ];

		// foreach($leter_array as $leter => $kyr) {
		// 	$kyr = explode(',', $kyr);

		// 	$str = str_replace($kyr, $leter, $str);
		// }

		$str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);
		
		$str = trim($str, '-');

		return $str;
	}
}

?>