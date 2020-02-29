<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'     => 'Tester Admin',
            'email'    => 'tester@admin.com',
            'password' => Hash::make('123456789')
        ];

        $user = (new User);

        $user->fill($data);
        $user->save();
    }
}
