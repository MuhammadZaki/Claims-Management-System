<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function company()
    {
        return $this->belongsTo(Admin::class);
    }

    public function service()
    {
        return $this->belongsTo(MedicalService::class);
    }

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
}
