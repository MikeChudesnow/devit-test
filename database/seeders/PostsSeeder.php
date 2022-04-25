<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $xml = @simplexml_load_file("https://lifehacker.com/rss");

        foreach ($xml->xpath('//item') as $item) {
           DB::table('posts')->insert([
               'title' => $item->title,
               'description' => $item->description,
               'pub_date' => $item->pubDate
           ]);
       }

    }
}
