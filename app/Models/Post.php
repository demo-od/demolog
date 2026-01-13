<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function readTime() {
        $wordCount = str_word_count(strip_tags($this->content));
        $readingSpeed = 200; // Average reading speed in words per minute
        $minutes = ceil($wordCount / $readingSpeed);
        return max(1, $minutes);
    }
}
