<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use App\Models\Text;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function main(): View
    {
        $texts = Text::with(['user', 'category'])->latest()->get();
        return view('main', compact('texts'));
    }

    public function catalog(): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('catalog', compact('categories'));
    }

    public function catalogCategory($category): View
    {
        $texts = Text::query()
            ->whereHas('category', fn ($q) => $q->where('name', $category))
            ->with(['user', 'category'])
            ->latest()
            ->get();
        
        return view('catalogCategory', compact('texts', 'category'));
    }

    public function show($id): View
    {
        $text = Text::query()
            ->with(['user', 'category'])
            ->find($id);

        return view('show', compact('text'));
    }

    public function journalist(): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('journalist', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'heading'    => 'required|string|max:255',
            'text'  => 'required|string',
            'category_id' => 'required|string|exists:categories,id',
        ]);

        $validated['user_id'] = auth()->id();
        $text = Text::create($validated);

        return redirect()
            ->route('news.show', $text->id)
            ->with('success', 'Новость создана.');
    }

    public function edit($id) : View
    {
        $text = Text::findOrFail($id);
        $categories = Category::query()->orderBy('name')->get();

        return view('edit', compact('text','categories'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'heading'     => 'required|string|max:255',
            'text'        => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $text = Text::findOrFail($id);
        $text->update($validated);

        return redirect()
            ->route('news.show', $text->id)
            ->with('success', 'Текст обновлён.');
    }
    
    public function admin(): View
    {
        $users = User::query()->with('role')->orderBy('login')->get();
        $roles = Role::query()->orderBy('name')->get();
        $texts = Text::query()->with(['user', 'category'])->latest()->get();

        return view('admin', compact('users', 'roles', 'texts'));
    }

    public function updateUserRole(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user = User::findOrFail($validated['user_id']);

        $adminRoleId = Role::query()->where('name', 'admin')->value('id');
        if ($user->id === auth()->id() && (int) $validated['role_id'] !== $adminRoleId) {
            return back()->with('error', 'Нельзя снять роль администратора с себя.');
        }

        $user->update(['role_id' => $validated['role_id']]);

        return back()->with('success', 'Роль обновлена.');
    }

    public function destroyText($id): RedirectResponse
    {
        Text::findOrFail($id)->delete();

        return back()->with('success', 'Текст удалён.');
    }
}