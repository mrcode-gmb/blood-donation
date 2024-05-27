<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    use HasFactory;

    public function donorDetails(){
        return $this->belongsTo(DonorDetails::class, 'lga', 'id');
    }

    public function stateNames(){
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function hospitalDetails(){
        return $this->hasOne(HospitalDetails::class, 'id', 'lga_id');
    }
}
