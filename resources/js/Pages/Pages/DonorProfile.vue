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

const toast = useToast();
const lga = ref();


defineProps({
    donorRecord: Array,
    state: Array,
    giveBlood: Array | Object
})

const selectname = "select"


let selectValue = document.getElementById("selectValue");
const openModal = (id) => {
    if (id) {
        let modalSave = document.getElementById("editModal");
        modalSave.style.display = "flex"
    }
}

const form = useForm({
    selectVal: '',
})


const submitStatus = function (bool) {
    if (bool) {
        const user_id = document.getElementById("select").value;

        axios.post("/update-status/hospital/" + user_id, form).then(success => {
            if (success.data.status == 200) {
                toast.success("Updated status sucessfully")
                location.reload();
            }
            else {
                toast.error("Somthing went wrong")
            }
        }).catch(error => {
            if (error.response && error.response.status === 422) {
                toast.error("Please select status")
            }
        });
    }
};

// search
const search = (choose) => {
    if (choose) {
        let input = document.getElementById('searchBar').value
        input = input.toLowerCase();
        let x = document.getElementsByClassName('searchtab');

        for (let i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display = "none";
            }
            else {
                x[i].style.display = "";
            }
        }
    }
};


const searchBlood = (choose) => {
    if (choose) {
        let input = document.getElementById('searchBarBlood').value
        input = input.toLowerCase();
        let x = document.getElementsByClassName('rowBlood');

        for (let i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display = "none";
            }
            else {
                x[i].style.display = "";
            }
        }
    }
};


const openBloodBank = (start) => {
    if (start) {
        document.getElementById("bloodBanks").style.display = "block";
        document.getElementById("donors").style.display = "none";
    }
};

const closeBloodBank = (start) => {
    if (start) {
        document.getElementById("bloodBanks").style.display = "none";
        document.getElementById("donors").style.display = "block";
    }
};

const addBloodBankModel = () => {
    document.getElementById("addBloodBank").style.display = "flex";
}

const bloodForm = useForm({
    blood_group: '',
    blood_component: '',
    quantity: '',
    collection_date: '',
    expiry_date: '',
});

