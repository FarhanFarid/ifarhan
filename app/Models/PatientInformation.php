<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInformation extends Model
{
    use HasFactory;

    protected $table = 'patient_information';

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function wardinfo()
    {
        return $this->hasOne(LookupWards::class, 'ctloc_desc', 'epiward');
    }
}
