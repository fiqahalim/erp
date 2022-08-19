<?php

namespace Webkul\Core\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BanksSeeder extends Seeder
{
    public function run()
    {
        DB::table('banks')->delete();

        $banks = json_decode(file_get_contents(__DIR__ . '/../../Data/banks.json'), true);

        DB::table('banks')->insert($banks);
    }
}
