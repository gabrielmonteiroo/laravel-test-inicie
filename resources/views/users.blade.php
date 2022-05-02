@extends('app')

@section('title', 'Usuários')

@section('button')
<a href="{{ route('users.create') }}" class="btn btn-primary">Cadastrar usuário</a>
@endsection

@section('content')
{{-- Pesquisa o usuário --}}
<form action="{{ route('users') }}" method="get">
    <div class="form-group mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Pesquisar ID">
            <div class="input-group-apend">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </div>
    </div>
</form>
<ul class="list-group">
    @forelse ($users as $user)
    <li class="list-group-item">
        <a href="{{ route('users.show', $user->id) }}">Posts</a>
        <b>{{ $user->id }} - {{ $user->name }} -</b> <small>{{ $user->email }}</small>
    </li>
    @empty
    <li class="list-group-item">
        <div class="alert alert-primary">Nenhum usuário cadastrado</div>
    </li>
    @endforelse
</ul>
@endsection