<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['title', 'content', 'category', 'user_id'];

    public function texts(): HasMany
    {
        return $this->hasMany(Text::class);
    }
}