<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Mysql;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

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
    $request->session()->put('article_id', $article->id);
    return view('article', ['article' => $article]);
  }

    public function search (Request $request)
    {
        // Vérification des champs
        // Exemple de code :
        //
        $request->validate([
            'search' => 'required|string',
        ]);
        //

       $articles = DB::table('articles')->where('title', 'LIKE', '%'.$request->search.'%')->get();

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
      // Vérification des champs
      // Exemple de code :
      //
      $request->validate([
          'author' => 'required|string',
          'message' => 'required|string|max:5000',
          'article_id' => 'required|string',
      ]);

      // Vérification XSS
      if ($request->article_id != $request->session()->get('article_id'))
          return back()->withErrors(['article_id' => 'Merci de ne pas modifier l id de l article']);

      DB::table('comments')->insert([
          'author' => $request->author,
          'message' => $request->message,
          'article_id' => $request->article_id,
      ]);

      return redirect()->route('home.article', $request->article_id);
  }
}
