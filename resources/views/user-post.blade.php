@extends('app')

@section('title', 'Posts do usuário')

@section('button')
<a class="btn btn-primary" href="{{ route('posts.create', $user->id) }}">Cadastrar post</a>
@endsection

@section('content')

<dl class="row">
    <dt class="col-sm-3">ID de usuário</dt>
    <dd class="col-sm-9">{{ $user->id }}</dd>
    <dt class="col-sm-3">Nome</dt>
    <dd class="col-sm-9">{{ $user->name }}</dd>
    <dt class="col-sm-3">E-mail</dt>
    <dd class="col-sm-9">{{ $user->email }}</dd>
    <dt class="col-sm-3">Gênero</dt>
    <dd class="col-sm-9">{{ $user->gender=="male"?"Masculino":"Feminino" }}</dd>
    <dt class="col-sm-3">Status</dt>
    <dd class="col-sm-9">{{ $user->gender=="active"?"Ativo":"Inativo" }}</dd>
</dl>
@forelse ($posts as $post)
<div class="card mb-2">
    <div class="card-body">
        <a href="{{ route('posts.show',$post->id) }}" class="card-link">
            <h5 class="card-title">{{ $post->title }}</h5>
        </a>
        <h6 class="card-subtitle mb-2 text-muted">{{ $post->body }}</h6>
        <a href="{{ route('posts.show',$post->id) }}" class="card-link">Comentar</a>
    </div>
</div>
@empty
<div class="alert alert-primary">Nenhum post cadastrado</div>
@endforelse

@endsection