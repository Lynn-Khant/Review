<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use GuzzleHttp\Promise\Create;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Blog::truncate();
        Category::truncate();

        $mgmg=User::factory()->create(["name"=>"MgMg","username"=>'mgmg']);
        $aungaung=User::factory()->create(["name"=>"AungAung","username"=>"aungaung"]);

        $frontEnd=Category::factory()->create(["name"=>"front end","slug"=>"front-end"]);
        $backEnd=Category::factory()->create(["name"=>"back end","slug"=>"back-end"]);

        Blog::factory()->create(["category_id"=>$frontEnd->id,"user_id"=>$mgmg->id]);
        Blog::factory()->create(["category_id"=>$frontEnd->id,"user_id"=>$mgmg->id]);
        Blog::factory()->create(["category_id"=>$backEnd->id,"user_id"=>$mgmg->id]);
        Blog::factory()->create(["category_id"=>$backEnd->id,"user_id"=>$aungaung->id]);

        
        
        User::factory(10)->create();
    }
}
