<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mosytrar los articulos en el administrador

        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->simplePaginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Obtener categorias publicas

        $categories = Category::select(['id', 'name'])
                                ->where('status', 1)
                                ->get();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        //Formulario

        $request->merge([
            'user_id'=> Auth::user()->id,
        ]);

        //Guardado de solicitudes
        $article = $request->all();

        if($request->hasFile('image'))
        {
            $article['image'] = $request->file('image')->store('articles');
        }

        Article::create($article);

        return redirect()->action([ArticleController::class, 'index'])
                            ->with('success-create', 'Articulo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $this->authorize('published',$article);
        $comments = $article->comments()->simplePaginate(5);
        return view('subscriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::select(['id', 'name'])
                                ->where('status', 1)
                                ->get();

        return view('admin.articles.edit', compact('categories','article' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        if($request->hasFile('image'))
        {
            //Elimina la imagen
            File::delete(public_path('storage/' . $article->image));
            //Asigna la nueva imagen 
            $article['image'] = $request->file('image')->store('articles');
        }
        //Actualizar datos

        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'introdution' => $request->introdution,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->action([ArticleController::class, 'index'])
                            ->with('success-update', 'Articulo modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //Eliminar imagenes del articulo
        if($article->image)
        {
            File::delete(public_path('storage/' . $article->image));
        }

        $article->delete();

        return redirect()->action([ArticleController::class, 'index'], compact('article'))
                            ->with('success-delete', 'Articulo eliminado correctamente');
    }
}
