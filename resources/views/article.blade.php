@extends('layouts.app')

@section('content')
    <!-- Il faut modifier tous les echo en structure blade -->
    <!-- Exemple de code : -->
    <h1>{{ $article->title }}</h1>

    @error('article_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <p>{{ $article->content }}</p>


    <h4>Derniers commentaire :</h4>

    @foreach($article->comments as $comment)
        <div>
            {{ $comment->author }} à dit :
            <p>{{ $comment->message }}</p>
        </div>
    @endforeach


    <form method="POST" action="{{ route('article.add.comment') }}" >
        <!-- Il faut rajouter un CSRF -->
        <!-- Exemple de code : -->
        @csrf

        <p>Author name : </p><input type="text" name="author" />
        <p>Message : </p><textarea name="message"></textarea>
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <br>
        <button type="submit">Send my comment !</button>
    </form>
@endsection
