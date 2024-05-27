<?php

use App\Models\Blood;
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
        Schema::create('blood_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(HospitalDetails::class)->constrained();
            $table->foreignIdFor(Blood::class)->constrained();
            $table->string('blood_component')->nullable()->comment('components: plasma, red blood cells, white blood cells, and platelets. ');
            $table->string('quantity')->nullable()->comment('Humans. A typical adult has a blood volume of approximately 5 liters, with females and males having approximately the same blood percentage by weight (approx 7 to 8%) Blood volume is regulated by the kidneys.');
            $table->string('collection_date');
            $table->string('expiry_date');
            $table->string("is_active")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_inventories');
    }
};
