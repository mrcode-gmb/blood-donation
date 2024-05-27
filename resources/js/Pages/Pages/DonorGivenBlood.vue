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


defineProps({
    donors: Array,
    bloodGroup: Array,
    users: Array | Object,
    giveBlood: Array | Object,
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
const searchBlood = (choose) => {
    if (choose) {
        let input = document.getElementById('searchBarBlood').value
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
    email: '',
    quantity: '',
    collection_date: '',
});

const submitBloodBank = (id) => {
    axios.post("/donor-given-bloode/create", bloodForm).then(success => {
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
                                <p>Verify donor given blood</p>
                            </div>
                        </div>
                        <div class="full-chart">
                            <div class="chart-title flex-class">
                                <div class="circle-success">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="circle-text">
                                    <p>Verify donor given blood</p>
                                </div>
                            </div>
                        </div>

                        <div class="table-st" id="donors">
                            <div class="table-st-head">
                                <h4>Verify donor given blood</h4>
                                <div class="input-seach">
                                    <input type="text" placeholder="Search" @keyup="searchBlood(true)"
                                        id="searchBarBlood">
                                    <div class="button" @click="addBloodBankModel" v-if="$page.props.auth.user.role == 4">
                                        Verify donor given blood
                                    </div>
                                </div>
                            </div>
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
                                    <tr class="searchtab" v-for="(giveBloods, index) in giveBlood" :key="giveBloods.id">
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
                                <div class="modal d-none" id="addBloodBank">
                                    <div class="modal-blood">
                                        <div class="modal-head">
                                            <p>Add Blood Banks</p>
                                        </div>
                                        <form class="modal-body"
                                            @submit.prevent="submitBloodBank(true)">
                                            <div class="form-body ">
                                                <div class="grid">
                                                    <div class="form-group">
                                                        <select v-model="bloodForm.blood_group">
                                                            <option :value="''" hidden>Blood group</option>
                                                            <option v-for="bloodGroups in bloodGroup"
                                                                :key="bloodGroups.id" :value="bloodGroups.id">{{
                                        bloodGroups.blood_name }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select v-model="bloodForm.email">
                                                            <option :value="''" hidden>User email</option>
                                                            <option v-for="user in users"
                                                                :key="user.id" :value="user.id">{{
                                        user.email }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select v-model="bloodForm.quantity">
                                                            <option :value="''" hidden>Quantity</option>
                                                            <option value="1 liters">1 liters</option>
                                                            <option value="2 liters">2 liters</option>
                                                            <option value="3 liters">3 liters</option>
                                                            <option value="4 liters">4 liters</option>
                                                            <option value="5 liters">5 liters</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="date" placeholder=" "
                                                            v-model="bloodForm.collection_date">
                                                        <label for="">Collection date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button :disabled="bloodForm.processing">Save</button>
                                                <button class="delete" type="button">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end design dashboard content  -->
            </div>
        </section>
    </div>
</template>
