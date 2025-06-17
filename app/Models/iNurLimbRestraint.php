<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class iNurLimbRestraint extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'limbrestraint_assessment';

    public function inurgenerals()
    {
        return $this->belongsTo(iNurGeneral::class, 'inurgenerals_id', 'id');
    }
    
    public function lookupward()
    {
        return $this->hasOne(LookupWards::class, 'id', 'ward');
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

    public function inurlimbrestraintreassessment()
    {
        return $this->hasOne(iNurLimbRestraintReassessment::class, 'id', 'limbrestraint_assessment_id');
    }
}
