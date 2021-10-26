<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
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
        // Populate Articles
        Article::factory(5)->create();

        // Populate Tags
        Tag::factory(10)->create();

        // Add [0, 3] tags for each article
        $tags = Tag::all();

        $articles = Article::all();

        foreach ($articles as $article) {
            $article->tags()->attach(
                $tags->random(rand(0, 3))->pluck('id')->toArray()
            );
        }
    }
}
