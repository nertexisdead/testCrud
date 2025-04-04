<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/favicon.ico" />
            </div>
            <div class="info">
                <a href="/" class="d-block" target="_blank">{{ Auth::user()->name ?? 'username' }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('index') }}" class="nav-link">
                        <i class="fas fa-building nav-icon"></i>
                        <p>{{ __('Main page') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>{{ __('Posts') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
