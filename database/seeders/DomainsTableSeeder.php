<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domains = [
            'https://rukodeling.ru',
            'https://www.php.net',
            'https://yandex.ru',
            'https://ru.hexlet.io',
            'https://github.com',
            'https://laravel.com'
        ];
        foreach ($domains as $domain) {
            DB::table('domains')->insert([
                'name' => $domain,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
