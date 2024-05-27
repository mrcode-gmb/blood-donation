<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorGivenBlood extends Model
{
    use HasFactory;

    protected $fillable = [
        "hospital_details_id",
        "blood_id",
        "user_id",
        "quantity",
        "collection_date",
    ];


    public function hospitalDetails()
    {
        return $this->belongsTo(HospitalDetails::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function bloodGroup()
    {
        return $this->belongsTo(Blood::class, "blood_id", "id");
    }

}
