<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'image'];

    protected $appends = ['tags'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function getTagsAttribute()
    {
        return $this->tags()->pluck('name')->toArray();
    }

    // ## Custom Helper Methods
    public function getArticleData()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'tags' => $this->tags,
        ];
    }
}
