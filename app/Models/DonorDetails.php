<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'blood_id',
        'hiv_status',
        'lga',
        'home_address',
        'reason',
        'gender',
        'state_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function bloodGroup(){
        return $this->hasOne(Blood::class, 'id', 'blood_id');
    }

    public function lgaRel(){
        return $this->hasOne(Lga::class, 'id', 'lga');
    }
}

