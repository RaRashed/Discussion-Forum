<?php

use LaravelForum\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel 5.8',
            'slug' => str_slug('Laravel 5.8')

        ]);
        Channel::create([
            'name' => 'Vue js',
            'slug' => str_slug('Vue js')

        ]);
        Channel::create([
            'name' => 'Angular 7',
            'slug' => str_slug('Angular 7')

        ]);
        Channel::create([
            'name' => 'Laravel 8',
            'slug' => str_slug('Laravel 8')

        ]);
    }
}
