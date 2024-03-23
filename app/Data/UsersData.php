<?php

namespace App\Data;

use Illuminate\Support\Facades\Hash;

class UsersData
{
    public function users()
    {
        return [
            [
                "firstname" => "Malick",
                "lastname" => "Traoré",
                "username" => "malick_traore",
                "address" => "10 avenue de Martin Lavoie",
                "email" => "malick.traore@example.com",
                "phone" => "0741424344",
                "password" => Hash::make("A1&zerty"),
                "email_verified_at" => "2024-03-18 08:35:58",
                "created_at" => now(),
            ],
            [
                "firstname" => "Sophie",
                "lastname" => "Lefevre",
                "username" => "sophie_lefevre",
                "address" => "15 rue de la Fontaine",
                "email" => "sophie.lefevre@example.com",
                "phone" => "0652213344",
                "password" => Hash::make("A1&zerty"),
                "created_at" => now(),
            ],
            [
                "firstname" => "Jean",
                "lastname" => "Dupont",
                "username" => "jean_dupont",
                "address" => "23 boulevard des Alouettes",
                "email" => "jean.dupont@example.com",
                "phone" => "0611223344",
                "password" => Hash::make("A1&zerty"),
                "created_at" => now(),
            ],
            [
                "firstname" => "Marie",
                "lastname" => "Dubois",
                "username" => "marie_dubois",
                "address" => "8 impasse des Lilas",
                "email" => "marie.dubois@example.com",
                "phone" => "0687456321",
                "password" => Hash::make("A1&zerty"),
                "created_at" => now(),
            ],
            [
                "firstname" => "Pierre",
                "lastname" => "Martin",
                "username" => "pierre_martin",
                "address" => "42 rue de la Paix",
                "email" => "pierre.martin@example.com",
                "phone" => "0755896321",
                "password" => Hash::make("A1&zerty"),
                "created_at" => now(),
            ],
            [
                "firstname" => "Céline",
                "lastname" => "Roussel",
                "username" => "celine_roussel",
                "address" => "18 avenue des Roses",
                "email" => "celine.roussel@example.com",
                "phone" => "0612345678",
                "password" => Hash::make("A1&zerty"),
                "created_at" => now(),
            ],
            [
                "firstname" => "Luc",
                "lastname" => "Girard",
                "username" => "luc_girard",
                "address" => "5 rue du Château",
                "email" => "luc.girard@example.com",
                "phone" => "0678451236",
                "password" => Hash::make("A1&zerty"),
                "created_at" => now(),
            ],
            [
                "firstname" => "Isabelle",
                "lastname" => "Moreau",
                "username" => "isabelle_moreau",
                "address" => "30 rue des Acacias",
                "email" => "isabelle.moreau@example.com",
                "phone" => "0645896321",
                "password" => Hash::make("A1&zerty"),
                "created_at" => now(),
            ],
            [
                "firstname" => "Antoine",
                "lastname" => "Bouchard",
                "username" => "antoine_bouchard",
                "address" => "12 impasse des Cerisiers",
                "email" => "antoine.bouchard@example.com",
                "phone" => "0765236987",
                "password" => Hash::make("A1&zerty"),
                "created_at" => now(),
            ],
            [
                "firstname" => "Laura",
                "lastname" => "Fournier",
                "username" => "laura_fournier",
                "address" => "7 avenue Victor Hugo",
                "email" => "laura.fournier@example.com",
                "phone" => "0632145879",
                "password" => Hash::make("A1&zerty"),
                "created_at" => now(),
            ],
        ];
    }
}
?>
