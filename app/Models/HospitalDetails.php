<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hostpital_name',
        'moto_name',
        'lga_id',
        'address',
        'postal_code',
        'phone',
        'email',
        'website',
        'operating_hours',
        'blood_donation_center',
        'donation_center_hours',
        'types_of_blood_donation',
        'emergency_services',
        'license_number',
        'license_validity_period',
        'primary_contact_name',
        'primary_contact_position',
        'primary_contact_phone',
        'primary_contact_email',
        'operating_license',
        'notes',
        'accreditation_status',
        'csc_license',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lgas()
    {
        return $this->belongsTo(Lga::class, 'lga_id', 'id');
    }

    public function bloodInventory()
    {
        return $this->hasMany(BloodInventory::class, 'hospital_details_id', 'id');
    }

    public function donorGivenBlood()
    {
        return $this->hasOne(DonorGivenBlood::class, 'hospital_details_id', 'id');
    }
}
