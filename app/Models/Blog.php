<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function author(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function subscribers(){
        return $this->belongsToMany(User::class,'blog_user');
    }
    public function subscribe(){
        $this->subscribers()->attach(auth()->user()->id);
    }
    public function unSubscribe(){
        $this->subscribers()->detach(auth()->id());
    }

    public function scopeFilter($query,$filter){
        $query->when($filter["search"]??false,function($query,$search){
            $query->where('title','LIKE','%'.$search.'%')->orWhere('body','LIKE','%'.$search.'%');
        });

        $query->when($filter["categories"]??false,function($query,$slug){
            $query->whereHas('category',function($query)use($slug){
                $query->where('slug',$slug);
            });
        });

        $query->when($filter['username']??null,function($query,$username){
            $query->whereHas('author',function($query)use($username){
                $query->where('username',$username);
            });
        });
    }
}
