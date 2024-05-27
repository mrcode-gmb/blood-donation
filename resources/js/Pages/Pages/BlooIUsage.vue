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
    bloodInventory: Array,
})



const openModal = (id) => {
    if (id) {
        let modalSave = document.getElementById("" + id);
        modalSave.style.display = "flex"
        // alert(id);
    }
}

const form = useForm({
    comment: '',
})
const submitStatus = function (hospital_id, id) {
    if (hospital_id) {
        axios.post("/accepted-blood/" + hospital_id + "/" + id, form).then(success => {
            if (success.data.status == 200) {
                toast.success("Your have been burking this blood")
                location.reload();
            }
            else {
                console.log(success);
                toast.error("Somthing went wrong")
            }
        }).catch(error => {
            if (error.response && error.response.status === 422) {
                toast.error("Please write the comment why need blood")
            }
        });
    }
};

// search
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
                                <p>Blood Usage | Accepted</p>
                            </div>
                        </div>

                        <div class="full-chart">
                            <div class="chart-title flex-class">
                                <div class="circle-success">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="circle-text">
                                    <p>Your Blood Usage | Accepted a blood from other hospitals </p>
                                </div>
                            </div>
                        </div>
                        <div class="table-st" id="bloodBanks">
                            <div class="table-st-head">
                                <h4>Blood Usage | Accepted</h4>
                                <div class="input-seach">
                                    <input type="text" placeholder="Search" @keyup="searchBlood(true)"
                                        id="searchBarBlood">
                                </div>
                            </div>
                            <div class="table-body">
                                <table class="student-data">
                                    <tr class="border">
                                        <th>#</th>
                                        <th>Hospital name</th>
                                        <th>Hospital city</th>
                                        <th>Hospital lga</th>
                                        <th>Blood number</th>
                                        <th>Blood group</th>
                                        <th>Blood component</th>
                                        <th>Quantity</th>
                                        <th>Collection date</th>
                                        <th>Expiry date</th>
                                        <th>Accept date</th>
                                        <th>Blood status</th>
                                        <th>Accept</th>
                                    </tr>
                                    <tr class="searchtab rowBlood" v-for="bloodInventories in bloodInventory"
                                        :key="bloodInventories.id">
                                        <td>{{ 1 }}</td>
                                        <td>{{ bloodInventories.hospital_name }}</td>
                                        <td>{{ bloodInventories.hospital_city }}</td>
                                        <td>{{ bloodInventories.hospital_lga }}</td>
                                        <td>{{ "BG/" + bloodInventories.id }}</td>
                                        <td>{{ bloodInventories.blood_group }}</td>
                                        <td>{{ bloodInventories.blood_component }}</td>
                                        <td>{{ bloodInventories.quantity }}</td>
                                        <td>{{ bloodInventories.collection_date }}</td>
                                        <td>{{ bloodInventories.expiry_date }}</td>
                                        <td>{{ bloodInventories.accept_date }}</td>
                                        <td>
                                            <div class="status-approved" v-if="bloodInventories.is_active == 2">
                                                Usage
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="#!" @click="openModal(bloodInventories.id)">
                                                <i class="fa fa-plus-circle view"></i>
                                            </a>
                                        </td>


                                        <div class="modal d-none" :id="bloodInventories.id">
                                            <div class="modal-dialog">
                                                <div class="modal-head">
                                                    <p>Burking Blood </p>
                                                </div>
                                                <form class="modal-body"
                                                    @submit.prevent="submitStatus(bloodInventories.hospital_id, bloodInventories.blood_usage_id)">
                                                    <div class="form-body">
                                                        Are you sure you have been collect the blood
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button>Save</button>
                                                        <button class="delete" type="button">Close</button>
                                                    </div>
                                                </form>
                                                <!-- <input type="hidden" :value="donor.user_id" :id="donor.selectName+donor.user_id_none"> -->
                                            </div>
                                        </div>
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
