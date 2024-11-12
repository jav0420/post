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
        //dd($request->user()->friendsTo()->get(), $request->user()->friendsFrom()->get());


        if ($request->has('for-my')) {
            //* existen estas dos formas de hacerlo
           // $posts = Post::where('user_id', $request->user()->id)->latest()->get();
            $user = $request->user();

            //* con pluck() obtenemos solo los id de los amigos
            $friendsTo_ids = $user->friendsTo()->pluck('users.id');
            $friendsFrom_ids = $user->friendsFrom()->pluck('users.id');

            $user_ids = $friendsTo_ids->merge($friendsFrom_ids)->push($user->id);

            $posts = Post::whereIn('user_id', $user_ids)->latest()->get();
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
