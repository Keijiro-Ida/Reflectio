<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reflection extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote',
        'response',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
