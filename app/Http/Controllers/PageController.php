<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request)
    {
        //muestrame todos los datos que vienen en el request
        //dd($request->all());
        if ($request->has('for-my')) {
           // $posts = Post::where('user_id', $request->user()->id)->latest()->get();
            $posts = $request->user()->posts()->latest()->get();
        }else{
            $posts = Post::latest()->get();
        }
        return view('dashboard', compact('posts'));
    }

    public function profile()
    {
        return view('profile');
    }
}
