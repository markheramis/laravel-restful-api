<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';
    protected $fillable = [
        "user_id",
        "path",
        "url",
        "type",
        "description",
        "meta",
        "status",
    ];

    protected $guarded = [];

    protected $casts = [
        'meta' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
