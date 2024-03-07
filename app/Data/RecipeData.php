<?php

namespace App\Data;

class RecipeData
{

    public function recipes()
    {
        return [
            [
                "id" => 1, 
                "recipename" => "Recipe Name 1", 
                "time" => "10:00:00", 
                "cookingtype" => "four", 
                "category" => "entree", 
                "difficulty" => "difficile",
                "id_user" => 1,
            ],
            [
                "id" => 2, 
                "recipename" => "Recipe Name 2", 
                "time" => "11:00:00", 
                "cookingtype" => "poele", 
                "category" => "boisson",
                "difficulty" => "facile",
                "id_user" => 2,
            ],
            [
                "id" => 3, 
                "recipename" => "Recipe Name 3", 
                "time" => "12:00:00", 
                "cookingtype" => "vapeur", 
                "category" => "plat",
                "difficulty" => "moyen",
                "id_user" => 3,
            ],
            [
                "id" => 4, 
                "recipename" => "Recipe Name 4", 
                "time" => "13:00:00", 
                "cookingtype" => "barbecue", 
                "category" => "dessert",
                "difficulty" => "difficile",
                "id_user" => 4,
            ],
            [
                "id" => 5, 
                "recipename" => "Recipe Name 5", 
                "time" => "14:00:00", 
                "cookingtype" => "four", 
                "category" => "boisson",
                "difficulty" => "facile",
                "id_user" => 5,
            ],
            [
                "id" => 6, 
                "recipename" => "Recipe Name 6", 
                "time" => "15:00:00", 
                "cookingtype" => "sans cuisson", 
                "category" => "plat",
                "difficulty" => "moyen",
                "id_user" => 6,
            ],
            [
                "id" => 7, 
                "recipename" => "Recipe Name 7", 
                "time" => "16:00:00", 
                "cookingtype" => "vapeur", 
                "category" => "entree",
                "difficulty" => "difficile",
                "id_user" => 7,
            ],
            [
                "id" => 8, 
                "recipename" => "Recipe Name 8", 
                "time" => "17:00:00", 
                "cookingtype" => "poele", 
                "category" => "dessert",
                "difficulty" => "facile",
                "id_user" => 8,
            ],
            [
                "id" => 9, 
                "recipename" => "Recipe Name 9", 
                "time" => "18:00:00", 
                "cookingtype" => "four", 
                "category" => "plat",
                "difficulty" => "moyen",
                "id_user" => 9,
            ],
            [
                "id" => 10, 
                "recipename" => "Recipe Name 10", 
                "time" => "19:00:00", 
                "cookingtype" => "sans cuisson", 
                "category" => "entree",
                "difficulty" => "difficile",
                "id_user" => 10,
            ],
        ];
    }

}