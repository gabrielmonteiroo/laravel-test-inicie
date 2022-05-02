@extends('app')

@section('title', 'Post')

@section('content')
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $post->body }}</h6>
        <hr />
        <h5>Comentários</h5>
        <ul class="list-group list-group-flush">
            <form method="POST" action="{{ route('comments.destroy', $post->id) }}">
                @csrf
                @method("DELETE")
                @forelse ($comments as $comment)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <p class="m-0"><b>{{ $comment->name }}</b> - <small>{{ $comment->email }}</small></p>
                            <p>{{ $comment->body }}</p>
                        </div>
                        <div class="col-auto">
                            <button type="submit" name="id" value="{{ $comment->id }}"
                                class="btn btn-sm btn-light text-danger">Deletar</button>
                        </div>
                    </div>
                </li>
                @empty
                <li class="list-group-item">
                    <div class="alert alert-primary">Nenhum comentário cadastrado</div>
                </li>
                @endforelse
            </form>
        </ul>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title">Cadastrar comentário</h5>
        <form method="POST" action="{{ route('comments.store') }}" class="form-delete">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group mb-2">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group mb-2">
                <label>E-mail</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group mb-2">
                <label>Comentário</label>
                <textarea class="form-control" name="body">{{ old('body') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.form-delete').on('submit', function(){
           if(confirm("Confirmar a remoção?"))               
               return true;               
           else               
               return false;               
        });
    });
</script>
@endsection