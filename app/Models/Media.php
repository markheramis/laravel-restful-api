<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;


    public function owner()
    {
        $this->belongsTo(User::class);
    }
    
    protected $fillable = [
        'path',
        'description',
        'status'
    ];
}
