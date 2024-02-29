<!doctype html>
<html>
    <head>
        <title>The Cook Talk</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <div class="border-bottom shadow-sm p-3 px-md-4 mb-3">
            <div class="d-flex align-items-center justify-content-around">
                <h5 class="my-0 fw-bold">The Cook Talk</h5>

                <nav class="my-2 my-md-0 mr-md-3">
                    <div class="dropdown-center">
                        <a class="p-2 text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Recettes
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Plats</a></li>
                            <li><a class="dropdown-item" href="#">Entrées</a></li>
                            <li><a class="dropdown-item" href="#">Desserts</a></li>
                            <li><a class="dropdown-item" href="#">Boissons</a></li>
                        </ul>
                    </div>
                </nav>

                @if (session()->has('user'))
                    <div class="d-flex align-items-center justify-content-around">
                        <div class="dropdown">
                            <a class="text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="profile-icon.png" width="30" height="30" class="rounded-circle">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{route('dashboard.show')}}">Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{route('logout')}}">Déconnexion</a></li>
                            </ul>                            
                        </div>
                    </div>                    
                @else                
                    <a class="btn btn-outline-primary shadow-none" href="/signin">Connexion</a>
                @endif
            </div>
        </div>

        <div class="container">
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>