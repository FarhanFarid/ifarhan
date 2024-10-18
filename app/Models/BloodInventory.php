<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class BloodInventory extends Model
{
    use HasFactory;

    protected $table = 'iblood_inventories';

    public function locations(): HasMany
    {
        return $this->hasMany(BloodLocation::class, 'inventory_bagno', 'bagno');
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(BloodReaction::class, 'inventory_bagno', 'bagno');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transfuse_stop_by', 'id');
    }

}
