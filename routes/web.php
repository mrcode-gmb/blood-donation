<?php

use App\Http\Controllers\ApplyController;
use App\Http\Controllers\BloodInventoryController;
use App\Http\Controllers\DonorDetailsController;
use App\Http\Controllers\HospitalDetailsController;
use App\Http\Controllers\LgaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function(){
    Route::get('/apply', [ApplyController::class, 'index'])->name('applyIndex');
});

Route::middleware("auth")->group(function(){
    Route::get("lga/get/{state}", [LgaController::class, "index"])->name("lga.index");
    Route::post("/register-donor", [DonorDetailsController::class, "store"])->name("registerDonor");
    Route::get("/donors", [DonorDetailsController::class, "index"])->name("donors");
    Route::get("/donor/profile", [DonorDetailsController::class, "donorProfile"])->name("donors.profile");
    Route::post("/update-status/{id}", [DonorDetailsController::class, "updateStatus"])->name("updateStatus");


    // hospitals deailes route
    Route::post("/hostpitals/register", [HospitalDetailsController::class, "store"])->name("hospitals.store");
    Route::get("/hostpitals/records", [HospitalDetailsController::class, "index"])->name("hospitals.index");
    Route::get("/hostpitals/profile/{id}", [HospitalDetailsController::class, "showHospitalProfile"])->name("hospitals.show");
    Route::get("/my-profile", [HospitalDetailsController::class, "myProfile"])->name("hospitals.profile");
    Route::post("/update-status/hospital/{hospitalId}", [HospitalDetailsController::class, 'updateState'])->name("status");
    Route::get("/donor-givenb-lood", [HospitalDetailsController::class, 'donorGivenBlood'])->name("DonorGivenBlood");
    Route::post("/donor-given-bloode/create", [HospitalDetailsController::class, 'createGivenBlood'])->name("DonorGivenBlood.store");



    // blood inventory

    Route::post("/blood-bank/create/{id}", [BloodInventoryController::class, 'store'])->name('bloodInvertory');
    Route::get("/blood-bank/all", [BloodInventoryController::class, 'index'])->name('bloodInvertory.index');
    Route::get("/blood-bank/usage", [BloodInventoryController::class, 'usageBlood'])->name('bloodInvertory.usageBlood');
    Route::get("/blood-bank/expired", [BloodInventoryController::class, 'usageExpired'])->name('bloodInvertory.usageExpired');
    Route::post("/buy-need-blood/{id}/{inventId}", [BloodInventoryController::class, 'saveBlood'])->name('bloodInvertory.saveBlood');
    Route::post("/accepted-blood/{id}/{inventId}", [BloodInventoryController::class, 'accepted'])->name('bloodInvertory.accepted');


    // donor routes

});

require __DIR__.'/auth.php';
