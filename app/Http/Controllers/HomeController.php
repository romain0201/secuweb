<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Mysql;
use App\Models\Article;

class HomeController extends Controller
{
  public function home(Request $request)
  {
    $articles = Article::orderBy('created_at', 'DESC')->simplePaginate(10);

    return view('welcome', ['articles' => $articles]);
  }

  public function article(Request $request, $article)
  {
    $article = \App\Models\Article::find($article);
    return view('article', ['article' => $article]);
  }

    public function search (Request $request)
    {
        $mysql = new Mysql;

        // Vérification des champs
        // Exemple de code :
        //
        $request->validate([
            'search' => 'required|string',
        ]);
        //

        // Exclusion de code HTML, PHP et JS
        // Exemple de code :
        //
        $articles = $mysql->like('articles', '*', ['title' => strip_tags($request->search)]);
        //


        if(!$articles) $articles = [];

        // Exclusion de code HTML, PHP et JS
        // Exemple de code :
        //
        return view('search', [
            'articles' => $articles,
            'search' => strip_tags($request->search)
        ]);
    }

  public function addComment(Request $request)
  {
    $mysql = new Mysql;

    // manque la validation avec le validator de laravel

    $mysql->insert('comments', [
      'author' => $request->author,
      'message' => $request->message,
      'article_id' => $request->article_id,
    ]);

    return redirect()->route('home.article', $request->article_id);
  }
}
