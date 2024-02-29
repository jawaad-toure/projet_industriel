@extends('base')

@section('content')

<div class="container">

    <div class="z-n1 row gy-4 d-flex flex-column align-items-center">

        <h1 class="text-center py-3">Création de compte</h1>

        <form method="POST" action="{{route('signup.post')}}" class="col-sm-4">
            @csrf
            
            @if ($errors->any())
                <div class="alert alert-warning">
                    Votre compte n'a pas pu être créé &#9785;
                </div>
            @endif

            <div class="form-group my-2">
                <input type="username" id="username" name="username" value="{{old('username')}}" placeholder="pseudonyme"
                    aria-describedby="username_feedback" class="py-3 form-control shadow-none @error('email') is-invalid @enderror"> 
                
                @error('username')
                    <div id="username_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group my-2">
                <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="email"
                    aria-describedby="email_feedback" class="py-3 form-control shadow-none @error('email') is-invalid @enderror"> 
                
                @error('email')
                    <div id="email_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group my-2">
                <input type="password" id="password" name="password" value="{{old('password')}}" placeholder="mot de passe"
                    aria-describedby="password_feedback" class="py-3 form-control shadow-none @error('password') is-invalid @enderror">  
                
                @error('password')
                    <div id="password_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group my-2">
                <input type="password" id="password_confirmed" name="password_confirmed" placeholder="confirmer mot de passe"
                    aria-describedby="password_confirmed_feedback" class="py-3 form-control shadow-none @error('password_confirmed') is-invalid @enderror">  
                
                @error('password_confirmed')
                    <div id="password_confirmed_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary shadow-none btn-lg btn-block my-2">Créer mon compte</button>
            </div>

        </form>        

        <div class="col-sm-4 d-flex flex-column align-items-center">
            <span>Vous avez déjà un compte ?</span>
            <a href="/signin">C'est par ici pour vous connecter !</a>
        </div>

    </div>

</div>

@endsection