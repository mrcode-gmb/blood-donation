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
})

const selectname = "select"


// let selectValue = document.getElementById("selectValue");
const openModal = (id) => {
    if (id) {
        let modalSave = document.getElementById("" + id);
        modalSave.style.display = "flex"
        // alert(id);
    }
}

const form = useForm({
    selectVal: '',
})
const submitStatus = function (bool) {
    if (bool) {
        const user_id = document.getElementById("select" + bool).value;

        axios.post("/update-status/" + user_id, form).then(success => {
            if (success.data.status == 200) {
                toast.success("Updated status sucessfully")
                location.reload();
            }
            else {
                console.log(success);
                toast.error("Somthing went wrong")
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
                                <p>Donors records</p>
                            </div>
                        </div>

                        <div class="full-chart">
                            <div class="chart-title flex-class">
                                <div class="circle-success">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="circle-text">
                                    <p>Hi, {{ $page.props.auth.user.name }} Your Verify Donors</p>
                                </div>
                            </div>
                        </div>
                        <div class="table-st">
                            <div class="table-st-head">
                                <h4>Donors Records</h4>
                                <input type="text" placeholder="Search" @keyup="search(true)" id="searchBar">
                            </div>
                            <div class="table-body">
                                <table class="student-data">
                                    <tr class="border">
                                        <th>#</th>
                                        <th>Full name</th>
                                        <th>Email</th>
                                        <th>GSM</th>
                                        <th>Sex</th>
                                        <th>Blood group</th>
                                        <th>Hiv test</th>
                                        <th>State</th>
                                        <th>Lga</th>
                                        <th>Home address</th>
                                        <th>Why app</th>
                                        <th>App status</th>
                                    </tr>
                                    <tr class="searchtab" v-for="donor in donors" :key="donor.id">
                                        <td>{{ donor.id }}</td>
                                        <td>{{ donor.user_name }}</td>
                                        <td>{{ donor.email }}</td>
                                        <td>{{ donor.phone_number }}</td>
                                        <td>{{ donor.gender }}</td>
                                        <td>{{ donor.blood_group }}</td>
                                        <td>{{ donor.hiv_test }}</td>
                                        <td>{{ donor.state }}</td>
                                        <td>{{ donor.lga_names }}</td>
                                        <td>{{ donor.home_address }}</td>
                                        <td>{{ donor.reason }}</td>
                                        <td>
                                            <div v-if="$page.props.auth.user.role == 1">
                                                <div class="status" v-if="donor.is_active == 1"
                                                    @click="openModal(donor.id)">
                                                    Pendding
                                                </div>
                                                <div class="status-approved" v-else-if="donor.is_active == 2"
                                                    @click="openModal(donor.id)">
                                                    Approved
                                                </div>
                                                <div class="status-reject" v-else-if="donor.is_active == 3"
                                                    @click="openModal(donor.id)">
                                                    Decline
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div class="status" v-if="donor.is_active == 1">
                                                    Pendding
                                                </div>
                                                <div class="status-approved" v-else-if="donor.is_active == 2">
                                                    Approved
                                                </div>
                                                <div class="status-reject" v-else-if="donor.is_active == 3">
                                                    Decline
                                                </div>
                                            </div>
                                        </td>

                                        <div class="modal d-none" :id="donor.id">
                                            <div class="modal-dialog">
                                                <div class="modal-head">
                                                    <p>Approve | Reject</p>
                                                </div>
                                                <form class="modal-body"
                                                    @submit.prevent="submitStatus(donor.user_id_none)">
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
                                                <input type="hidden" :value="donor.user_id"
                                                    :id="donor.selectName + donor.user_id_none">
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
