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
    hospotals: Array,
})

const selectname = "select"


// let selectValue = document.getElementById("selectValue");
const openModal = (id) => {
    if (id) {
        // let modalSave = document.getElementById("" + id);
        // modalSave.style.display = "flex"
        // alert(id);
    }
}

// const form = useForm({
//     selectVal: '',
// })
// const submitStatus = function (bool) {
//     if (bool) {
//         const user_id = document.getElementById("select"+bool).value;

//         axios.post("/update-status/" + user_id, form).then(success => {
//             if(success.data.status == 200){
//                 toast.success("Updated status sucessfully")
//                 location.reload();
//             }
//             else{
//                 console.log(success);
//                 toast.error("Somthing went wrong")
//             }
//         });
//     }
// };

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

</script>

<template>
    <div>

        <Head title="Apply" />
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
                                <p>Hospital records</p>
                            </div>
                        </div>

                        <div class="full-chart">
                            <div class="chart-title flex-class">
                                <div class="circle-success">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="circle-text">
                                    <p>Your can find other hospital to burking a blood</p>
                                </div>
                            </div>
                        </div>
                        <div class="table-st">
                            <div class="table-st-head">
                                <h4>Hospital Records</h4>
                                <input type="text" placeholder="Search" @keyup="search(true)" id="searchBar">
                            </div>
                            <div class="table-body">
                                <table class="student-data">
                                    <tr class="border">
                                        <th>#</th>
                                        <th>Applyer name</th>
                                        <th>Applyer email</th>
                                        <th>Hospital name</th>
                                        <th>Hospital moto</th>
                                        <th>Hospital city</th>
                                        <th>Hospital lga</th>
                                        <th>Hospital Location</th>
                                        <th>Hospital email</th>
                                        <th>Hospital GSM</th>
                                        <th>App status</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr class="searchtab" v-for="(hospotal, index) in hospotals" :key="hospotal.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ hospotal.user_name }}</td>
                                        <td>{{ hospotal.email }}</td>
                                        <td>{{ hospotal.hostpital_name }}</td>
                                        <td>{{ hospotal.moto_name }}</td>
                                        <td>{{ hospotal.state }}</td>
                                        <td>{{ hospotal.lga_names }}</td>
                                        <td>{{ hospotal.hospital_address }}</td>
                                        <td>{{ hospotal.hospital_email }}</td>
                                        <td>{{ hospotal.hospital_phone }}</td>
                                        <td>
                                            <div class="status" v-if="hospotal.is_active == 1"
                                                @click="openModal(hospotal.id)">
                                                Pendding
                                            </div>
                                            <div class="status-approved" v-else-if="hospotal.is_active == 2"
                                                @click="openModal(hospotal.id)">
                                                Approved
                                            </div>
                                            <div class="status-reject" v-else-if="hospotal.is_active == 3"
                                                @click="openModal(hospotal.id)">
                                                Decline
                                            </div>
                                        </td>
                                        <td>
                                            <Link :href="route('hospitals.show', hospotal.hospital_id)">
                                                <i class="fa fa-eye view"></i>
                                            </Link>
                                        </td>

                                        <!-- <div class="modal d-none" :id="donor.id">
                                            <div class="modal-dialog">
                                                <div class="modal-head">
                                                    <p>Approve | Reject</p>
                                                    {{ donor.blood_group }}
                                                </div>
                                                <form class="modal-body" @submit.prevent="submitStatus(donor.user_id_none)">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <select id="selectValue" v-model="form.selectVal">
                                                                <option :value="''" hidden>Change status</option>
                                                                <option :value="1">Pendding</option>
                                                                <option :value="2">Approved</option>
                                                                <option :value="3">Decline</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button>Save</button>
                                                        <button class="delete" type="button">Close</button>
                                                    </div>
                                                </form>
                                                <input type="hidden" :value="donor.user_id" :id="donor.selectName+donor.user_id_none">
                                            </div>
                                        </div> -->
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end design dashboard content  -->
            </div>
        </section>
    </div>
</template>
