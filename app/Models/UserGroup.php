<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    /**
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the users for the user group.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
