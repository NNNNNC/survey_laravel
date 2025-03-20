<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficesSeeder extends Seeder {
    public function run() {
        DB::table('offices')->insert([
            ['name' => 'Office of the Registrar'],
            ['name' => 'Accounting Office'],
            ['name' => 'Human Resources'],
            ['name' => 'IT Department'],
            ['name' => 'Library Services'],
        ]);
    }
}
