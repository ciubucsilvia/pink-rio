<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'img', 'alias', 'description', 'text', 'iser_id', 'category_id', 'keywords', 'meta_desc'];

    public function user() {
    	return $this->belongsTo('Corp\User');
    }

    public function category() {
    	return $this->belongsTo('Corp\Category');
    }

    public function comments() {
    	return $this->hasMany('Corp\Comment');
    }
}
