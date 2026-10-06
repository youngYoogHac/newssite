<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function main(): View
    {
        $news = News::query()->latest()->get();
        return view('main', compact('news'));
    }

    public function catalog(): View
    {
        return view('catalog');
    }

    public function catalogCategory($category): View
    {
        $news = News::query()
            ->where('category', $category)
            ->latest()
            ->get();
        
        return view('catalogCategory', compact('news', 'category'));
    }

    public function show($id): View
    {
        $news = News::find($id);
        return view('show', compact('news'));
    }

    public function journalist(): View
    {
        return view('journalist');
    }

    public function admin(): View
    {
        return view('admin');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'required|string|in:Технологии,Программирование,Наука,Спорт,Мир,Экономика',
        ]);

        $validated['user_id'] = auth()->id();
        $news = News::create($validated);

        return redirect()->route('news.show', $news->id)->with('success', 'Новость создана.');
    }
}
