@extends('app')

@section('title', 'Cadastrar post')

@section('content')
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ request()->route()->user }}">
    <div class="form-group mb-2">
        <label>Título</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
    </div>
    <div class="form-group mb-2">
        <label>Post</label>
        <textarea class="form-control" name="body" maxlength="500">{{ old('body') }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
@endsection