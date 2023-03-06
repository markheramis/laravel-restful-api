<?php

namespace App\Models;
use App\Models\User;
use App\Interfaces\ActivationInterface;
use Illuminate\Database\Eloquent\Model;
class Activation extends Model implements ActivationInterface
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'completed',
        'completed_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'bool',
    ];

    /**
     * {@inheritdoc}
     */
    public function getCode(): string
    {
        return $this->attributes['code'];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
