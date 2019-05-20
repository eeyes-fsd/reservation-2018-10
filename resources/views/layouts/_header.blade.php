<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                西迁纪念馆
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ route('admin') }}">后台首页</a></li>
                <li><a href="{{ route('reservations.index') }}">预约审核</a></li>
                <li><a href="{{ route('memos.index') }}">备忘录</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right" style="height: 50px;padding: 6px;">
                <!-- Authentication Links -->
                @auth
                        <form action="{{ route('logout') }}" method="post" id="logout">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">退出</button>
                        </form>
                @else
                    <li><a href="{{ route('login') }}">登录</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>