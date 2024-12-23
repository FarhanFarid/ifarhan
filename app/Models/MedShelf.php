<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedShelf extends Model
{
    use HasFactory;

    protected $connection = 'med'; 
    protected $table = 'scans';
}
