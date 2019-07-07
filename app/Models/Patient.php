<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = ['id'];

    public function company()
    {
        return $this->hasOne(Admin::class, 'id', 'company_id');
    }

    public function plan()
    {
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }
}
