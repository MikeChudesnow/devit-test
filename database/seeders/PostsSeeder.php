<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

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
           Post::create([
               'title' => $item->title,
               'description' => strip_tags($item->description),
               'pub_date' => $item->pubDate
           ]);
       }

    }
}
