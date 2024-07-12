<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index(){
        return view('blogs',[
        "blogs"=>$this->getBlogs(),
        "categories"=>Category::all()
        ]);
    }
    public function show(Blog $blog){
        return view('blog',[
            'blog'=>$blog,
            'randomBlogs'=>Blog::inRandomOrder()->take(3)->get()
        ]);
    }
    protected function getBlogs(){
        $blogs=Blog::latest()->filter(request(['search','categories','username']))->paginate(6)->withQueryString();
        return $blogs;
    }
    public function handleSubscription(Blog $blog){
        if(User::find(auth()->user()->id)->isSubscribed($blog)){
            $blog->unSubscribe();
        }else{
            $blog->subscribe();
        }

        return redirect()->back();
    }
    public function create(){
        
        return view('blogs.create',[
            "categories"=>Category::all()
        ]);
    }
    public function store(){
        $formData=request()->validate([
            "title"=>['required'],
            "slug"=>['required',Rule::unique("blogs","slug")],
            "intro"=>['required'],
            "body"=>['required'],
            "category_id"=>['required',Rule::exists("categories","id")]
        ]);
        $formData["user_id"]=auth()->id();
        $formData["thumbnail"]=request()->file("thumbnail")->store("thumbnails");
        Blog::create($formData);
        return redirect("/");
    }
    public function blogs(){
        return view('admin.index',[
            "blogs"=>Blog::latest()->paginate(6)
        ]);
    }
    public function destroy(Blog $blog){
        $blog->delete();
        return redirect()->back();
    }
    public function edit(Blog $blog){
        return view('blogs.edit',[
            "categories"=>Category::all(),
            "blog"=>$blog
        ]);
    }
    public function update(Blog $blog)
    {
        $formData = request()->validate([
            "title" => ["required"],
            "slug" =>  ["required", Rule::unique('blogs', 'slug')->ignore($blog->id)],
            "intro" =>  ["required"],
            "body" =>  ["required"],
            "category_id" =>  ["required", Rule::exists('categories', 'id')]
        ]);
        $formData['user_id'] = auth()->id();
        $formData['thumbnail'] = request()->file('thumbnail') ?
            request()->file('thumbnail')->store('thumbnails') : $blog->thumbnail;
        $blog->update($formData);
        return redirect('/admin/blogs');
    }
    
}
