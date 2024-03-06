<!doctype html>
<html>

<head>
    <title>The Cook Talk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <!-- addtionnal css to avoid active effect on button -->
    <style type="text/css">
        .active-effect-dislabled:active {
            background: none;
            color: inherit;
        }
    </style>

</head>

<body>
    <!-- header -->
    <div class="container sticky-top bg-white border-bottom p-3 px-md-4 mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <a href="/" class="fs-5 fw-bold my-0 link-dark link-underline link-underline-opacity-0">The Cook Talk</a>

            <nav class="my-2 my-md-0 mr-md-3">
                <div class="dropdown-center">
                    <a class="p-2 text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="10,14" aria-expanded="false">
                        Recettes
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item active-effect-dislabled" href="#">Plats</a></li>
                        <li><a class="dropdown-item active-effect-dislabled" href="#">Entrées</a></li>
                        <li><a class="dropdown-item active-effect-dislabled" href="#">Desserts</a></li>
                        <li><a class="dropdown-item active-effect-dislabled" href="#">Boissons</a></li>
                    </ul>
                </div>
            </nav>

            @if (session()->has('user'))
            <div class="d-flex align-items-center justify-content-around">
                <div class="dropdown">
                    <a class="text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="10,24" aria-expanded="false">
                        <img src="{{ asset(session()->get('user')['avatar']) }}" width="30" height="30" class="object-fit-cover rounded-circle">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="{{ route('user.dashboard.show', ['userId' => session()->get('user')['id']]) }}" class="dropdown-item active-effect-dislabled">Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-grid">
                                @csrf

                                <button type="submit" class="dropdown-item active-effect-dislabled text-danger">
                                    Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @else
            <a href="/signin" class="btn btn-outline-primary shadow-none">Connexion</a>
            @endif
        </div>
    </div>

    <!-- content -->
    <div class="vh-100 container">
        @yield('content')
    </div>

    <!-- footer -->
    <div class="container d-flex justify-content-center align-items-center border-top bg-white mt-3 py-4">
        <a href="#" class="fs-5 fw-bold my-0 link-dark link-underline link-underline-opacity-0">© 2024 The Cook Talk</a>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- script to prevent modal from closing after submit -->
    <!-- test on updateEmailModal but it does'nt work yet -->
    <script>
        $('#btnUpdateEmail').on('click', function() {
            $('#updateEmailModal').modal({
                backdrop: "static ",
                keyboard: false
            });
        });
    </script>
</body>

</html>