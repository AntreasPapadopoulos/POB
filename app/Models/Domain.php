<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    /**
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'operator_id',
    ];

    /**
     * Get the operator that owns the domain.
     */
    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }
}
