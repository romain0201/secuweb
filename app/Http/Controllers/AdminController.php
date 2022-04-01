<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Mysql;
use App\Models\Article;

class AdminController extends Controller
{
  public function index(Request $request)
  {
    $articles = Article::all();
    return view('admin.index', ['articles' => $articles]);
  }

    public function addArticle(Request $request)
    {
        $article = new Article;

        // Vérification des champs
        // Exemple de code :
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
        ]);
        //

        // Exclusion de code HTML, PHP et JS
        // Exemple de code :
        //
        $article->content = strip_tags($request->content);
        $article->title = strip_tags($request->title);
        //

        $article->save();

        return redirect()->route('home');
    }
}
