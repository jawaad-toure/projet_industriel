<?php

namespace Tests\Unit;

use App\Data\RecipeData;
use App\Repositories\RecipeRepository;
use PHPUnit\Framework\TestCase;

class RecipeRepositoryTest extends TestCase
{
    protected $recipeRepository;
    protected $recipeData;

    public function setUp(): void 
    {
        parent::setUp();
        $this->recipeRepository = new RecipeRepository();
        $this->recipeData = new RecipeData();
    }

    public function testDeleteRecipe(): void
    {
        
    }
}
