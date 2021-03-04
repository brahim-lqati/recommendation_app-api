<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Comment;
use App\Models\Recommendation;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Cafée','Restaurant','Hotel', 'Station', 'Shop Market', 'Mosquée','Pharmacie'];
        $cities = ['Casablanca','Fes','Tanger','Marrakech','Salé','Meknes','Rabat',
                    'Oujda','Kenitra','Errachidia','Agadir','Mohammedia','Safi'];

        foreach($categories as $categ) {
            Category::create([
                'name_category' => $categ
            ]);    
        }
        foreach($cities as $city) {
            City::create([
                'name' => $city
            ]);    
        }
        $categories = Category::all();
        $cities = City::all();
        $services = Service::factory()->count(10)->make()->each(function($service) use($categories,$cities) {
            $service->category_id = $categories->random()->id;
            $service->city_id = $cities->random()->id;
            $service->save();
        });

        // Comment::factory()->count(50)->make()->each(function($comment) use ($services) {
        //     $comment->service_id = $services->random()->id;
        //     $comment->save();
        // });

        
        Recommendation::factory()->count(50)->make()->each(function($recom) use ($services) {
            $recom->service_id = $services->random()->id;
            $recom->save();
        });
    }
}
