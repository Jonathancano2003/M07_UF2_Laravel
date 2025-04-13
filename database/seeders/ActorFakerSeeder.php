<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorFakerSeeder extends Seeder
{
    public function run()
    {
        
        Actor::factory()->count(10)->create();
    }
}
