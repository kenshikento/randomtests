<?php

namespace tests\Concerns;

use App\Armaments;
use App\CraftTypes;
use App\SpaceCraft;
use Faker\Generator;
use Illuminate\Support\Facades\DB;

trait SeedSites
{
    public function mainData()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $faker = app(Generator::class);
        factory(CraftTypes::class,3)->create();
        $crafts = factory(SpaceCraft::class,10)->create();
        $weapons = factory(Armaments::class,10)->create();

        foreach ($crafts as $key => $craft) {
            $craft->armaments()->attach($weapons[$key]->id, ['qty' => rand(1,1000)]);
        }

        $crafts[0]->armaments()->attach($weapons[1]->id, ['qty' => 1000000000]);
        //$craft->armaments()->attach($weapons[2]->id, ['qty' => rand(1,1000)]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
