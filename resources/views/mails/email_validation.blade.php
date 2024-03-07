<!doctype html>
<html>

<head>
    <title>The Cook Talk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <div class="d-flex flex-column m-4 gap-3">
            <div class="fs-3 align-self-center">
                Bonjour !
            </div>

            <div>
                Vous avez recevez cet email parce que vous avez demandé à créer un compte sur le site The Cook Talk.
            </div>

            <div>
                Veuillez cliquer sur le bouton ci-dessous pour valider votre adresse email.
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <a href="{{ route('signin.firsttime.show', ['userId' => $emailValidationUserId]) }}" role="bouton" class="btn btn-primary">
                    Verifier email
                </a>
            </div>

            <div>
                Si vous n'avez pas créer de compte sur notre site, aucune action n'est requise de votre part.
            </div>

            <div>                
                Cordialement,
            </div>

            <div>
                The Cook Talk
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>