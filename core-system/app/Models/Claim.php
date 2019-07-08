<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
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

    public function provider()
    {
        return $this->belongsTo(Admin::class, 'hp_id');
    }

    public function service()
    {
        return $this->belongsTo(MedicalService::class);
    }
}
