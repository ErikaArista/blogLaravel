<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mostrar las categorias admi
        $categories = Category::orderBy('id', 'desc')
                        ->simplePaginate(8);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->all();

        //validar si existe un archivo
        if($request->hasFile('image'))
        {
            $category['image'] = $request->file('image')->store('categories');
        }

        Category::create($category);

        return redirect()->action([CategoryController::class, 'index'])
                            ->with('success-create', 'Categoria creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if($request->hasFile('image'))
        {
            File::dlete(public_path('storage/' . $category->image));

            $category['image'] = $request->file('image')->store('categories');
        }

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'is_featured' => $request->is_featured,
        ]); 

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                            ->with('success-update', 'Categoria modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //Eliminar imagen
        if($category->image)
        {
            File::delete(public_path('storage/' . $category->image));
        }

        $category->delete();
        return redirect()->action([CategoryController::class, 'index'], compact('categories'))
                            ->with('success-delete', 'Categoria eliminada correctamente');
    }

    public function detail(Category $category)
    {
        $this->authorize('published', $category);
        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1']
        ])
        ->orderBy('id', 'desc')
        ->simplePaginate(5);

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);

        return view('subscriber.categories.detail', compact('category', 'articles', 'navbar'));

    }
}
