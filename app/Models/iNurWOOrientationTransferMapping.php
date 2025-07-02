<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class iNurWOOrientationTransferMapping extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'inur_woorientation_transfer_mapping';

    public function inurwardorientation()
    {
        return $this->hasOne(iNurGeneral::class, 'id', 'inurgenerals_id')
                    ->where('status_id', 2);
    }
    
    public function inurwoorientation()
    {
        return $this->hasOne(iNurWOOrientationTransfer::class, 'id', 'woorientation_id')
                    ->where('type_wo', 'Orientation')
                    ->where('ot_status_id', 2);
    }

    public function inurwotransfer()
    {
        return $this->hasOne(iNurWOOrientationTransfer::class, 'id', 'wotransfer_id')
                    ->where('type_wo', 'Transfer')
                    ->where('ot_status_id', 2);
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
