<?php

use App\Http\Models\UserList;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(UserList::class, 10)->create();
    }
}
