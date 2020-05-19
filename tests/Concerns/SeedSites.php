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
        factory(SpaceCraft::class,10)->create();
        factory(Armaments::class,10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
