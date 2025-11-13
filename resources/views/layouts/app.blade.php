<!doctype html>
<html lang="hu">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanösvény</title>
    <!-- Bootswatch Lux -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" defer></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Tanösvény</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="{{ route('db.index') }}">Adatbázis</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('chart.index') }}">Diagram</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contact.create') }}">Kapcsolat</a></li>
            @auth
              <li class="nav-item"><a class="nav-link" href="{{ route('messages.index') }}">Üzenetek</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('utak.index') }}">CRUD</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
            @endauth
          </ul>
          <ul class="navbar-nav">
            @auth
              <li class="nav-item me-2"><span class="navbar-text">Szia, {{ auth()->user()->name }}!</span></li>
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">@csrf
                  <button class="btn btn-outline-light btn-sm">Kijelentkezés</button>
                </form>
              </li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Belépés</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Regisztráció</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
    <main class="container py-4">
      @if(session('ok'))<div class="alert alert-success">{{ session('ok') }}</div>@endif
      @yield('content')
    </main>
    <footer class="py-4 bg-light mt-auto">
      <div class="container text-center small text-muted">© {{ date('Y') }} Tanösvény katalógus</div>
    </footer>
  </body>
</html>
