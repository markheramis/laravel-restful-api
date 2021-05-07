<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(Categories::class);
    }

    public function child()
    {
        return $this->hasMany(Categories::class);
    }

}
