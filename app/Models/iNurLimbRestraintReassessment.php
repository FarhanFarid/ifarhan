<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class iNurLimbRestraintReassessment extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'limbrestraint_reassessment';

    protected $fillable = ['limbrestraint_assessment_id', 'type_restraint_use', 'area_restraint', 'area_restraint_time', 'status_restraint', 'behavioral_assessment','skin_condition', 'adequate_nutrition_mgmt', 'limb_circulation', 'created_by', 'created_at', 'updated_by', 'updated_at'];

    public function inurlimbrestraint()
    {
        return $this->hasOne(iNurLimbRestraint::class, 'id', 'limbrestraint_assessment_id');
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
