<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $table = "user_meta";
    protected $fillable = [
        "user_id",
        "meta_key",
        "meta_value",
        "autoload",
    ];

    protected $guarded = [];

    protected  $casts = [
        "meta_value" => "array",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
