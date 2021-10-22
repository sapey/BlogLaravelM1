<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Aider sur quel table le fichier doit utiliser
    protected $table = "posts";

    //Les champs qu'il a le droit de remplir
    protected $fillable = ['title', 'description', 'extrait', 'picture'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post', 'id');
    }

    public function countComments(){
        return sizeof($this->comments);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'posts_categories', 'post', 'category');
    }

}
