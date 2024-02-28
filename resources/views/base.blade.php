<!doctype html>
<html>
    <head>
        <title>The Cook Talk</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <div class="border-bottom shadow-sm p-3 px-md-4 mb-3">
            <div class="d-flex align-items-center justify-content-around">
                <h5 class="my-0 font-weight-bold">The Cook Talk</h5>

                <nav class="my-2 my-md-0 mr-md-3">
                    <div class="dropdown">
                        <a class="p-2 text-dark text-decoration-none dropdown-toggle dropdown-toggle-split" href="#" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="resources/img/profile-icon.png" width="30" height="30" class="rounded-circle">
                        </a>
                        <a class="btn btn-secondary shadow-none" href="{{route('logout')}}">Déconnexion</a>
                    </div>                    
                @else                
                    <a class="btn btn-outline-primary shadow-none" href="/signin">Connexion</a>
                @endif
            </div>
        </div>

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>