<?php

use Illuminate\Database\Seeder;

class ContinentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $continents = array(
            array('code' => 'AF','name' => 'Africa'),
            array('code' => 'AN','name' => 'Antarctica'),
            array('code' => 'AS','name' => 'Asia'),
            array('code' => 'EU','name' => 'Europe'),
            array('code' => 'NA','name' => 'North America'),
            array('code' => 'OC','name' => 'Oceania'),
            array('code' => 'SA','name' => 'South America')
        );

        foreach ( $continents as $continent ){
            \App\Models\Continents::create( $continent );
        }


    }
}
