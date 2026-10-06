<header class="header">
    <div class="container header-inner">
        <a href="{{ route('main') }}" class="logo">NewsSite</a>

        <nav class="nav">
            <a href="{{ route('main') }}" class="nav-link">Главная</a>
            <a href="{{ route('catalog') }}" class="nav-link">Каталог</a>

            @auth
                @if (in_array(auth()->user()->role, ['journalist', 'admin'], true))
                    <a href="{{ route('journalist') }}" class="nav-link">Журналист</a>
                @endif

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin') }}" class="nav-link">Админ</a>
                @endif

                <div class="user-menu">
                    <span class="user-name">{{ auth()->user()->username }}</span>
                    <span class="role-badge">{{ auth()->user()->role }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin:0">
                        @csrf
                        <button type="submit" class="nav-link" style="border:0;background:none;cursor:pointer">Выйти</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-link">Войти</a>
                <a href="{{ route('register') }}" class="nav-link">Регистрация</a>
            @endauth
        </nav>
    </div>
</header>