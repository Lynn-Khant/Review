<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/',[BlogController::class,'index']);
Route::get('/blogs/{blog:slug}',[BlogController::class,'show']);

Route::get('/register',[AuthController::class,'index'])->middleware('guest');
Route::post('/register',[AuthController::class,'store'])->middleware('guest');

Route::post('/logout',[AuthController::class,'logout'])->middleware('auth');

Route::get('/login',[AuthController::class,'login'])->middleware('guest');
Route::post('/login',[AuthController::class,'post_login'])->middleware('guest');

Route::post('/blogs/{blog:slug}/comments',[CommentController::class,'store']);

Route::post('/blogs/{blog:slug}/subscription',[BlogController::class,'handleSubscription']);

Route::get('/admin/blogs/create',[BlogController::class,'create'])->middleware('admin');
Route::post('/admin/blogs/store',[BlogController::class,'store'])->middleware('admin');

Route::get('/admin/blogs',[BlogController::class,'blogs'])->middleware('admin');
Route::delete('/admin/blogs/{blog:slug}/delete',[BlogController::class,'destroy'])->middleware('admin');
Route::get('/admin/blogs/{blog:slug}/edit',[BlogController::class,'edit'])->middleware('admin');
Route::patch('/admin/blogs/{blog:slug}/update',[BlogController::class,'update'])->middleware('admin');