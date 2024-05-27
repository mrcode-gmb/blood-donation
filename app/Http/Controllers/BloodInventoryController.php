<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\BloodUsage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\BloodInventory;
use App\Models\HospitalDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Crypt;

class BloodInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // /
        $bloodInventory = BloodInventory::where('is_active', 1)->whereDate("expiry_date", ">=", Carbon::today()->toDateString())
            ->with('hospitalDetails')
            ->with('bloodGroup')
            ->get()
            ->transform(fn($invent) => [
                'id' => $invent->id ?? null,
                'invent_id' => Crypt::encrypt($invent->id) ?? null,
                'hospitalId' => $invent->hospitalDetails->id ?? null,
                'hospital_id' => Crypt::encrypt($invent->hospitalDetails->id) ?? null,
                'hospital_name' => $invent->hospitalDetails->hostpital_name,
                'hospital_city' => $invent->hospitalDetails->lgas->stateNames->state,
                'hospital_lga' => $invent->hospitalDetails->lgas->lga_name,
                'user_id' => $invent->hospitalDetails->user_id,
                'blood_id' => $invent->bloodGroup->id,
                'blood_group' => $invent->bloodGroup->blood_name,
                'blood_component' => $invent->blood_component,
                'quantity' => $invent->quantity,
                'collection_date' => $invent->collection_date,
                'expiry_date' => $invent->expiry_date,
                'is_active' => $invent->is_active,

            ]);
        return Inertia::render("Pages/BlooInventory", ['bloodInventory' => $bloodInventory]);
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
    public function store(Request $request, $id)
    {
        //
        $request->validate([
            'blood_group' => 'required',
            'blood_component' => 'required',
            'quantity' => 'required',
            'collection_date' => 'required',
            'expiry_date' => 'required',
        ]);

        $bloodInventory = BloodInventory::create([
            'hospital_details_id' => Crypt::decrypt($id),
            'blood_id' => $request->blood_group,
            'blood_component' => $request->blood_component,
            'quantity' => $request->quantity,
            'collection_date' => $request->collection_date,
            'expiry_date' => $request->expiry_date,
        ]);

        if ($bloodInventory) {
            return response()->json([
                'status' => Response::HTTP_OK,
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_ALREADY_REPORTED,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BloodInventory $bloodInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BloodInventory $bloodInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BloodInventory $bloodInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodInventory $bloodInventory)
    {
        //
    }

    public function saveBlood(Request $request, $id, $inventId)
    {
        //
        $request->validate([
            'comment' => 'required',
        ]);

        $saveBlood = BloodUsage::create([
            'blood_inventory_id' => Crypt::decrypt($inventId),
            'hospital_details_id' => Auth::user()->hostpitalDetails->id,
            'comment' => $request->comment,
            'burking_date' => date("d M, Y h:i"),
        ]);

        if ($saveBlood) {

            BloodInventory::where("id", Crypt::decrypt($inventId))->update([
                'is_active' => 2,
            ]);
            return response()->json([
                'status' => Response::HTTP_OK,
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_ALREADY_REPORTED,
        ]);
    }

    public function usageBlood()
    {
        $bloodInventory = BloodUsage::where("hospital_details_id", Auth::user()->hostpitalDetails->id)->with("blooIventory")
            ->get()
            ->transform(fn($invent) => [
                'id' => $invent->id ?? null,
                'blood_usage_id' => Crypt::encrypt($invent->id) ?? null,
                'hospitalId' => $invent->hospitalDetails->id ?? null,
                'hospital_id' => Crypt::encrypt($invent->blooIventory->hospitalDetails->id) ?? null,
                'hospital_name' => $invent->blooIventory->hospitalDetails->hostpital_name,
                'hospital_city' => $invent->blooIventory->hospitalDetails->lgas->stateNames->state,
                'hospital_lga' => $invent->blooIventory->hospitalDetails->lgas->lga_name,
                'user_id' => $invent->blooIventory->hospitalDetails->user_id,
                'blood_id' => $invent->blooIventory->bloodGroup->id,
                'blood_group' => $invent->blooIventory->bloodGroup->blood_name,
                'blood_component' => $invent->blooIventory->blood_component,
                'quantity' => $invent->blooIventory->quantity,
                'collection_date' => $invent->blooIventory->collection_date,
                'expiry_date' => $invent->blooIventory->expiry_date,
                'is_active' => $invent->blooIventory->is_active,
                'comment' => $invent->comment,
                'blood_usageid' => encrypt($invent->id),
                'burking_date' => $invent->burking_date,
                'accept_date' => ($invent->accept_date == null) ? "Not collect" : $invent->accept_date,
            ]);

        return Inertia::render("Pages/BlooIUsage", ['bloodInventory' => $bloodInventory]);
    }

    public function accepted(Request $request, $id, $inventId)
    {
        //

        $saveBlood = BloodUsage::where("id", Crypt::decrypt($inventId))->update([
            'accept_date' => date("d M, Y h:i"),
        ]);

        if ($saveBlood) {
            return response()->json([
                'status' => Response::HTTP_OK,
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_ALREADY_REPORTED,
        ]);
    }


    public function usageExpired()
    {
        // /
        $bloodInventory = BloodInventory::where('is_active', 1)->whereDate("expiry_date", "<=", Carbon::today()->toDateString())
            ->with('hospitalDetails')
            ->with('bloodGroup')
            ->get()
            ->transform(fn($invent) => [
                'id' => $invent->id ?? null,
                'invent_id' => Crypt::encrypt($invent->id) ?? null,
                'hospitalId' => $invent->hospitalDetails->id ?? null,
                'hospital_id' => Crypt::encrypt($invent->hospitalDetails->id) ?? null,
                'hospital_name' => $invent->hospitalDetails->hostpital_name,
                'hospital_city' => $invent->hospitalDetails->lgas->stateNames->state,
                'hospital_lga' => $invent->hospitalDetails->lgas->lga_name,
                'user_id' => $invent->hospitalDetails->user_id,
                'blood_id' => $invent->bloodGroup->id,
                'blood_group' => $invent->bloodGroup->blood_name,
                'blood_component' => $invent->blood_component,
                'quantity' => $invent->quantity,
                'collection_date' => $invent->collection_date,
                'expiry_date' => $invent->expiry_date,
                'is_active' => $invent->is_active,

            ]);
        return Inertia::render("Pages/BloodExpired", ['bloodInventory' => $bloodInventory]);
    }
}
