<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class BloodDetailProcedure extends Model
{
    use HasFactory;

    protected $table = 'iblood_detailprocedure';

    public function createdby(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedby(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

}
