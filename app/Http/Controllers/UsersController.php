<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{
    /**
     * Listar os usuários
     */
    public function index(Request $request)
    {
        //Pesquisa por ID
        if ($request->get("q")) {
            $id = $request->q;
            //Verifica se o usuário existe
            $response = Http::get(
                "https://gorest.co.in/public/v2/users/${id}",
                ["access-token" => config("app.token")]
            );
            $users = [];
            if ($response->successful()) {
                $users[] = $response->object();
            }
        } else {
            //Pesquisa os usuários
            $response = Http::get(
                "https://gorest.co.in/public/v2/users",
                ["access-token" => config("app.token")]
            );
            $users = $response->object();
        }

        return view("users", compact("users"));
    }

    /**
     * Exibe a view de cadastro de usuário
     */
    public function create()
    {
        return view("user-create");
    }

    /**
     * Cadastrar um usuário
     */
    public function store(Request $request)
    {
        // Valida o formulário
        $request->validate([
            'status' => 'required',
            'name' => 'required',
            'email' => 'email',
            'gender' => 'required',
        ]);
        $response = Http::post(
            "https://gorest.co.in/public/v2/users",
            array_merge(["access-token" => config('app.token')], $request->all())
        );
        //Verifica se obteve sucesso na requisição
        if ($response->successful()) {
            return redirect()->route('users.show', $response->object()->id)
                ->with('message', 'Usuário salvo com sucesso.');
        } else {
            return redirect()->route('users.create')
                ->withErrors($response->object())
                ->withInput($request->input());
        }
    }


    /**
     * Exibe o perfil do usuário com a lista de post
     */
    public function show($id)
    {
        //Pesquisa o usuário
        $response = Http::get("https://gorest.co.in//public/v2/users/{$id}", ["access-token" => config('app.token')]);
        if ($response->failed()) {
            return redirect()->route('users')
                ->withErrors($response->object());
        }
        //Pesquisa os posts do usuário
        $user = $response->object();
        $response = Http::get("https://gorest.co.in/public/v2/users/{$id}/posts", ["access-token" => config('app.token')]);
        $posts = $response->object();
        return view("user-post", compact('user', 'posts'));
    }
}
