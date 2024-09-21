<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Obtener los artículos públicos
        $articles = Article::where('status', '1')
            ->orderBy('id', 'desc')
            ->simplePaginate(10);
    
        // Obtener las categorías públicas y destacadas
        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->get(); // Cambiar a get()
    
        return view('home.index', compact('articles', 'navbar'));
    }

    public function all()
    {
        $categories = Category::where('status', '1')
                    ->simplePaginate(20);

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);

        return view('home.all-categories', compact('categories','navbar'));
    }
}
