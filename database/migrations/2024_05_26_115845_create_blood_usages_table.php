<?php

use App\Models\BloodInventory;
use App\Models\HospitalDetails;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blood_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BloodInventory::class)->constrained();
            $table->foreignIdFor(HospitalDetails::class)->constrained();
            $table->string("hospital_details_id_own")->nullable();
            $table->string("comment")->nullable();
            $table->string("burking_date")->nullable();
            $table->string("accept_date")->nullable();
            $table->string("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_usages');
    }
};
