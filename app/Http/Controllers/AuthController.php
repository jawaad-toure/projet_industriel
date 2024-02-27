<?php

namespace App\Http\Controllers;

use Exception;
use App\Repositories\AuthRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showSignupForm(): View {
        return view('signup');
    }

    public function showSigninForm(): View {
        return view('signin');
    }
}
