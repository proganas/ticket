<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.home') : (auth()->user()->role === 'agent' ? route('agent.home') : route('user.home')) }}"
               class="nav-link">
                Home
            </a>

        </li>
        @yield('breadcrumb')
        {{--        <li class="nav-item d-none d-sm-inline-block">--}}
        {{--            <a href="#" class="nav-link">Contact</a>--}}
        {{--        </li>--}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @if(auth()->user()->unreadNotifications->count() > 0)
            {{--            <a class="nav-link" href="#" data-toggle="dropdown">--}}
            {{--                {{ auth()->user()->unreadNotifications->count() }} <i class="fas fa-bell"></i>--}}
            {{--            </a>--}}
            @php
                $prefix = request()->segment(1);
            @endphp
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    {{ auth()->user()->unreadNotifications->count() }} <i class="fas fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{ auth()->user()->unreadNotifications->count() }} Notifications</span>
                    <div class="dropdown-divider"></div>
                    @foreach(auth()->user()->unreadNotifications as $n)
                        <a href="{{ route($prefix . '.tickets.show', $n->data['ticket_id']) }}"
                           class="nav-link dropdown-item">
                            <strong>{{ $n->data['title'] }}</strong><br>
{{--                            <small>{{ $n->data['message'] }}</small>--}}
{{--                            <div><small class="text-muted">{{ $n->created_at->diffForHumans() }}</small></div>--}}
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach
                    <a href="{{ route('notifications.readAll') }}" class="dropdown-item dropdown-footer">Mark all as
                        read</a>
                </div>
            </li>


{{--            @foreach(auth()->user()->unreadNotifications as $n)--}}
{{--                <a href="{{ route('tickets.show', $n->data['ticket_id']) }}" class="nav-link dropdown-item">--}}
{{--                    <strong>{{ $n->data['title'] }}</strong><br>--}}
{{--                    <small>{{ $n->data['message'] }}</small>--}}
{{--                    <div><small class="text-muted">{{ $n->created_at->diffForHumans() }}</small></div>--}}
{{--                </a>--}}
{{--            @endforeach--}}

        @endif

        <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    Your Profile
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
