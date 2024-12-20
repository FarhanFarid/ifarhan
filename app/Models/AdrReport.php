<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AdrReport extends Model
{
    use HasFactory;

    protected $table = 'adr_report';

    public function descriptions(): HasOne
    {
        return $this->hasOne(AdrDescription::class, 'adrreport_id', 'id');
    }

    public function susdrugs(): HasOne
    {
        return $this->hasOne(AdrSuspectedDrug::class, 'adrreport_id', 'id');
    }

    public function concodrugs(): HasMany
    {
        return $this->hasMany(AdrConcoDrug::class, 'adrreport_id', 'id');
    }

    public function createdby(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedby(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function patientinfo(): BelongsTo
    {
        return $this->belongsTo(PatientInformation::class, 'episodeno', 'episodenumber');
    }

}
