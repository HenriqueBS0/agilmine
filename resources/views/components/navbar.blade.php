<nav class="navbar border-bottom bg-white">
    <div class="container-fluid">
        <a href="{{ route('pagina-projetos') }}" class="navbar-brand mb-0 h1">Agilmine</a>
        {{ $breadcrumb ?? '' }}
        <x-user-dropdown :user="Auth::user()" class="ms-auto" />
    </div>
</nav>
