<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->statement("TRUNCATE TABLE languages");

        $sql = "INSERT INTO `languages` (`code`, `name`, `icon`, `active`) VALUES
            ('cs', 'czech', 'cs', 0),
            ('de', 'german', 'de', 0),
            ('el', 'greek', 'gr', 0),
            ('en', 'english', 'us', 1),
            ('es', 'spanish', 'es', 0),
            ('fr', 'french', 'fr', 0),
            ('hr', 'croatian', 'hr', 0),
            ('it', 'italian', 'it', 0),
            ('ko', 'korean', 'kr', 1),
            ('nl', 'dutch', 'nl', 0),
            ('no', 'norwegian', 'no', 0),
            ('pl', 'polish', 'pl', 0),
            ('pt', 'portuguese', 'pt', 0),
            ('pt-br', 'portuguese-brazilian', 'pt', 0),
            ('ro', 'romanian', 'ro', 0),
            ('ru', 'russian', 'ru', 0),
            ('sr', 'serbian', 'sr', 0),
            ('tr', 'turkish', 'tr', 0),
            ('vi', 'vietnamese', 'vn', 1);";

        DB::connection('mysql')->statement($sql);
    }
}
