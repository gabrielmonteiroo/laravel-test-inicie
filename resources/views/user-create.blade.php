@extends('app')

@section('title', 'Cadastrar usuário')

@section('content')
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="form-group mb-2">
        <label>Status</label><br />
        <div class="form-check form-check-inline mb-2">
            <input class="form-check-input" type="radio" name="status" value="active" checked>
            <label class="form-check-label">Ativo</label>
        </div>
        <div class="form-check form-check-inline mb-2">
            <input class="form-check-input" type="radio" name="status" value="inactive">
            <label class="form-check-label">Inativo</label>
        </div>
    </div>
    <div class="form-group mb-2">
        <label>Nome</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group mb-2">
        <label>E-mail</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
    </div>
    <div class="form-group mb-2">
        <label>Gênero</label><br />
        <div class="form-check form-check-inline mb-2">
            <input class="form-check-input" type="radio" name="gender" value="male">
            <label class="form-check-label">Masculino</label>
        </div>
        <div class="form-check form-check-inline mb-2">
            <input class="form-check-input" type="radio" name="gender" value="female">
            <label class="form-check-label">Feminino</label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
@endsection