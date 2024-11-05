<?php

namespace App\Console\Commands;

use App\Models\HospitalDetails;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\BloodExpiredNotification;
use App\Models\BloodInventory;
use App\Models\Hospital; // Ensure you have a Hospital model
use App\Models\User; // Ensure you have a User model for admin
use Carbon\Carbon;

class CheckExpiredBlood extends Command
{
    protected $signature = 'blood:check-expired';
    protected $description = 'Check for expired blood units and send notification emails to relevant hospitals and admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get expired blood units
        $expiredBlood = BloodInventory::with("bloodGroup")->where('expiry_date', '<', date("Y-m-d"))
            ->get()
            ->transform(fn($invent) => [
                'blood_id' => $invent->bloodGroup->id,
                "hospital_details_id"=>$invent->hospital_details_id,
                'blood_group' => $invent->bloodGroup->blood_name,
                'blood_component' => $invent->blood_component,
                'quantity' => $invent->quantity,
                'collection_date' => $invent->collection_date,
                'expiry_date' => $invent->expiry_date,
            ]);


        if ($expiredBlood->isEmpty()) {
            // Group expired blood units by hospital

            $this->info('No expired blood units found.');
        } else {
            $hospitalsWithExpiredBlood = $expiredBlood->groupBy('hospital_details_id');

            // Get admin email
            $adminEmail = User::where('role', '1')->pluck('email')->first(); // Adjust 'role' as necessary

            foreach ($hospitalsWithExpiredBlood as $hospitalId => $bloodItems) {
                // Get the hospital details
                foreach ($expiredBlood as $expiredBloods) {

                    $hospital = HospitalDetails::find($expiredBloods['hospital_details_id']);
                    if ($hospital) {
                        // Send email notification to the hospital
                        Mail::to($hospital->email)->send(new BloodExpiredNotification($bloodItems));
                        Mail::to($adminEmail)->send(new BloodExpiredNotification($expiredBlood));
                    }
                }
            }
            // Send notification to admin if there are expired blood units
            $this->info('Expired blood notifications sent to relevant hospitals and admin.');
        }
    }
}
