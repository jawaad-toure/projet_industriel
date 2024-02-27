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
                    <a class="p-2 text-dark" href="#">Recettes</a>
                </nav>
                
                <a class="btn btn-outline-primary" href="/signin">Connexion</a>
            </div>
        </div>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>