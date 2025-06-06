<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public function category()
    {
            return $this->belongsTo(Category::class);

    }
    public function reviews()
    {
            return $this->hasMany(Review::class);

    }

    public function favorited_users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function reserves()
    {
            return $this->hasMany(Reserve::class);

    }

}
