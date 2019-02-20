<?php

use App\Helpers\Constant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(User::class)->updateOrInsert([
            'email' => 'nitzsth2@gmail.com',
        ], [
            'name'       => 'Nitesh K. Yagol',
            'password'   => bcrypt('shiva108'),
            'role'       => Constant::ADMIN,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
