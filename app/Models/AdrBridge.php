<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AdrBridge extends Model
{
    use HasFactory;

    protected $table = 'adr_bridge';

    public function adrlist(): BelongsTo
    {
        return $this->belongsTo(AdrList::class, 'adr_id', 'adr_id');
    }

}
