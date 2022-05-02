<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostsController extends Controller
{
    /**
     * Listar todos os posts
     */
    public function index()
    {
        $response = Http::get(
            "https://gorest.co.in/public/v2/posts",
            ["access-token" => config('app.token')]
        );
        $posts = $response->object();
        return view("posts", compact('posts'));
    }

    /**
     * Exibe a view de cadastro de um post
     */
    public function create()
    {
        return view("post-create");
    }

    /**
     * Cadastrar um post
     */
    public function store(Request $request)
    {
        // Valida o formulário
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);
        $user = $request->user_id; //Id do usuário
        //Request de cadastro do post de usuário
        $response = Http::post(
            "https://gorest.co.in/public/v2/users/{$user}/posts",
            array_merge(["access-token" => config('app.token')], $request->all())
        );
        //Retorna a página de usuário com a mensagem de sucesso ou para a página de cadastro de post se erro
        if ($response->successful()) {
            return redirect()->route('users.show', $user)
                ->with('success', 'Post salvo com sucesso.');
        } else {
            return redirect()->route('posts.create', $user)
                ->withErrors($response->object())
                ->withInput($request->input());
        }
    }

    /**
     * Exibe os comentários do post
     */
    public function show($id)
    {
        //Request para saber se o post existe
        $response = Http::get("https://gorest.co.in/public/v2/posts/${id}", ["access-token" => config('app.token')]);
        if ($response->failed()) {
            return redirect()->route('posts')
                ->withErrors($response->object());
        }
        $post = $response->object(); //Dados do post
        //Request de comentários do post
        $response = Http::get("https://gorest.co.in/public/v2/posts/${id}/comments", ["access-token" => config('app.token')]);
        $comments = $response->object();
        return view("post-comment", compact('post', 'comments'));
    }
}
