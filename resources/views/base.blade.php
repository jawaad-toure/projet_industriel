<!doctype html>
<html>

<head>
    <title>The Cook Talk</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- personal css (public/css/base.css) -->
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard_switch_button.css') }}">
    
    <!-- jquery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <!-- google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>
    <!-- header -->
    <div class="container sticky-top bg-white border-bottom p-3 px-md-4 mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <a href="/" class="fs-5 fw-bold my-0 link-dark link-underline link-underline-opacity-0">TheCookTalk</a>

            <nav class="my-2 my-md-0 mr-md-3">
                <div class="dropdown-center">
                    <a class="p-2 text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="10,15" aria-expanded="false">
                        Recettes
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item active-effect-disabled" href="#">Plats</a></li>
                        <li><a class="dropdown-item active-effect-disabled" href="#">Entrées</a></li>
                        <li><a class="dropdown-item active-effect-disabled" href="#">Desserts</a></li>
                        <li><a class="dropdown-item active-effect-disabled" href="#">Boissons</a></li>
                    </ul>
                </div>
            </nav>

            @if (session()->has('user'))
            <div class="d-flex align-items-center justify-content-around">
                <div class="dropdown">
                    <a class="text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="10,25" aria-expanded="false">
                        <img src="{{ asset(session()->get('user')['avatar']) }}" width="30" height="30" class="object-fit-cover rounded-circle">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="{{ route('dashboard.show', ['userId' => session()->get('user')['id']]) }}" class="dropdown-item active-effect-disabled">Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-grid">
                                @csrf

                                <button type="submit" class="dropdown-item active-effect-disabled text-danger">
                                    Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @else
            <a href="/signin" class="btn btn-outline-primary hover-effect-disabled active-effect-disabled --primary shadow-none"><i class="bi bi-person-fill"></i> Connexion</a>
            @endif
        </div>
    </div>

    <!-- content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- footer -->
    <div class="container d-flex justify-content-center align-items-center border-top bg-white mt-3 py-4">
        <a href="#" class="fs-5 fw-bold my-0 link-dark link-underline link-underline-opacity-0">© 2024 TheCookTalk</a>
    </div>

    <!-- bootstrap javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- personal js (public/css/base.css) -->
    <script src="{{ asset('js/base.js') }}"></script>

    <!-- js for recipe form -->
    <script src="{{ asset('js/recipe_form.js') }}"></script>
</body>

</html>