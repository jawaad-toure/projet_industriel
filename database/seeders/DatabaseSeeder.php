<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Data\UnitData;
use App\Data\UserData;
use App\Data\RecipeData;
use App\Data\IngredientData;
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

        $ingredientsData = new IngredientData();
        $ingredients = $ingredientsData->ingredients();

        foreach ($ingredients as $ingredient) {
            DB::table('ingredients')
                ->insert($ingredient);
        }

        /** add users to DB */

        $usersData = new UserData();
        $users = $usersData->users();

        foreach ($users as $user) {
            DB::table('users')
                ->insert($user);
        }

        /** add units to DB */

        $unitsData = new UnitData();
        $units = $unitsData->units();

        foreach ($units as $unit) {
            DB::table('units')
                ->insert($unit);
        }

        /** add recipes to DB */

        $recipesData = new RecipeData();
        $recipes = $recipesData->recipes();

        foreach ($recipes as $recipe) {
            DB::table('recipes')
                ->insert($recipe);
        }

    }
}
