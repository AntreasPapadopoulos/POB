<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    /**
     *
     * @var array<string, boolean>
     */
    protected $fillable = [
        'name',
        'api_token',
        'api_active',
    ];

    /**
     * Get the vessels for the operator.
     */
    public function vessels(): HasMany
    {
        return $this->hasMany(Vessel::class);
    }

    /**
     * Get the domains for the operator.
     */
    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class);
    }

    /**
     * Get the users for the operator.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the passengersOnBoard for the operator.
     */
    public function passengersOnBoard(): HasMany
    {
        return $this->hasMany(PassengerOnBoard::class);
    }
}
