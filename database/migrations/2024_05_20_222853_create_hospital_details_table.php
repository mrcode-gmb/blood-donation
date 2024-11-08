<?php

use App\Models\Lga;
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
        Schema::create('hospital_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string("hostpital_name");
            $table->string("moto_name");
            $table->foreignIdFor(Lga::class);
            $table->string('address');
            $table->string('postal_code');

            // Contact Information:
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->string('operating_hours')->nullable();

            // Blood Donation Specifics:
            $table->boolean('blood_donation_center');
            $table->string('donation_center_hours')->nullable();
            $table->string('types_of_blood_donation')->nullable();
            $table->boolean('emergency_services');

            // Accreditation and Licensing:
            $table->string('accreditation_status')->nullable();
            $table->string('license_number')->nullable();
            $table->string('license_validity_period')->nullable();

            // Point of Contact:
            $table->string('primary_contact_name');
            $table->string('primary_contact_position');
            $table->string('primary_contact_phone');
            $table->string('primary_contact_email');

            // Document Uploads
            $table->string("operating_license")->nullable();
            $table->string("csc_license")->nullable();
            $table->text('notes')->nullable();
            $table->string("csc_certificate")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_details');
    }
};
