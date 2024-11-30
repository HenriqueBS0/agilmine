<nav class="navbar border-bottom bg-white">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Agilmine</span>
        {{ $breadcrumb ?? '' }}
        <div class="dropdown ms-auto">
            <a class="nav-link dropdown-toggle text-secondary" href="#" role="button" id="userDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        {{ __('Profile') }}
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