const submitBloodBank = (id) => {
    axios.post("/blood-bank/create/" + id, bloodForm).then(success => {
        if (success.data.status == 200) {
            toast.success("Updated status sucessfully")
            location.reload();
        }
        else {
            console.log(success)
            toast.error("Somthing went wrong")
        }
    }).catch(error => {
        if (error.response && error.response.status === 422) {
            toast.error("Please fieald the form")
        }
    });
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

        <Head title="Hospital profile" />
        <!-- Link side var and header here  -->
        <HeadNav />

        <section id="mainbody">
            <div class="main-body">
                <!-- start design dashboard content  -->
                <div class="tabs" id="tabls">
                    <div class="str">
                        <div class="str-home">
                            <i class="fa fa-home"></i>
                            <div class="db">
                                <h4>Dashboard / &nbsp;</h4>
                                <p>Donor profile</p>
                            </div>
                        </div>
                        <div class="full-chart">
                            <div class="chart-title flex-class">
                                <div class="circle-success">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="circle-text">
                                    <p>Hi, {{ $page.props.auth.user.name }}, Welcome to your profile</p>
                                </div>
                            </div>
                        </div>
                        <div class="full-chart">
                            <div class="chart-title pb-0-px">
                                <div class="profile-card">
                                    <div class="profile flex-class">
                                        <div class="profile-success">
                                            <h4>F</h4>
                                        </div>
                                        <div class="profile-caption">
                                            <h4>{{ $page.props.auth.user.name }}</h4>
                                            <span>{{ donorRecord[0].state_name }} | {{ donorRecord[0].lga_name }} | {{
                                        donorRecord[0].blood_group }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-menu">
                                        <div>
                                            <Link href="/dashboard">
                                            My Dashboard
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-tabs-new">
                                    <div class="profile-tab">
                                        <li>
                                            <span href="#!" @click="closeBloodBank(true)">Blood History</span>
                                        </li>
                                        <li>
                                            <span href="#!" @click="openBloodBank(true)">Edit profile</span>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-st" id="donors">
                            <div class="table-st-head">
                                <h4>Blood History</h4>
                                <input type="text" placeholder="Search" @keyup="search(true)" id="searchBar">
                            </div>
                            <div class="table-body">
                                <div class="table-body">
                                    <table class="student-data">
                                        <tr class="border">
                                            <th>#</th>
                                            <th>Hospital name</th>
                                            <th>Hospital city</th>
                                            <th>Donor name</th>
                                            <th>Donor email</th>
                                            <th>Blood group</th>
                                            <th>Blood quantity</th>
                                            <th>Collection date</th>
                                            <th>Give blood status</th>
                                        </tr>
                                        <tr class="searchtab" v-for="(giveBloods, index) in giveBlood"
                                            :key="giveBloods.id">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ giveBloods.hospital_name }}</td>
                                            <td>{{ giveBloods.hospital_city }}</td>
                                            <td>{{ giveBloods.donor_name }}</td>
                                            <td>{{ giveBloods.donor_email }}</td>
                                            <td>{{ giveBloods.blood_group }}</td>
                                            <td>{{ giveBloods.quantity }}</td>
                                            <td>{{ giveBloods.collection_date }}</td>
                                            <td>
                                                <div class="status-approved">
                                                    Successfull
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-st d-none" id="bloodBanks">
                            <div class="table-st-head">
                                <h4>Edit profile</h4>
                            </div>

                            <form action="">
                                <div class="form-body">
                                    <div class="grid grid:3 gap:20">
                                        <div class="form-lt">
                                            <div class="form-group">
                                                <input type="text" placeholder=" " :value="$page.props.auth.user.name">
                                                <label for="">Full name</label>
                                            </div>
                                        </div>
                                        <div class="form-lt">
                                            <div class="form-group">
                                                <input type="text" placeholder=" " :value="donorRecord[0].phone_number">
                                                <label for="">Phone number</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select name="" autofocus @change="getLgaDonor(true)" id="stateDonor"
                                                v-model="form.donor_state">
                                                <option value="" hidden>state</option>
                                                <option v-for="states in state" :key="states.id" :value="states.id">
                                                    {{ states.state }}</option>
                                            </select>
                                            <label for=""> state</label>
                                        </div>
                                    </div>
                                    <div class="grid grid:3 gap:20">
                                        <div class="form-al">
                                            <div class="form-group">
                                                <select name="" autofocus v-model="form.localGovt">
                                                    <option value="" hidden>Lga</option>
                                                    <option v-for="lgas in lga" :key="lgas.id" :value="lgas.id">{{
                                        lgas.lga_name }}</option>
                                                </select>
                                                <label for=""> Lga</label>
                                            </div>
                                            <InputError class="password-alert" :message="form.errors.lga" />
                                        </div>
                                        <div class="form-lt">
                                            <div class="form-group">
                                                <input type="text" placeholder=" " :value="donorRecord[0].home_address">
                                                <label for="">Home address</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-lt">
                                        <div class="form-group form-btn-look">
                                            <button :disabled="form.processing">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-st-head">
                                <h4>Change password</h4>
                            </div>

                            <form action="">
                                <div class="form-body">
                                    <div class="grid grid:3 gap:20">
                                        <div class="form-lt">
                                            <div class="form-group">
                                                <input type="password" placeholder=" ">
                                                <label for="">Old password</label>
                                            </div>
                                        </div>
                                        <div class="form-lt">
                                            <div class="form-group">
                                                <input type="password" placeholder=" ">
                                                <label for="">New password</label>
                                            </div>
                                        </div>
                                        <div class="form-lt">
                                            <div class="form-group">
                                                <input type="password" placeholder=" ">
                                                <label for="">Comfirm password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-lt">
                                        <div class="form-group form-btn-look">
                                            <button :disabled="form.processing">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end design dashboard content  -->
            </div>
        </section>
    </div>
</template>
