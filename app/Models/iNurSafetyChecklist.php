<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class iNurSafetyChecklist extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'inur_safety_checklist';

    public function inurgenerals()
    {
        return $this->belongsTo(iNurGeneral::class, 'inurgenerals_id', 'id');
    }
    
    public function lookupward()
    {
        return $this->hasOne(LookupWards::class, 'id', 'others_loc');
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function lastmodifiedby()
    {
        return $this->belongsTo(User::class, 'last_modified_by', 'id');
    }
}
