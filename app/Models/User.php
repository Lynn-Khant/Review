<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded=[];

    public function blogs(){
        return $this->hasMany(Blog::class,);
    }

    public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);
    }
    public function subscribedBlogs(){
        return $this->belongsToMany(Blog::class,'blog_user');
    }
    public function isSubscribed($blog){
        return auth()->user()->subscribedBlogs && auth()->user()->subscribedBlogs->contains('id',$blog->id);
    }
}
