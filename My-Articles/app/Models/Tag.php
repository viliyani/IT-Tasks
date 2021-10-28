<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function articles() {
        return $this->belongsToMany(Article::class, 'article_tag');
    }

    // ## Custom Helper Methods
    public function getTagData()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
