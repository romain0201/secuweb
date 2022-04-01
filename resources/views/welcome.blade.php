@extends('layouts.app')


@section('content')
    <!-- Il faut modifier tous les echo en structure blade -->
    <!-- Exemple de code : -->
    @isset($search)
        <h1> Search for : {{ $search }} </h1>
    @endisset

    @forelse($articles as $article)
        <div>
            <a href="{{ route('home.article', $article['id']) }}">
                <h3>{{ $article['title']  }}</h3>
            </a>
        </div>
    @empty
        <div> No article found </div>
    @endforelse

@endsection
