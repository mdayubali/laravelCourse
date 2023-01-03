<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Review;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'hello@ayub.com',
            'password' => bcrypt('password'),
            'type'   => 1,
        ]);

        $series = [
            [
                'name'  => 'PHP',
                'slug'  => 'php',
                'image' => 'https://cdn.pixabay.com/photo/2017/02/14/19/16/php-2066704_960_720.jpg',

            ],
            [
                'name'  => 'Wordpress',
                'slug'  => 'wordpress',
                'image' => 'https://cdn.pixabay.com/photo/2017/02/14/19/16/php-2066704_960_720.jpg',
            ],
            [
                'name'=> 'Javascripts',
                'slug'=> 'javascripts',
                'image' => 'https://cdn.pixabay.com/photo/2017/02/14/19/16/php-2066704_960_720.jpg',
            ],
            [
                'name'  => 'Laravel',
                'slug'  => 'laravel',
                'image' => 'https://cdn.pixabay.com/photo/2017/02/14/19/16/php-2066704_960_720.jpg',

            ],
            [
                'name'  => 'Vue Js',
                'slug'  => 'vue-js',
                'image' => 'https://cdn.pixabay.com/photo/2017/02/14/19/16/php-2066704_960_720.jpg',

            ]
        ];
        // $series = ['php','laravel','wordpress','javascript','nuxt js'];
        foreach($series as $item){
            Series::create([
                'name' => $item['name'],
                'slug'  => $item['slug'],
                'image' => $item['image'],
            ]);
        }

        $topics = ['Eloquent', 'Validation', 'Authorization', 'Testing', 'Refactoring'];
        foreach($topics as $item){
            $slug = strtolower(str_replace(' ', '-', $item));
            Topic::create([
                'name' => $item,
                'slug' => $slug,
            ]);
        }
        $platforms = ['Laracast', 'Youtube', 'Laracast Forum', 'Laravel News', 'Larajobs'];
        foreach($platforms as $item){
            Platform::create([
                'name' => $item,
            ]);
        }
        Author::factory()->count(10)->create();

        User::factory(count:50)->create();
        Course::factory(count:50)->create();

        $courses = Course::all();

        foreach($courses as $course){
            $topics = Topic::all()->random(rand(1,5))->pluck('id')->toArray();
            $course->topics()->attach($topics);

            $authors = Author::all()->random(rand(1,3))->pluck('id')->toArray();
            $course->authors()->attach($authors);

            $series = Series::all()->random(rand(1, 5))->pluck('id')->toArray();
            $course->series()->attach($series);
        }

        Review::factory(count:100)->create();


    }
}
