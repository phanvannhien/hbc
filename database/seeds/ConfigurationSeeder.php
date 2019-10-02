<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            [
                'name' => 'address',
                'config_value' => '123 ABC Q1 HCM',
                'type' => 'text',
                'label' => 'Address',

            ],
            [
                'name' => 'phone',
                'config_value' => '0902181852',
                'type' => 'text',
                'label' => 'Phone',

            ],
            [
                'name' => 'hot_lone',
                'config_value' => '0902181852',
                'type' => 'text',
                'label' => 'Hot line',

            ],
            [
                'name' => 'email',
                'config_value' => 'phanvannhien@gmail.com',
                'type' => 'text',
                'label' => 'Email',

            ],
            [
                'name' => 'facebook_url',
                'config_value' => 'http://facebook.com',
                'type' => 'text',
                'label' => 'Facebook url',

            ],
            [
                'name' => 'google_url',
                'config_value' => 'http://google.com',
                'type' => 'text',
                'label' => 'Google url',

            ],
            [
                'name' => 'twitter_url',
                'config_value' => 'http://twitter.com',
                'type' => 'text',
                'label' => 'Twitter',

            ],
            [
                'name' => 'youtube_url',
                'config_value' => 'http://youtube.com',
                'type' => 'text',
                'label' => 'Youtube',

            ]
        ]);
    }
}
