<?php

namespace App\Http\Controllers;

use App\Mail\Approved;
use App\Mail\Rejected;
use App\Models\Blood;
use App\Models\BloodInventory;
use App\Models\DonorDetails;
use App\Models\DonorGivenBlood;
use App\Models\HospitalDetails;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;
use Mail;

class HospitalDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $hospotal = HospitalDetails::
            with('user')
            ->with('lgas')
            ->get()
            ->transform(fn($hospital) => [
                'id' => $hospital->id ?? null,
                'hospital_id' => Crypt::encrypt($hospital->id) ?? null,
                'user_id' => Crypt::encrypt($hospital->user->id) ?? null,
                'user_id_none' => $hospital->user->id ?? null,
                'user_name' => $hospital->user->name ?? null,
                'email' => $hospital->user->email ?? null,
                'is_active' => $hospital->user->is_active ?? null,

                'state' => $hospital->lgas->stateNames->state,
                'hostpital_name' => $hospital->hostpital_name,
                'moto_name' => $hospital->moto_name,
                'lga_names' => $hospital->lgas->lga_name,
                'hospital_address' => $hospital->address,
                'postal_code' => $hospital->postal_code,
                'hospital_phone' => $hospital->phone,
                'hospital_email' => $hospital->email,
                'hospital_website' => $hospital->website,
                'operating_hours' => $hospital->operating_hours,
                'blood_donation_center' => $hospital->blood_donation_center,
                'types_of_blood_donation' => $hospital->types_of_blood_donation,
                'emergency_services' => $hospital->emergency_services,
                'license_number' => $hospital->license_number,
                'license_validity_period' => $hospital->license_validity_period,
                'libratory_contact_name' => $hospital->primary_contact_name,
                'libratory_contact_position' => $hospital->primary_contact_position,
                'primary_contact_phone' => $hospital->primary_contact_phone,
                'primary_contact_email' => $hospital->primary_contact_email,
                'operating_license' => $hospital->operating_license,
                'notes' => $hospital->notes,
                'accreditation_status' => $hospital->accreditation_status,
                'csc_license' => $hospital->csc_license,

            ]);
        return Inertia::render("Pages/Hospitals")->with('hospotals', $hospotal);
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

        $hospotals = HospitalDetails::where('user_id', Auth::user()->id)->count();
        if ($hospotals > 0) {
            return response()->json([
                'status' => Response::HTTP_ALREADY_REPORTED,
            ]);
        }
        $request->validate([
            'hospital_name' => 'required',
            'hospital_moto' => 'required',
            'hospital_lga' => 'required',
            'hospital_postal_code' => 'required',
            'hospital_address' => 'required',

            'hospital_contact' => 'required',
            'hospital_email' => 'required',

            'blood_donation_center_availability' => 'required',
            'emergency_services_availability' => 'required',
            'blood_donation_accepted' => 'required',

            'accreditation_status' => 'required',
            'license_number' => 'required',
            'validity_period_license' => 'required',

            'doctor_name' => 'required',
            'doctor_gsm' => 'required',
            'doctor_email' => 'required',
        ]);

        $hospotal = HospitalDetails::create([
            'user_id' => Auth::user()->id,
            'hostpital_name' => $request->hospital_name,
            'moto_name' => $request->hospital_moto,
            'address' => $request->hospital_address,
            'lga_id' => $request->hospital_lga,
            'postal_code' => $request->hospital_postal_code,
            'phone' => $request->hospital_contact,
            'email' => $request->hospital_email,
            'website' => $request->hospital_website,
            'operating_hours' => 24,
            'blood_donation_center' => $request->blood_donation_center_availability,
            'types_of_blood_donation' => $request->blood_donation_accepted,
            'emergency_services' => $request->emergency_services_availability,
            'accreditation_status' => $request->accreditation_status,
            'license_number' => $request->license_number,
            'license_validity_period' => $request->validity_period_license,
            'primary_contact_name' => $request->doctor_name,
            'primary_contact_position' => 1,
            'primary_contact_phone' => $request->doctor_gsm,
            'primary_contact_email' => $request->doctor_email,
            'notes' => $request->notes,
        ]);
        if ($hospotal) {
            User::where('id', Auth::user()->id)->update([
                'role' => 4,
                'is_active' => 1,
            ]);

            return response()->json([
                'status' => Response::HTTP_OK,
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_CONFLICT,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(HospitalDetails $hospitalDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HospitalDetails $hospitalDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HospitalDetails $hospitalDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalDetails $hospitalDetails)
    {
        //
    }

    public function showHospitalProfile($id)
    {
        //
        $hospotal = HospitalDetails::where('id', Crypt::decrypt($id))
            ->with('user')
            ->with('lgas')
            ->get()
            ->transform(fn($hospital) => [
                'id' => $hospital->id ?? null,
                'hospital_id' => Crypt::encrypt($hospital->id) ?? null,
                'user_id' => Crypt::encrypt($hospital->user->id) ?? null,
                'user_id_none' => $hospital->user->id ?? null,
                'user_name' => $hospital->user->name ?? null,
                'email' => $hospital->user->email ?? null,
                'is_active' => $hospital->user->is_active ?? null,

                'state_id' => $hospital->lgas->state_id,
                'state' => $hospital->lgas->stateNames->state,
                'hostpital_name' => $hospital->hostpital_name,
                'moto_name' => $hospital->moto_name,
                'lga_names' => $hospital->lgas->lga_name,
                'hospital_address' => $hospital->address,
                'postal_code' => $hospital->postal_code,
                'hospital_phone' => $hospital->phone,
                'hospital_email' => $hospital->email,
                'hospital_website' => $hospital->website,
                'operating_hours' => $hospital->operating_hours,
                'blood_donation_center' => $hospital->blood_donation_center,
                'types_of_blood_donation' => $hospital->types_of_blood_donation,
                'emergency_services' => $hospital->emergency_services,
                'license_number' => $hospital->license_number,
                'license_validity_period' => $hospital->license_validity_period,
                'libratory_contact_name' => $hospital->primary_contact_name,
                'libratory_contact_position' => $hospital->primary_contact_position,
                'primary_contact_phone' => $hospital->primary_contact_phone,
                'primary_contact_email' => $hospital->primary_contact_email,
                'operating_license' => $hospital->operating_license,
                'notes' => $hospital->notes,
                'accreditation_status' => $hospital->accreditation_status,
                'csc_license' => $hospital->csc_license,

            ]);

        $donors = DonorDetails::where('state_id', $hospotal[0]['state_id'])->with('user')
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
                'state_id' => $donor->lgaRel->state_id,
                'home_address' => $donor->home_address,
                'reason' => $donor->reason,
                'selectName' => 'select',
            ]);

        $bloodInventory = BloodInventory::where(['hospital_details_id' => Crypt::decrypt($id), 'is_active' => 1])
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

        return Inertia::render("Pages/HospitalProfile", ['hospotals' => $hospotal, 'donors' => $donors, 'bloodGroup' => Blood::all(), 'bloodInventories' => $bloodInventory]);
    }

    public function myProfile()
    {
        $hospotal = HospitalDetails::where('user_id', Auth::user()->id)
            ->with('user')
            ->with('lgas')
            ->get()
            ->transform(fn($hospital) => [
                'id' => $hospital->id ?? null,
                'hospital_id' => Crypt::encrypt($hospital->id) ?? null,
                'user_id' => Crypt::encrypt($hospital->user->id) ?? null,
                'user_id_none' => $hospital->user->id ?? null,
                'user_name' => $hospital->user->name ?? null,
                'email' => $hospital->user->email ?? null,
                'is_active' => $hospital->user->is_active ?? null,

                'state_id' => $hospital->lgas->state_id,
                'state' => $hospital->lgas->stateNames->state,
                'hostpital_name' => $hospital->hostpital_name,
                'moto_name' => $hospital->moto_name,
                'lga_names' => $hospital->lgas->lga_name,
                'hospital_address' => $hospital->address,
                'postal_code' => $hospital->postal_code,
                'hospital_phone' => $hospital->phone,
                'hospital_email' => $hospital->email,
                'hospital_website' => $hospital->website,
                'operating_hours' => $hospital->operating_hours,
                'blood_donation_center' => $hospital->blood_donation_center,
                'types_of_blood_donation' => $hospital->types_of_blood_donation,
                'emergency_services' => $hospital->emergency_services,
                'license_number' => $hospital->license_number,
                'license_validity_period' => $hospital->license_validity_period,
                'libratory_contact_name' => $hospital->primary_contact_name,
                'libratory_contact_position' => $hospital->primary_contact_position,
                'primary_contact_phone' => $hospital->primary_contact_phone,
                'primary_contact_email' => $hospital->primary_contact_email,
                'operating_license' => $hospital->operating_license,
                'notes' => $hospital->notes,
                'accreditation_status' => $hospital->accreditation_status,
                'csc_license' => $hospital->csc_license,

            ]);

        $donors = DonorDetails::where('state_id', $hospotal[0]['state_id'])->with('user')
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
                'state_id' => $donor->lgaRel->state_id,
                'home_address' => $donor->home_address,
                'reason' => $donor->reason,
                'selectName' => 'select',
            ]);

        $bloodInventory = BloodInventory::where(['hospital_details_id' => $hospotal[0]['id'], 'is_active' => 1])
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

        return Inertia::render("Pages/HospitalProfile", ['hospotals' => $hospotal, 'donors' => $donors, 'bloodGroup' => Blood::all(), 'bloodInventories' => $bloodInventory]);
    }
    public function updateState(Request $request, $id)
    {
        $request->validate([
            'selectVal' => 'required',
        ]);
        $users = User::where('id', $id)->update([
            'is_active' => $request->selectVal,
        ]);
        $user = User::where("id", $id)->get()[0]->name;
        if ($users) {
            if(User::where("id", $id)->get()[0]->is_active == 2){
                Mail::to(User::where("id", $id)->get()[0]->email)->send(new Approved($user));
                return response()->json([
                    'status' => Response::HTTP_OK,
                ]);
            }
            else{
                Mail::to(User::where("id", $id)->get()[0]->email)->send(new Rejected($user));
                return response()->json([
                    'status' => Response::HTTP_OK,
                ]);
            }
        }
        return response()->json([
            'status' => Response::HTTP_ALREADY_REPORTED,
        ]);
    }

    public function donorGivenBlood()
    {
        if(Auth::user()->role == 1){
            $giveBlood = DonorGivenBlood::with('hospitalDetails')->with("users")->with("bloodGroup")->get()->transform(fn($data)=>[
                'hospital_name'     => $data->hospitalDetails->hostpital_name,
                'hospital_city'     => $data->hospitalDetails->lgas->stateNames->state,
                'donor_name'        => $data->users->name,
                'donor_email'        => $data->users->email,
                'blood_group'        => $data->bloodGroup->blood_name,
                'id'        => $data->id,
                'quantity'        => $data->quantity,
                'collection_date'        => $data->collection_date,
            ]);
        }
        else{
            $giveBlood = DonorGivenBlood::where("hospital_details_id", Auth::user()->hostpitalDetails->id)->with('hospitalDetails')->with("users")->with("bloodGroup")->get()->transform(fn($data)=>[
                'hospital_name'     => $data->hospitalDetails->hostpital_name,
                'hospital_city'     => $data->hospitalDetails->lgas->stateNames->state,
                'donor_name'        => $data->users->name,
                'donor_email'        => $data->users->email,
                'blood_group'        => $data->bloodGroup->blood_name,
                'id'        => $data->id,
                'quantity'        => $data->quantity,
                'collection_date'        => $data->collection_date,
            ]);
        }
        $users = User::where('id', '!=', Auth::user()->id)->where('role', '=', 3)->where('is_active', 2)->get();
        return Inertia::render("Pages/DonorGivenBlood", ["bloodGroup" => Blood::all(), 'users' => $users, 'giveBlood' => $giveBlood]);
    }

    public function createGivenBlood(Request $request)
    {
        $request->validate([
            'blood_group' => 'required',
            'email' => 'required',
            'quantity' => 'required',
        ]);

        $user = DonorGivenBlood::create([
            'hospital_details_id' => Auth::user()->hostpitalDetails->id,
            'blood_id'             => $request->blood_group,
            'user_id'           => $request->email,
            'quantity'          => $request->quantity,
            'collection_date'   => date("d M, Y"),
        ]);
        if ($user) {
            return response()->json([
                'status' => Response::HTTP_OK,
            ]);
        }
        return response()->json([
            'status' => Response::HTTP_ALREADY_REPORTED,
        ]);
    }
}
