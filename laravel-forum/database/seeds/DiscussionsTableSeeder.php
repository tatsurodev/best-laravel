<?php

use Illuminate\Database\Seeder;
use LaravelForum\Discussion;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Discussion::class, 10)->create();
    }
}
