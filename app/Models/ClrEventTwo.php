<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ClrEventTwo extends Model
{
    use HasFactory;
    protected $table = 'clr_event2';

    public function createdby(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
