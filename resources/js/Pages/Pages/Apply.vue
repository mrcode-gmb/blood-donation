<script setup>
import HeadNav from "../../Components/HeadNav.vue";
import { Head } from '@inertiajs/vue3';
import '../../../../public/asset/mystyle/form.css';
import { defineProps } from "vue";
import axios from "axios";
import { ref } from "vue"
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { useToast } from 'vue-toastification';
import Toast, { POSITION } from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const lga = ref();
const toast = useToast();




const props = defineProps({
    bloods: Array,
    state: Array,
    donorStatus: Array | Object,
    doctorStatus: Array | Object,
});

const form = useForm({
    pnumber: '',
    role: '',
    gender: '',
    blood_group: '',
    hiv: '',
    localGovt: '',
    home_address: '',
    reason: '',
    donor_state: '',

    // hospital requirment

    hospital_name: '',
    hospital_moto: '',
    hospital_lga: '',
    hospital_state: '',
    hospital_postal_code: '',
    hospital_address: '',

    hospital_contact: '',
    hospital_email: '',
    hospital_website: '',

    blood_donation_center_availability: '',
    emergency_services_availability: '',
    blood_donation_accepted: '',

    accreditation_status: '',
    license_number: '',
    validity_period_license: '',

    doctor_name: '',
    doctor_gsm: '',
    doctor_email: '',
    notes: '',

});

const submit = () => {
    if (form.role == "3") {
        axios.post("/register-donor", form).then(responce => {
            console.log(responce);
            if (responce.data.status == 200) {
                console.log(responce.data.status)
                toast.success("Congratulation your application has been submited");
                location.reload()
            }
            else if (responce.data.status == 208) {
                toast.error("Already apply with this account");
            }
            else {
                toast.error("An error occurred while fetching records. Please try again.");
            }
        }).catch(error => {
            if (error.response && error.response.status === 422) {
                toast.error("All donation form fields must be required");
                // Display validation errors to the user
            }
        });
    }
    else if (form.role == "2") {
        axios.post("/hostpitals/register", form).then(approve => {

            if(approve.data.status == 200){
                location.reload()
                toast.success("Congratulation your application has been submited");
            }
            else if (approve.data.status == 208) {
                toast.error("Already apply with this account");
            }
            else {
                toast.error("An error occurred while fetching records. Please try again.");
            }

            // console.log(approve);
        }).catch(error => {
            if (error.response && error.response.status === 422) {
                toast.error("All donation form fields must be required");
                // Display validation errors to the user
            }
        });
    }
};

const roles = (res) => {
    let select = document.getElementById("roleCheck");
    let hospitalCheck = document.getElementById("hospitalCheck");
    let donorCheck = document.getElementById("donorCheck");

    if (res) {
        if (select.value == "2") {
            hospitalCheck.style.display = "block";
            donorCheck.style.display = "none";
        }
        else if (select.value == "3") {
            donorCheck.style.display = "block";
            hospitalCheck.style.display = "none";
        }
    }
};

const getLga = (stateId) => {
    if (stateId) {
        let state = document.getElementById("state");
        axios.get("/lga/get/" + state.value).then(res => {
            lga.value = res.data;
        }).catch(error => {

        });
    }

};

const getLgaDonor = (stateId) => {
    if (stateId) {
        let state = document.getElementById("stateDonor");
        axios.get("/lga/get/" + state.value).then(res => {
            lga.value = res.data;
        }).catch(error => {

        });
    }

};

</script>

