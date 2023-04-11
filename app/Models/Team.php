<?php

namespace App\Models;

use App\Traits\UniqueIndentifier;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory, UniqueIndentifier;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'logoURI',
    ];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class, 'teamId');
    }
}
