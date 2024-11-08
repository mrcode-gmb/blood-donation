<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Blood;
use App\Models\State;
use App\Mail\Approved;
use App\Mail\Rejected;
use App\Models\DonorDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\BloodInventory;
use App\Models\DonorGivenBlood;
use App\Models\HospitalDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response as FacadesResponse;

class DonorDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $donors = DonorDetails::with('user')
            ->with('bloodGroup')
            ->with('lgaRel')
            ->get()
            ->transform(fn($donor) => [
                'id' => $donor->id ?? null,
                'donor_id' => Crypt::encrypt($donor->id) ?? null,
                'user_id' => Crypt::encrypt($donor->user->id) ?? null,
                'user_id_none' => $donor->user->id ?? null,
                'user_name' => $donor->user->name ?? null,
                'email' => $donor->user->email ?? null,
                'is_active' => $donor->user->is_active ?? null,
                'phone_number' => $donor->phone_number ?? null,
                'blood_id' => $donor->bloodGroup->id ?? null,
                'blood_group' => $donor->bloodGroup->blood_name ?? null,
                'hiv_test' => ($donor->hiv_status == 1) ? "Yes" : 'No',
                'gender' => ($donor->gender == 1) ? "Male" : "Female",
                'state' => $donor->lgaRel->stateNames->state,
                'lga_names' => $donor->lgaRel->lga_name,
                'home_address' => $donor->home_address,
                'reason' => $donor->reason,
                "blood_certificate" => asset('storage/' . $donor->blood_certificate) ?? null,
                'selectName' => 'select'
            ]);

        return Inertia::render("Pages/Donors")->with('donors', $donors);
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
        $donorAllready = DonorDetails::where("user_id", Auth::user()->id)->count();

        if ($donorAllready) {
            return response()->json([
                "status" => Response::HTTP_ALREADY_REPORTED,
            ]);
        }

        $request->validate([
            'pnumber' => "required",
            'role' => 'required',
            'gender' => 'required',
            'blood_group' => 'required',
            'hiv' => 'required',
            'localGovt' => 'required',
            'home_address' => 'required',
            'reason' => 'required',
            'blood_certificate' => 'required|file|max:2048'
        ]);

        $donor = DonorDetails::create([
            'user_id' => Auth::user()->id,
            'phone_number' => $request->pnumber,
            'blood_id' => $request->blood_group,
            'hiv_status' => $request->hiv,
            'lga' => $request->localGovt,
            'home_address' => $request->home_address,
            'reason' => $request->reason,
            'gender' => $request->gender,
            'state_id' => $request->donor_state,
            "blood_certificate" => $request->file("blood_certificate")->store("uploads", "public"),
        ]);

        if ($donor) {
            User::where('id', Auth::user()->id)->update([
                'role' => $request->role,
                'is_active' => '1'
            ]);
        }
        return response()->json([
            "status" => Response::HTTP_OK,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DonorDetails $donorDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonorDetails $donorDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonorDetails $donorDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonorDetails $donorDetails)
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {

        if ($request->selectVal == "") {
            return response()->json([
                "status" => Response::HTTP_ALREADY_REPORTED,
            ]);
        }

        $users = User::where("id", Crypt::decrypt($id))->update([
            'is_active' => $request->selectVal
        ]);

        $user = User::where("id", Crypt::decrypt($id))->get()[0]->name;
        if ($users) {
            if (User::where("id", Crypt::decrypt($id))->get()[0]->is_active == 2) {
                Mail::to(User::where("id", Crypt::decrypt($id))->get()[0]->email)->send(new Approved($user));
                return response()->json([
                    'status' => Response::HTTP_OK,
                ]);
            } else {
                Mail::to(User::where("id", Crypt::decrypt($id))->get()[0]->email)->send(new Rejected($user));
                return response()->json([
                    'status' => Response::HTTP_OK,
                ]);
            }
        }

        return response()->json([
            "status" => Response::HTTP_ALREADY_REPORTED,
        ]);
    }


    public function donorProfile()
    {

        $donor = DonorDetails::where("user_id", Auth::user()->id)->with("bloodGroup")->with("lgaRel")->get()->transform(fn($data) => [
            'state_name' => $data->lgaRel->stateNames->state,
            'lga_name' => $data->lgaRel->lga_name,
            'blood_group' => $data->bloodGroup->blood_name,
            'donor_id' => $data->id,
            'donor_env' => Crypt::encrypt($data->id),
            'phone_number' => $data->phone_number,
            'hiv' => $data->hiv_status,
            'gender' => $data->gender,
            'reason' => $data->reason,
            'home_address' => $data->home_address
        ]);


        $giveBlood = DonorGivenBlood::where("user_id", Auth::user()->id)->with('hospitalDetails')->with("users")->with("bloodGroup")->get()->transform(fn($data) => [
            'hospital_name' => $data->hospitalDetails->hostpital_name,
            'hospital_city' => $data->hospitalDetails->lgas->stateNames->state,
            'donor_name' => $data->users->name,
            'donor_email' => $data->users->email,
            'blood_group' => $data->bloodGroup->blood_name,
            'id' => $data->id,
            'quantity' => $data->quantity,
            'collection_date' => $data->collection_date,
        ]);
        return Inertia::render("Pages/DonorProfile", ['donorRecord' => $donor, "state" => State::all(), "giveBlood" => $giveBlood]);
    }
}
