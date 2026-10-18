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
        $texts = Text::query()
            ->where('is_blocked', false)
            ->with(['user', 'category.parent'])
            ->latest()
            ->get();
        return view('main', compact('texts'));
    }

    public function catalog(): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('catalog', compact('categories'));
    }

    public function catalogCategory($categoryName): View
    {
        $category = Category::query()
            ->with('children')
            ->where('name', $categoryName)
            ->firstOrFail();

        $categoryIds = collect([$category->id])->merge($category->children->pluck('id'));

        $texts = Text::query()
            ->where('is_blocked', false)
            ->whereIn('category_id', $categoryIds)
            ->with(['user', 'category.parent'])
            ->latest()
            ->get();
        
        return view('catalogCategory', compact('texts', 'categoryName'));
    }

    public function show($id): View
    {
        $text = Text::query()
            ->with(['user', 'category.parent'])
            ->find($id);

        if ($text && $text->is_blocked && auth()->user()?->role?->name !== 'admin') {
            $text = null;
        }

        return view('show', compact('text'));
    }

    public function journalist(): View
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('journalist', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'heading'    => 'required|string|max:255',
            'text'  => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
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

        if ($text->user_id !== auth()->id() && auth()->user()->role?->name !== 'admin') {
            abort(403, 'Вы можете редактировать только свои статьи.');
        }

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('edit', compact('text','categories'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        

        $text = Text::findOrFail($id);

        if ($text->user_id !== auth()->id() && auth()->user()->role?->name !== 'admin') {
            abort(403, 'Вы можете редактировать только свои статьи.');
        }

        $validated = $request->validate([
            'heading'     => 'required|string|max:255',
            'text'        => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $text->update($validated);

        return redirect()
            ->route('news.show', $text->id)
            ->with('success', 'Текст обновлён.');
    }
    
    public function admin(): View
    {
        $users = User::query()->with('role')->orderBy('login')->get();
        $roles = Role::query()->orderBy('name')->get();
        $texts = Text::query()->with(['user', 'category.parent'])->latest()->get();

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

    public function toggleTextBlock($id): RedirectResponse
    {
        $text = Text::findOrFail($id);
        $text->update(['is_blocked'=> ! $text->is_blocked]);

        $status = $text->is_blocked ? 'Статья заблокирована.' : 'Статья разблокирована.';
        return back()->with('success', $status);
    }
}