<?php 

namespace Corp\Repositories;

use Corp\Article;
use Gate;
use Image;
use Config;

class ArticlesRepository extends Repository{
	
	public function __construct(Article $article){

		$this->model = $article;
	}

	public function one($alias, $attr = []) {
		$article = parent::one($alias, $attr);

		if($article && !empty($attr)) {
			$article->load('comments');
			$article->comments->load('user');
		}

		return $article;
	}

	public function addArticle($request) {
		
		// if(Gate::denies('save'), $this->model) {
		// 	abort(403, 'Unauthorized action.');
		// }

		$data = $request->except('_token'); 

		if(empty($data)) {
			return ['error' => 'No informations'];
		}

		if(empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title']);
		}

		if($this->one($data['alias'], FALSE)) {
			$request->merge(['alias' => $data['alias']]);
			$request->flash();

			return ['error' => 'This alias is ussed!'];
		}

		if($request->hasFile('img')) {
			$image = $request->file('img');
			// dd($image);	
			if($image->isValid()) {
				$str = str_random(8);

				$obj = new \stdClass;

				$obj->mini = $str . '_mini.jpg';
				$obj->max = $str . '_max.jpg';
				$obj->path = $str . '.jpg';

				$img = Image::make($image);

				$img->fit(Config::get('settings.image')['width'], 
						Config::get('settings.image')['height'])
					->save(public_path() . '/' . env('THEME') . '/images/articles/' . $obj->path);
				
				$img->fit(Config::get('settings.articles_img')['max']['width'], 
						Config::get('settings.articles_img')['max']['height'])
					->save(public_path() . '/' . env('THEME') . '/images/articles/' . $obj->max);

				$img->fit(Config::get('settings.articles_img')['mini']['width'], 
						Config::get('settings.articles_img')['mini']['height'])
					->save(public_path() . '/' . env('THEME') . '/images/articles/' . $obj->mini);
				
				$data['img'] = json_encode($obj);
			}
		}

		$this->model->fill($data);
		
		if($request->user()->articles()->save($this->model)) {
			return ['status' => 'Article added!'];
		}
	}

	public function updateArticle($request, $article) {

		// if(Gate::denies('edit'), $this->model) {
		// 	abort(403, 'Unauthorized action.');
		// }
		
		$data = $request->except('_token', '_method', 'old_image'); 

		if(empty($data)) {
			return ['error' => 'No informations'];
		}

		if(empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title']);
		}

		$result = $this->one($data['alias'], FALSE);

		if(isset($result->id) && ($result->id != $article->id)) {
			$request->merge(['alias' => $data['alias']]);
			$request->flash();

			return ['error' => 'This alias is ussed!'];
		}

		if($request->hasFile('img')) {
			$image = $request->file('img');
				
			if($image->isValid()) {
				$str = str_random(8);

				$obj = new \stdClass;

				$obj->mini = $str . '_mini.jpg';
				$obj->max = $str . '_max.jpg';
				$obj->path = $str . '.jpg';

				$img = Image::make($image);

				$img->fit(Config::get('settings.image')['width'], 
						Config::get('settings.image')['height'])
					->save(public_path() . '/' . env('THEME') . '/images/articles/' . $obj->path);
				
				$img->fit(Config::get('settings.articles_img')['max']['width'], 
						Config::get('settings.articles_img')['max']['height'])
					->save(public_path() . '/' . env('THEME') . '/images/articles/' . $obj->max);

				$img->fit(Config::get('settings.articles_img')['mini']['width'], 
						Config::get('settings.articles_img')['mini']['height'])
					->save(public_path() . '/' . env('THEME') . '/images/articles/' . $obj->mini);
				
				$data['img'] = json_encode($obj);
			}
		}

		$article->fill($data);

		if($article->update()) {
			return ['status' => 'Article updated!'];
		}
	}

	public function deleteArticle($article) {
		// if(Gate::denies('destroy'), $this->model) {
		// 	abort(403, 'Unauthorized action.');
		// }

		$article->comments()->delete();

		if($article->delete()) {
			return ['status' => 'Article deleted!'];
		}
	}
}

?>