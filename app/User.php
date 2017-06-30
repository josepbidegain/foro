<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts(){

        return $this->hasMany(Post::class);
    }

    public function comments(){

        return $this->hasMany(Comment::class);
    }

    public function subscriptions()
    {
        /*
            segundo parametro para decir que tabla usar, sino usaria post_user(relacion de los 2 modelos, alfabeticamente)
        */
        return $this->belongsToMany(Post::class, 'subscriptions');
    }

    public function isSubscribedTo(Post $post){
    
        return $this->subscriptions()->where('post_id',$post->id)->count() > 0;
    }

    public function subscribeTo(Post $post){

        $this->subscriptions()->attach($post);

    }

    public function comment(Post $post, $message){
        
        $comment = new Comment([
            'comment' => $message,
            'post_id' => $post->id
        ]);
        
        $this->comments()->save($comment);

    }

    public function owns(Model $model){

        return $this->id === $model->user_id;

    }
}
