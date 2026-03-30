<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Categories allowed in the application.
     */
    const CATEGORIES = [
        1 => 'Politique',
        2 => 'Economie',
        3 => 'Sante',
        4 => 'International',
        5 => 'Sport',
    ];

    /**
     * Display a listing of the resource.
     */
    public function welcome()
    {
        $articles = Article::latest()->take(3)->get();
        $categories = self::CATEGORIES;
        return view('welcome', compact('articles', 'categories'));
    }

    /**
     * Display the archives (public).
     */
    public function frontIndex()
    {
        $articles = Article::latest()->paginate(6);
        $categories = self::CATEGORIES;
        return view('front.articles.index', compact('articles', 'categories'));
    }

    /**
     * Display a listing of the resource (admin).
    {
        $articles = Article::latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = self::CATEGORIES;
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer',
        ]);

        $validated['category_name'] = self::CATEGORIES[$validated['category_id']] ?? 'Divers';

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
    }

    /**
     * Display the specified resource (Public SEO URL).
     */
    public function show(string $category, string $slug, string $id, string $idcat)
    {
        $article = Article::where('id', $id)
                          ->where('slug', $slug)
                          ->where('category_id', $idcat)
                          ->firstOrFail();

        return view('front.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        $categories = self::CATEGORIES;
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer',
        ]);

        $validated['category_name'] = self::CATEGORIES[$validated['category_id']] ?? $article->category_name;

        if ($request->hasFile('image')) {
            // Optionnel : Supprimer l'ancienne image si elle existe localement
            if ($article->image_url && str_starts_with($article->image_url, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $article->image_url));
            }
            
            $path = $request->file('image')->store('articles', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
    }
}
