<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_details_id',
        'blood_id',
        'blood_component',
        'quantity',
        'collection_date',
        'expiry_date',
    ];


    public function hospitalDetails()
    {
        return $this->belongsTo(HospitalDetails::class);
    }

    public function bloodGroup()
    {
        return $this->belongsTo(Blood::class,'blood_id', 'id');
    }

    public function bloodUsage()
    {
        return $this->hasOne(BloodUsage::class, 'blood_inventory_id', 'id');
    }
}
