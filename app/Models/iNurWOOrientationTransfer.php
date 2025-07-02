<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class iNurWOOrientationTransfer extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'inur_woorientation_transfer';

    public function lookuprelationship()
    {
        return $this->hasOne(LookupRelationships::class, 'id', 'advice_given_to_relation');
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

    public function advicegivenby()
    {
        return $this->belongsTo(User::class, 'advice_given_by', 'id');
    }
}
