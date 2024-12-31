<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClrMain extends Model
{
    use HasFactory;

    protected $table = 'clr_mains';

    public function eventone(): HasOne
    {
        return $this->hasOne(ClrEventOne::class, 'clr_main_id', 'id');
    }

    public function eventtwo(): HasOne
    {
        return $this->hasOne(ClrEventTwo::class, 'clr_main_id', 'id');
    }
}
