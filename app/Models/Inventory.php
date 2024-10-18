<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'hmilk_inventories';

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