<template>
    <div>

        <Head title="Apply" />
        <!-- Link side var and header here  -->
        <HeadNav />

        <section id="mainbody">
            <div class="main-body">
                <!-- start design dashboard content  -->
                <!-- start Dashboard tabs -->
                <div class="str">
                    <div class="str-home">
                        <i class="fa fa-home"></i>
                        <div class="db">
                            <h4>Dashboard / &nbsp;</h4>
                            <p>{{ $page.props.auth.user.name }}</p>
                        </div>
                    </div>
                </div>
                <div class="was-apply"
                    v-if="($page.props.auth.user.role == '3' && $page.props.auth.user.is_active == '1') || ($page.props.auth.user.role == '4' && $page.props.auth.user.is_active == '1')">
                    <div class="tabs" id="tabls">
                        <div class="full-chart">
                            <div class="chart-title">
                                <h3>Hi {{ $page.props.auth.user.name }}</h3>
                                <p>Congratulation your application has been submited success fully we contact you
                                    shortly through email or phone number</p>
                            </div>
                            <div class="dont-have">
                                <img src="../../../../public/asset/photos/3d-male-character-jumping-out-from-smart-phone-screen-and-holding-a-megaphone-free-png.png"
                                    alt="">
                            </div>
                            <div class="create-app">
                                <Link :href="route('dashboard')">
                                Review
                                </Link>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="now-apply" v-else-if="$page.props.auth.user.role == '2'">
                    <div class="tabs" id="tabls">
                        <div class="full-chart">
                            <div class="chart-title">
                                <h3>Hi {{ $page.props.auth.user.name }}</h3>
                                <p>Please click the apply button to apply as donar or hospital</p>
                            </div>
                            <form class="form-apply mt-1" @submit.prevent="submit" enctype="multipart/form-data">
                                <div class="form-body form-padding-0">
                                    <div class="form-group">
                                        <select name="" autofocus @change="roles(true)" id="roleCheck"
                                            v-model="form.role">
                                            <option value="" hidden>select role first</option>
                                            <option value="2">Hospital</option>
                                            <option value="3">Donor</option>
                                        </select>
                                        <label for="">Select role first <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="form-hospital d-none" id="hospitalCheck">
                                        <!-- home address  -->

                                        <div class="card-title">
                                            <h4>Basic Information</h4>
                                        </div>

                                        <div class="grid grid:3 gap10">
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="text" placeholder=" " v-model="form.hospital_name">
                                                    <label for="">Hospital name <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.hospital_name" />
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="text" placeholder=" " v-model="form.hospital_moto">
                                                    <label for="">Moto name <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.hospital_moto" />
                                            </div>
                                            <div class="form-group">
                                                <select name="" autofocus @change="getLga(true)" id="state" v-model="form.hospital_state">
                                                    <option value="" hidden>State</option>
                                                    <option v-for="states in state" :key="states.id" :value="states.id">
                                                        {{ states.state }}</option>
                                                </select>
                                                <label for=""> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <select name="" autofocus v-model="form.hospital_lga">
                                                        <option value="" hidden>Lga</option>
                                                        <option v-for="lgas in lga" :key="lgas.id" :value="lgas.id">{{
                                lgas.lga_name }}</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.hospital_lga" />
                                            </div>

                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="text" placeholder=" "
                                                        v-model="form.hospital_postal_code">
                                                    <label for="">Postal code <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.hospital_postal_code" />
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <textarea name="" placeholder="Hospital address"
                                                        v-model="form.hospital_address"></textarea>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.hospital_address" />
                                            </div>
                                        </div>


                                        <!-- contact imformation  -->
                                        <div class="card-title">
                                            <h4>Contact Information</h4>
                                        </div>

                                        <div class="grid grid:3 gap10">
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="number" placeholder=" "
                                                        v-model="form.hospital_contact">
                                                    <label for="">Phone number <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.hospital_contact" />
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="email" placeholder=" " v-model="form.hospital_email">
                                                    <label for="">Hospital email <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.hospital_email" />
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="link" placeholder=" " v-model="form.hospital_website">
                                                    <label for="">Website link</label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.hospital_website" />
                                            </div>
                                        </div>

                                        <!-- Blood Donation Specifics -->
                                        <div class="card-title">
                                            <h4>Blood Donation Specifics</h4>
                                        </div>

                                        <div class="grid grid:3 gap10">
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <select id="" v-model="form.blood_donation_center_availability">
                                                        <option value="" hidden>Blood Donation Center Availability
                                                        </option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.blood_donation_center_availability" />
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <select id="" v-model="form.emergency_services_availability">
                                                        <option value="" hidden>24/7 Emergency Services Availability
                                                        </option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.emergency_services_availability" />
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <select id="" v-model="form.blood_donation_accepted">
                                                        <option value="" hidden>Types of Blood Donation Accepted
                                                        </option>
                                                        <option value="whole blood">whole blood</option>
                                                        <option value="platelets">platelets</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.blood_donation_accepted" />
                                            </div>
                                        </div>

                                        <!-- Accreditation and Licensing -->

                                        <div class="card-title">
                                            <h4>Accreditation and Licensing</h4>
                                        </div>

                                        <div class="grid grid:3 gap10">
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <select id="" v-model="form.accreditation_status">
                                                        <option value="" hidden>Accreditation Status</option>
                                                        <option value="NAFDAC">NAFDAC</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.accreditation_status" />
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="text" placeholder=" " v-model="form.license_number">
                                                    <label for="">License Number <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.license_number" />
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="date" placeholder=" "
                                                        v-model="form.validity_period_license">
                                                    <label for="">Validity Period of License <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.validity_period_license" />
                                            </div>
                                        </div>

                                        <!-- Labratory of Contact -->
                                        <div class="card-title">
                                            <h4>Labratory Contact</h4>
                                        </div>

                                        <div class="grid grid:3 gap10">
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="text" placeholder=" " v-model="form.doctor_name">
                                                    <label for="">Doctor name <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.doctor_name" />
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="number" placeholder=" " v-model="form.doctor_gsm">
                                                    <label for="">Doctor GSM <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.doctor_gsm" />
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <input type="email" placeholder=" " v-model="form.doctor_email">
                                                    <label for="">Doctor email <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.doctor_email" />
                                            </div>
                                        </div>

                                        <!-- Document Uploads  -->

                                        <div class="card-title">
                                            <h4>Document Uploads</h4>
                                        </div>

                                        <div class="grid grid:3 gap10 mt-1">
                                            <div class="form-group">
                                                <input type="file" name="" id="">
                                                <label for="">Operating License <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="file" name="">
                                                <label for="">CSC Certificate <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <textarea name="" placeholder="About hospital"
                                                        v-model="form.notes"></textarea>
                                                    <label for=""></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.notes" />
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            <div class="checkBox">
                                                <input type="checkbox">
                                                <span>Accept
                                                    <Link>Terms</Link> &
                                                    <Link>Condition</Link>
                                                </span>
                                            </div>
                                            <div class="form-group form-btn-look">
                                                <button :disabled="form.processing">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-donor-user d-none" id="donorCheck">
                                        <div class="grid grid:3 gap10">
                                            <div class="form-group">
                                                <input type="text" placeholder=" " :value="$page.props.auth.user.name"
                                                    readonly>
                                                <label for="">Full name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" placeholder=" " :value="$page.props.auth.user.email"
                                                    readonly>
                                                <label for="">Email <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <input type="number" placeholder=" " v-model="form.pnumber">
                                                    <label for="">Phone Number <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.pnumber" />
                                            </div>
                                        </div>
                                        <div class="grid grid:3 gap10">
                                            <div class="fo">
                                                <div class="form-group">
                                                    <select name="" autofocus v-model="form.gender">
                                                        <option value="" hidden>Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.gender" />
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <select name="" autofocus v-model="form.blood_group">
                                                        <option value="" hidden>Blood Group</option>
                                                        <option v-for="blood in bloods" :key="blood.id"
                                                            :value="blood.id">
                                                            {{ blood.blood_name }}</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.blood_group" />
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <select name="" autofocus v-model="form.hiv">
                                                        <option value="" hidden>Hiv Seen</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.hiv" />
                                            </div>
                                        </div>

                                        <!-- home address  -->

                                        <div class="card-title">
                                            <h4>Address</h4>
                                        </div>

                                        <div class="grid grid:3 gap10">
                                            <div class="form-group">
                                                <select name="" autofocus @change="getLgaDonor(true)" id="stateDonor" v-model="form.donor_state">
                                                    <option value="" hidden >state</option>
                                                    <option v-for="states in state" :key="states.id" :value="states.id">
                                                        {{ states.state }}</option>
                                                </select>
                                                <label for=""> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <select name="" autofocus v-model="form.localGovt">
                                                        <option value="" hidden>Lga</option>
                                                        <option v-for="lgas in lga" :key="lgas.id" :value="lgas.id">{{
                                lgas.lga_name }}</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.lga" />
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <textarea name="" placeholder="Home address"
                                                        v-model="form.home_address"></textarea>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.home_address" />
                                            </div>
                                        </div>


                                        <!-- upload files  -->
                                        <div class="card-title">
                                            <h4>Upload Test Blood Pepar</h4>
                                        </div>

                                        <div class="grid grid:3 gap10 mt-1">
                                            <div class="form-group">
                                                <input type="file" name="" id="">
                                                <label for="">Pepar Front <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="file" name="">
                                                <label for="">Pepar Back <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <textarea name="" placeholder="Reason To Give The Blood"
                                                        v-model="form.reason"></textarea>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.reason" />
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            <div class="checkBox">
                                                <input type="checkbox">
                                                <span>Accept
                                                    <Link>Terms</Link> &
                                                    <Link>Condition</Link>
                                                </span>
                                            </div>
                                            <div class="form-group form-btn-look">
                                                <button :disabled="form.processing">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
                <div v-else-if="$page.props.auth.user.role == '3' && $page.props.auth.user.is_active == '2'">
                    <div class="tabs" id="tabls">
                        <div class="full-chart">
                            <div class="chart-title flex-class">
                                <div class="circle-success">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="circle-text">
                                    <p>Hi, {{ $page.props.auth.user.name }} Congratulation Your Account Is Active</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="appl" v-else>
                    <div class="tabs" id="tabls">
                        <div class="full-chart">
                            <div class="chart-title">
                                <h3>Hi {{ $page.props.auth.user.name }}</h3>
                                <p>Please click the apply button to apply as donar or hospital</p>
                            </div>
                            <form class="form-apply mt-1" @submit.prevent="submit">
                                <div class="form-body form-padding-0">
                                    <div class="form-group">
                                        <select name="" autofocus @change="roles(true)" id="roleCheck"
                                            v-model="form.role">
                                            <option value="" hidden>select role first</option>
                                            <option value="2">Hospital</option>
                                            <option value="3">Donor</option>
                                        </select>
                                        <label for="">Select role first <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="form-hospital d-none" id="hospitalCheck">
                                        <div class="grid grid:3 gap10">
                                            <div class="form-group">
                                                <input type="text" placeholder=" ">
                                                <label for="">Hospital name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" placeholder=" ">
                                                <label for="">Hospital GMS <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" placeholder=" ">
                                                <label for="">Hospital Email <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <!-- <div class="form-hospital">
                                        <div class="grid grid:3 gap10">
                                            <div class="form-group">
                                                <input type="text" placeholder=" ">
                                                <label for=""> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" placeholder=" ">
                                                <label for="">Select role first <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" placeholder=" ">
                                                <label for="">Select role first <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div> --
                                    </div>
                                    <div class="form-donor-user d-none" id="donorCheck">
                                        <div class="grid grid:3 gap10">
                                            <div class="form-group">
                                                <input type="text" placeholder=" " :value="$page.props.auth.user.name"
                                                    readonly>
                                                <label for="">Full name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" placeholder=" " :value="$page.props.auth.user.email"
                                                    readonly>
                                                <label for="">Email <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <input type="number" placeholder=" " v-model="form.pnumber">
                                                    <label for="">Phone Number <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.pnumber" />
                                            </div>
                                        </div>
                                        <div class="grid grid:3 gap10">
                                            <div class="fo">
                                                <div class="form-group">
                                                    <select name="" autofocus v-model="form.gender">
                                                        <option value="" hidden>Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.gender" />
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <select name="" autofocus v-model="form.blood_group">
                                                        <option value="" hidden>Blood Group</option>
                                                        <option v-for="blood in bloods" :key="blood.id"
                                                            :value="blood.id">
                                                            {{ blood.blood_name }}</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.blood_group" />
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <select name="" autofocus v-model="form.hiv">
                                                        <option value="" hidden>Hiv Seen</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.hiv" />
                                            </div>
                                        </div>

                                        !-- home address  --

                                        <div class="card-title">
                                            <h4>Address</h4>
                                        </div>

                                        <div class="grid grid:3 gap10">
                                            <div class="form-group">
                                                <select name="" autofocus @change="getLga(true)" id="state">
                                                    <option value="" hidden>State</option>
                                                    <option v-for="states in state" :key="states.id" :value="states.id">
                                                        {{ states.state }}</option>
                                                </select>
                                                <label for=""> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-al">
                                                <div class="form-group">
                                                    <select name="" autofocus v-model="form.localGovt">
                                                        <option value="" hidden>Lga</option>
                                                        <option v-for="lgas in lga" :key="lgas.id" :value="lgas.id">{{
                                lgas.lga_name }}</option>
                                                    </select>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.lga" />
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <textarea name="" placeholder="Home address"
                                                        v-model="form.home_address"></textarea>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert"
                                                    :message="form.errors.home_address" />
                                            </div>
                                        </div>


                                        !-- upload files  --
                                        <div class="card-title">
                                            <h4>Upload Test Blood Pepar</h4>
                                        </div>

                                        <div class="grid grid:3 gap10 mt-1">
                                            <div class="form-group">
                                                <input type="file" name="" id="">
                                                <label for="">Pepar Front <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="file" name="">
                                                <label for="">Pepar Back <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-alt">
                                                <div class="form-group">
                                                    <textarea name="" placeholder="Reason To Give The Blood"
                                                        v-model="form.reason"></textarea>
                                                    <label for=""> <span class="text-danger">*</span></label>
                                                </div>
                                                <InputError class="password-alert" :message="form.errors.reason" />
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            <div class="checkBox">
                                                <input type="checkbox">
                                                <span>Accept
                                                    <Link>Terms</Link> &
                                                    <Link>Condition</Link>
                                                </span>
                                            </div>
                                            <div class="form-group form-btn-look">
                                                <button :disabled="form.processing">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div> -->
                <!-- end design dashboard content  -->
            </div>
        </section>
    </div>
</template>
