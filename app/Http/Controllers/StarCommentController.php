<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StarCommentRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StarCommentController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $starCommentRepository;

    public function __construct(StarCommentRepository $starCommentRepository)
    {
        $this->starCommentRepository = $starCommentRepository;
    }


    /** views preview function */

    /**
     * 
     */
    public function showStarCommentForm(int $recipeId)
    {
        return view('stars_comments/star_comment_form', ['recipeId' => $recipeId]);
    }


    /** controllers functions */

    /**
     * 
     */
    public function insertStarComment(Request $request, int $recipeId)
    {
        dump('Il faut maintenant ajouter la logique');
    }
}
