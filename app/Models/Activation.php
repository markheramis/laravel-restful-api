<?php

namespace App\Models;
use App\Models\User;
use Cartalyst\Sentinel\Activations\EloquentActivation as Model;
class Activation extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}
