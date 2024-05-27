<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    use HasFactory;


    public function donorDetails(){
        return $this->belongsTo(Blood::class, 'blood_id', 'id');
    }

    public function bloodInventory()
    {
        return $this->hasMany(BloodInventory::class, 'blood_id', 'id');
    }

    public function donorGivenBlood()
    {
        return $this->belongsTo(DonorGivenBlood::class, "blood_id", "id");
    }
}
