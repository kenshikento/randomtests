<?php

namespace tests\Integration;

use App\Armaments;
use App\CraftTypes;
use App\SpaceCraft;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Request;
use tests\Concerns\SeedSites;
use tests\TestCase;

class SpaceCraftController extends TestCase
{
	use DatabaseMigrations, SeedSites;

	public function setUp() : void
	{
	    parent::setUp();
	    $this->runDatabaseMigrations();
	    $this->artisan('db:seed');

	}
	
	/*public function testAdd()
	{	
		$craft = factory(SpaceCraft::class)->make();

		$craftType = CraftTypes::find(1);
		$weapons = Armaments::all()->random(3);

		$craft->armaments = $weapons->toArray();
		$craft->craftname = $craftType->name;
		$craft = $craft->toArray();

        $this->json('POST', '/spacecraft', $craft)
            ->seeJson([
            	0 => 201,
        ]);
	}

	public function testUpdate()
	{	
		$faker = app(Generator::class);

		$craft = SpaceCraft::first();
		$id = $craft->id;

		$crafttype = CraftTypes::find(1);

		$weapons = Armaments::find(2);

		$data = [
			'name' => $faker->name,
			'status' => $faker->name,
			'image' => $faker->url,
			'crew' => rand(1,3000000),
			'value' => rand(1,3000000),
			'craftname' => $crafttype->name,
		];

		$weapons->qty = 4045;

		$data['armaments'][] = $weapons->toArray();

        $this->put('/spacecraft/' . $id, $data, []);
        
        $this->seeStatusCode(200);
	}
*/
	public function testDelete()
	{
		$craft = SpaceCraft::find(1);
		$id = $craft->id;

		$this->delete('/spacecraft/' . $id);

		$this->seeStatusCode(200);
	}

	public function testFindByWhatever()
	{
		//
	}
}
