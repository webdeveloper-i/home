<?php

namespace Database\Seeders;

use App\Models\Crm\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Config::updateOrCreate([
            'id' => 'grid-pagination-limit',
            'value' => 15
        ]);

        $parent = Config::updateOrCreate([
            'id' => 'max-upload-file-size',
            'value' => 4096000
        ]);
        $parent = Config::updateOrCreate([
            'id' => 'max-upload-image-size',
            'value' => 1024000
        ]);

    }
}
