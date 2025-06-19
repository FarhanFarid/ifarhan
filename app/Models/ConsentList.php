<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentList extends Model
{
    use HasFactory;

    protected $table = 'consent_masters';

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
