<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class BloodLocation extends Model
{
    use HasFactory;

    protected $table = 'iblood_locations';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by', 'id');
    }

    public function transfer_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transfer_by', 'id');
    }


}
