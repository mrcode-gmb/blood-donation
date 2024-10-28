<?php

namespace App\Http\Controllers;

use App\Models\Blood;
use App\Models\DonorDetails;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blood = Blood::all();
        $state = State::all();
        $donorStatus = DonorDetails::where('user_id', Auth::user()->id)->get();
        if($donorStatus->isNotEmpty()){
            $donor = true;
        }
        else{
            $donor = false;
        }
        // $doctorStatus = DonorDetails::where('user_id', Auth::user()->id)->count();
        // $blood = Blood::all();
        return Inertia::render("Pages/BloodExpireds", ['bloods' => $blood, "state" => $state, 'donorStatus' => $donor]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
