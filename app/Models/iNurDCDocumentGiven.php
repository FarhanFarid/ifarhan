<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class iNurDCDocumentGiven extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'inur_dc_document_given';
}
