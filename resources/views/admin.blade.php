@extends('layouts.app')

@section('title', 'Админ — NewsSite')

@section('content')
    <section class="container">
        <h1 class="page-title">Панель администратора</h1>
        <h2>Управление статьями</h2>
        <table class="admin-table">
            <thead>
                <tr><th>Заголовок</th><th>Действия</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td>Пример статьи</td>
                    <td>
                        <button class="btn btn-small">Редактировать</button>
                        <button class="btn btn-small btn-danger">Удалить</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <h2>Изменение ролей</h2>
        <form class="news-form">
            <div class="form-group">
                <label for="user">Пользователь</label>
                <input type="text" id="user" placeholder="Логин">
            </div>
            <div class="form-group">
                <label for="role">Роль</label>
                <select id="role">
                    <option>Пользователь</option>
                    <option>Журналист</option>
                    <option>Администратор</option>
                </select>
            </div>
            <button type="submit" class="btn">Изменить роль</button>
        </form>
    </section>
@endsection