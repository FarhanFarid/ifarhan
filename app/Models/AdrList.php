<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AdrList extends Model
{
    use HasFactory;

    protected $table = 'adr_list';

    public function patientinfo(): BelongsTo
    {
        return $this->belongsTo(PatientInformation::class, 'episodeno', 'episodenumber');
    }
}
