<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class BloodInventory extends Model
{
    use HasFactory;

    protected $table = 'iblood_inventories';

    public function locations(): HasMany
    {
        return $this->hasMany(BloodLocation::class, 'inventory_bagno', 'bagno');
    }

    public function locs(): HasOne
    {
        return $this->hasOne(BloodLocation::class, 'inventory_bagno', 'bagno');
    }

    public function detailprocedures(): HasOne
    {
        return $this->hasOne(BloodDetailProcedure::class, 'inventory_bagno', 'bagno');
    }

    public function bloodcomponents(): HasOne
    {
        return $this->hasOne(BloodBloodComponent::class, 'inventory_bagno', 'bagno');
    }

    public function clinicalhistories(): HasOne
    {
        return $this->hasOne(BloodRelevantHistory::class, 'inventory_bagno', 'bagno');
    }

    public function symptoms(): HasOne
    {
        return $this->hasOne(BloodSignSymptom::class, 'inventory_bagno', 'bagno');
    }

    public function investigations(): HasOne
    {
        return $this->hasOne(BloodRelevantInvestigation::class, 'inventory_bagno', 'bagno');
    }

    public function adverseoutcomes(): HasOne
    {
        return $this->hasOne(BloodOutcomeAdverseEvent::class, 'inventory_bagno', 'bagno');
    }

    public function adverseevents(): HasOne
    {
        return $this->hasOne(BloodTypeAdverseEvent::class, 'inventory_bagno', 'bagno');
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(BloodReaction::class, 'inventory_bagno', 'bagno');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transfuse_stop_by', 'id');
    }

    public function transfuse_start_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transfuse_start_by', 'id');
    }

    public function transfuse_verify_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transfuse_verify_by', 'id');
    }

    public function patinfo(): BelongsTo
    {
        return $this->belongsTo(PatientInformation::class, 'episodeno', 'episodenumber');
    }

    

}
