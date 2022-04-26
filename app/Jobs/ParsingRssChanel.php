<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ParsingRssChanel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $link;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $xml = @simplexml_load_file($this->link);

        $last_post = Post::orderBy('created_at', 'desc')->first();

        foreach ($xml->xpath('//item') as $item) {
            if(date("Y-m-d H:i:s", strtotime($item->pubDate)) > date("Y-m-d H:i:s", strtotime($last_post->pub_date))) {
                if(Post::where('title', $item->title)->count() === 0) {
                    Post::create([
                        'title' => $item->title,
                        'description' => strip_tags($item->description),
                        'pub_date' => $item->pubDate
                    ]);
                }
            }
        }

    }
}
