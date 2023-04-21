<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PassengerOnBoard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'vessel_id',
        'operator_id',
        'no_of_passengers',
    ];

    /**
     * Get the user that owns the passengerOnBoard.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the vessel that owns the passengerOnBoard.
     */
    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }

    /**
     * Get the operator that owns the passengerOnBoard.
     */
    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }
}
