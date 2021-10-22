<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdatePictureRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index() {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);

        return view('posts.list', compact('posts'));
    }

    public function details($id){
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts.details', compact(['post', 'categories']));
    }

    public function add(){
        $categories = Category::all();

        return view('posts.add', compact('categories'));
        //Parce que on va créer un fichier posts.add dans le dossier view -> posts
    }

    public function store(PostStoreRequest $request)
    {
        $params = $request->validated();
        $file = Storage::put('public', $params['picture']);
        $params['picture'] = substr($file, 7);
        $post = Post::create($params);

        if(!empty($params['checkboxCategories'])){
            $post->categories()->attach($params['checkboxCategories']);
        }

        return redirect()->route('postList');
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $params = $request->validated();
        $post = Post::find($id);
        $post->update($params);

        $post->categories()->detach();
        if(!empty($params['checkboxCategories'])){
            $post->categories()->attach($params['checkboxCategories']);
        }

        return redirect()->route('postDetails', $id);

    }

    public function updatePicture(PostUpdatePictureRequest $request, $id){
        $params = $request->validated();
        $post = Post::find($id);
        if(Storage::exists("public/$post->picture")) {
            Storage::delete("public/$post->picture");
        }
        $file = Storage::put('public', $params['picture']);
        $params['picture'] = substr($file, 7);
        $post->picture = substr($file, 7);
        $post->save();
        return redirect()->route('postList');
    }


    public function delete($id)
    {
        $post = Post::find($id);

        //SI tu trouves l'image tu l'a supprime
        if(Storage::exists("public/$post->picture")) {
            Storage::delete("public/$post->picture");
        }
        $post->delete();
        // Retourne sur la route ou on etait juste avant
        return back();
    }



}

