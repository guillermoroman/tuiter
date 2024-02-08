<?php

namespace App\Models;

use App\Events\TuitCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tuit extends Model
{
    use HasFactory;

    protected $fillable = [
        'message'
    ];

    protected $dispatchesEvents = [
        'created' => TuitCreated::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
