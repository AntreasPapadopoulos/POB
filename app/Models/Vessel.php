<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;
    
    /**
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'mmsi',
        'operator_id',
    ];

    /**
     * Get the operator that owns the vessel.
     */
    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    /**
     * Get the passengersOnBoard for the vessel.
     */
    public function passengersOnBoard(): HasMany
    {
        return $this->hasMany(Vessel::class);
    }
}
