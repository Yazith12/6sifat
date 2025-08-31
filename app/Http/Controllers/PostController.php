<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 

class PostController extends Controller
{   
    //
    public function index()
    {   $title = "Iman dan Amal";

        // $posts = $this->getPosts();
        $posts = Post::all(); 
        return view('Posts.index', compact('title', 'posts'));
    }
    private function getPosts()
    {
    //    return $posts = json_decode(json_encode([
    //         ['id' => 1, "title" => "Post 1", "content" => "content 1"],
    //         ['id' => 2, "title" => "Post 2", "content" => "content 2"]
    //     ]));
        // return $posts->filter(fn($post) => $post->id === (int)$id)->first();
    }
    public function detail($slug){

        // $posts = $this->getPosts();
        // $post = collect($posts)->firstWhere('id', $id);

        $post = Post::where('slug', $slug)->first();
        if(!$post) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException;
        }
        return view('Posts.detail', compact('post'));

    } 
   public function oldUrl()
   {
        return redirect ('/new-url');
   }
   public function newUrl()
   {
        return "<h1>New URL</h1>";
   } 
}