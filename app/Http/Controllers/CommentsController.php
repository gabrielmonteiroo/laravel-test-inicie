<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentsController extends Controller
{
    /**
     * Cadastrar um comentário de um post
     */
    public function store(Request $request)
    {
        // Valida o formulário
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'body' => 'required',
        ]);
        $post = $request->post_id; //Id do post
        //Request de cadastro do comentário
        $response = Http::post(
            "https://gorest.co.in/public/v2/posts/{$post}/comments",
            array_merge(["access-token" => config('app.token')], $request->all())
        );
        //Retorna a página post com a mensagem de sucesso ou erro
        if ($response->successful()) {
            return redirect()->route('posts.show', $post)
                ->with('success', 'Comentário salvo com sucesso.');
        } else {
            return redirect()->route('posts.show', $post)
                ->withErrors($response->object())
                ->withInput($request->input());
        }
    }

    /**
     * Deletar um comentário
     */
    public function destroy(Request $request, $post)
    {
        // Valida o formulário
        $request->validate([
            'id' => 'required',
        ]);
        $id = $request->id; //Id do comentário
        //Request de remoção do comentário
        $response = Http::delete(
            "https://gorest.co.in/public/v2/comments/${id}",
            ["access-token" => config('app.token')]
        );
        //Retorna a página post com a mensagem de sucesso ou erro
        if ($response->successful()) {
            return redirect()->route('posts.show', $post)
                ->with('success', 'Comentário deletado com sucesso.');
        } else {
            return redirect()->route('posts.show', $post)
                ->withErrors($response->object())
                ->withInput($request->input());
        }
    }
}
