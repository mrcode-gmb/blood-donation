<?php

use App\Models\Blood;
use App\Models\User;
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
        Schema::create('donor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Blood::class)->constrained();
            $table->string("phone_number");
            $table->string("hiv_status");
            $table->string("pcv")->nullable();
            $table->string("lga");
            $table->string("gender");
            $table->string("home_address");
            $table->string("reason");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_details');
    }
};
