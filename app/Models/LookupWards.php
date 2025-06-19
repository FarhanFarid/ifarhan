<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookupWards extends Model
{
    use HasFactory;

    public static function getWardDescById($id)
    {
        $desc = self::where('id', $id)->first()->ctloc_desc;
        return $desc ? $desc : '';
    }
}
