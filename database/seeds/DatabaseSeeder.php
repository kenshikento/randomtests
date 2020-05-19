<?php

use Illuminate\Database\Seeder;
use tests\Concerns\SeedSites;

class DatabaseSeeder extends Seeder
{
	use SeedSites;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->getOutput()->writeln('<info>Seeding:</info> Main Site');
        $this->mainData();
    }
}
