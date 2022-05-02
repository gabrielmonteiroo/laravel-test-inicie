@extends('app')

@section('title', 'Posts')

@section('content')

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