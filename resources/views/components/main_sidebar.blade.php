<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ auth()->user()->role === 'admin' ? route('admin.home') : (auth()->user()->role === 'agent' ? route('agent.home') : route('user.home')) }}"
       class="brand-link">
        {{--        <img src="{{ asset('uploads/seeders/settings/logo.jpg') }}" alt=wesell"--}}
        {{--             class="brand-image elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light">Tickets System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- ticket start --}}
                <li class="nav-item">
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.tickets.index') : (auth()->user()->role === 'agent' ? route('agent.tickets.index') : route('user.tickets.index')) }}"
                       class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Tickets
                        </p>
                    </a>
                </li>
                {{-- ticket end --}}

                @if(auth()->user()->role === 'admin')
                    {{-- project start --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.projects.index') }}"
                           class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Projects
                            </p>
                        </a>
                    </li>
                    {{-- project end --}}

                    {{-- user start --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                           class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                    {{-- user end --}}
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
