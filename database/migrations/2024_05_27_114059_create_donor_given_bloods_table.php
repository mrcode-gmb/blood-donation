<?php

use App\Models\User;
use App\Models\Blood;
use App\Models\HospitalDetails;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donor_given_bloods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Blood::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(HospitalDetails::class)->constrained();
            $table->string('quantity');
            $table->string("collection_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_given_bloods');
    }
};
