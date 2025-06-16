<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class iNurGeneral extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'inur_generals';

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function patientinformation()
    {
        return $this->hasOne(PatientInformation::class, 'id', 'patientinformation_id');
    }
}
