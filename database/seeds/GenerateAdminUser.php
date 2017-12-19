<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Facades\Hash;

class GenerateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Mohamed Abdul-Fattah',
            'email'    => 'admin@admin.com',
            'type'     => 'admin',
            'password' => Hash::make('secret')
        ]);
    }
}
