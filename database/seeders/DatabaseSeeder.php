<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Data\StepsData;
use App\Data\UnitsData;
use App\Data\UsersData;
use App\Data\ImagesData;
use App\Data\RecipesData;
use App\Data\QuantitiesData;
use App\Data\IngredientsData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /** add ingredients to DB */

        $ingredientsData = new IngredientsData();
        $ingredients = $ingredientsData->ingredients();

        foreach ($ingredients as $ingredient) {
            DB::table('ingredients')
                ->insert($ingredient);
        }

        /** add users to DB */

        $usersData = new UsersData();
        $users = $usersData->users();

        foreach ($users as $user) {
            DB::table('users')
                ->insert($user);
        }

        /** add units to DB */

        $unitsData = new UnitsData();
        $units = $unitsData->units();

        foreach ($units as $unit) {
            DB::table('units')
                ->insert($unit);
        }

        /** add recipes to DB */

        $recipesData = new RecipesData();
        $recipes = $recipesData->recipes();

        foreach ($recipes as $recipe) {
            DB::table('recipes')
                ->insert($recipe);
        }
        
        
        /** add images to DB */

        $imagesData = new ImagesData();
        $images = $imagesData->images();

        foreach ($images as $image) {
            DB::table('images')
                ->insert($image);
        }
        
        
        /** add steps to DB */

        $stepsData = new StepsData();
        $descriptions = $stepsData->descriptions();

        foreach ($descriptions as $description) {
            DB::table('steps')
                ->insert($description);
        }
        
        
        /** add quantities to DB */

        $quantitiesData = new QuantitiesData();
        $quantities = $quantitiesData->quantities();

        foreach ($quantities as $quantitie) {
            DB::table('quantities')
                ->insert($quantitie);
        }

    }
}
