@extends('layouts.app')

@section('title', 'Админ — NewsSite')

@section('content')
    <section class="container">
        <h1 class="page-title">Панель администратора</h1>

        {{-- Управление пользователями --}}
        <h2>Пользователи</h2>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Логин</th>
                    <th>Роль</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->role?->name }}</td>
                        <td>
                            <form class="inline-form" action="{{ route('admin.user.role') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <select name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                                @selected($user->role_id === $role->id)>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-small">Сохранить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Управление статьями --}}
        <h2>Статьи</h2>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Категория</th>
                    <th>Автор</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($texts as $text)
                    <tr>
                        <td>
                            {{ $text->heading }}
                            @if ($text->is_blocked)
                                <span class="badge-blocked">Заблокировано</span>
                            @endif
                        </td>
                        <td>{{ $text->category->fullName() }}</td>
                        <td>{{ $text->user?->login ?? 'Аноним' }}</td>
                        <td>{{ $text->created_at->format('d.m.Y') }}</td>
                        <td>
                            <a href="{{ route('news.edit', $text->id) }}"
                               class="btn btn-small btn-secondary">Редактировать</a>

                            <form action="{{ route('admin.text.toggle-block', $text->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-small {{ $text->is_blocked ? 'btn-success' : 'btn-warning' }}">
                                    {{ $text->is_blocked ? 'Разблокировать' : 'Заблокировать' }}
                                </button>
                            </form>

                            <form action="{{ route('news.destroy', $text->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Удалить этот текст?');"
                                  style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-small btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection