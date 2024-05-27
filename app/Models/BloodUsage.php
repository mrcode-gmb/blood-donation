<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        "blood_inventory_id",
        "hospital_details_id",
        "comment",
        "burking_date",
        "accept_date"
    ];


    public function blooIventory()
    {
        return $this->belongsTo(BloodInventory::class, 'blood_inventory_id', 'id');
    }
}
