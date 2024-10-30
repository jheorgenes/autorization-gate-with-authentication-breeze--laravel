<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        // get all posts and the data of the user who create the post
        $posts = Post::with('user')->get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function createPost()
    {
        // Se o usuário NÃO tiver acesso de 'post.create'.
        if(Gate::denies('post.create')) {
            abort(403, 'Você não tem permissão para criar um post');
        }

        return view('create-post');
    }

    public function storePost(Request $request)
    {
        // gate
        if(Gate::denies('post.create')) {
            abort(403, 'Você não tem permissão para criar um post');
        }

        $request->validate(
            [
                'title' => 'required|min:3|max:100',
                'content' => 'required|min:3|max:1000',
            ],
            [
                'title.required' => 'O campo título é obrigatório',
                'title.min' => 'O campo título deve ter no máximo :min caracteres',
                'title.max' => 'O campo título deve ter no máximo :max caracteres',
                'content.required' => 'O campo conteúdo é obrigatório',
                'content.min' => 'O campo conteúdo deve ter no mínimo :min caracteres',
                'content.max' => 'O campo conteúdo deve ter no máximo :max caracteres'
            ]
        );

        // create the post
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('dashboard');
    }

    public function deletePost($id)
    {
        //Buscando o post no banco de dados através do id obtido da chamada da rota
        $post = Post::find($id);

        /** Aqui foi passado o usuário [implicitamente] e o $post como argumento. */
        // Se o usuário NÃO tiver acesso de 'post.create'.
        if(Gate::denies('post.delete', $post)) {
            abort(403, 'Você não tem permissão para eliminar um post');
        }

        // Se o usuário tiver acesso de 'post.delete'.
        // delete the post
        $post->delete();

        return redirect()->route('dashboard');
    }
}
