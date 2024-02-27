@extends('base')

@section('content')

<div class="container">

    <div class="row gy-4 d-flex flex-column align-items-center">

        <h1 class="text-center py-4">Ouverture de session</h1>

        <form method="POST" class="col-sm-4">
            @csrf
            
            @if ($errors->any())
                <div class="alert alert-warning">
                    Vous n'avez pas pu être authentifié &#9785;
                </div>
            @endif

            <div class="form-group my-4">
                <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="email"
                    aria-describedby="email_feedback" class="form-control @error('email') is-invalid @enderror"> 
                @error('email')
                <div id="email_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group my-4">
                <input type="password" id="password" name="password" value="{{old('password')}}" placeholder="mot de passe"
                    aria-describedby="password_feedback" class="form-control @error('password') is-invalid @enderror">  
                @error('password')
                    <div id="password_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block my-4">Se connecter</button>

        </form>        

        <div class="col-sm-4 d-flex flex-column align-items-center">
            <span>Vous n'avez pas encore un compte ?</span>
            <a href="/signup">C'est par ici pour en créer un !</a>
        </div>

    </div>

</div>

@endsection