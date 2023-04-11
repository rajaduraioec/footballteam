<?php

namespace App\Models;

use App\Traits\UniqueIndentifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory, UniqueIndentifier;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'firstName',
        'lastName',
        'playerImageURI',
        'teamId'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'teamId');
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
