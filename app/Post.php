<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
	
    protected $fillable = ['user_id','title','content'];

    protected $casts = [
        'pending' => 'boolean'
    ];

    public function user(){

    	return $this->belongsTo(\App\user::class);
    }

    public function comments(){

    	return $this->hasMany(\App\Comment::class);
    }

    public function setTitleAttribute($value){

    	$this->attributes['title'] = $value;
    	$this->attributes['slug'] = Str::slug($value);

    }

    public function getUrlAttribute(){

    	return route('posts.show', [$this->id,$this->slug]);
    }
}