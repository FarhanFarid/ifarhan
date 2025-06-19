<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class iNurDysphagiaScreening extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'inur_dysphagia_screening';

    public function inurgenerals()
    {
        return $this->belongsTo(iNurGeneral::class, 'inurgenerals_id', 'id');
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
