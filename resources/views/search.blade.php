@extends('layouts.app')


@section('content')
    <h1> Search for : {{ $search }} </h1>

    @forelse($articles as $article)
        <div>
            <a href="{{ route('home.article', $article->id) }}">
                <h3>{{ $article->title  }}</h3>
            </a>
        </div>
    @empty
        <div> No article found </div>
    @endforelse

@endsection
