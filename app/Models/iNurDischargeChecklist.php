<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class iNurDischargeChecklist extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'inur_discharge_checklist';

    public function inurgenerals()
    {
        return $this->belongsTo(iNurGeneral::class, 'inurgenerals_id', 'id');
    }

    public function inurdcdocumentgiven()
    {
        return $this->hasOne(iNurDCDocumentGiven::class, 'dc_id', 'id');
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
        return $this->belongsTo(User::class, 'lastmodified_by', 'id');
    }
}
