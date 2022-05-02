<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>

<body>
    {{-- Menu --}}
    <nav class="navbar navbar-secondary bg-secondary">
        <div class="container d-flex justify-content-start">
            <a class="navbar-brand text-light" href="{{ route('users') }}">Usuários</a>
            <a class="navbar-brand text-light" href="{{ route('posts') }}">Posts</a>
        </div>
    </nav>
    <section class="container py-2">
        {{-- Topo com o título e botão de ação --}}
        <div class="row">
            <h3 class="col">@yield('title')</h3>
            <div class="col-auto">
                @yield('button')
            </div>
        </div>
        <hr />
        @if(session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        {{-- Lista os erros de processamento --}}
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <h5 class="alert-heading">Falha ao processar a requisição</h5>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- Conteúdo principal do site --}}
        @yield('content')
    </section>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>