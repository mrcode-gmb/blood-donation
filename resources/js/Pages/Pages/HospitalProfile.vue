<script setup>
import HeadNav from "../../Components/HeadNav.vue";
import { Head } from "@inertiajs/vue3";
import "../../../../public/asset/mystyle/form.css";
import { defineProps } from "vue";
import axios from "axios";
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { useToast } from "vue-toastification";
import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";
import DeleteUserForm from "../Profile/Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "../Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "../Profile/Partials/UpdateProfileInformationForm.vue";

const toast = useToast();

defineProps({
  hospotals: Array,
  donors: Array,
  bloodGroup: Array,
  bloodInventories: Array | Object,
});

const selectname = "select";

let selectValue = document.getElementById("selectValue");
const openModal = (id) => {
  if (id) {
    let modalSave = document.getElementById("editModal");
    modalSave.style.display = "flex";
  }
};

const form = useForm({
  selectVal: "",
});

const submitStatus = function (bool) {
  if (bool) {
    const user_id = document.getElementById("select").value;

    axios
      .post("/update-status/hospital/" + user_id, form)
      .then((success) => {
        if (success.data.status == 200) {
          toast.success("Updated status sucessfully");
          location.reload();
        } else {
          toast.error("Somthing went wrong");
        }
      })
      .catch((error) => {
        if (error.response && error.response.status === 422) {
          toast.error("Please select status");
        }
      });
  }
};

// search
const search = (choose) => {
  if (choose) {
    let input = document.getElementById("searchBar").value;
    input = input.toLowerCase();
    let x = document.getElementsByClassName("searchtab");

    for (let i = 0; i < x.length; i++) {
      if (!x[i].innerHTML.toLowerCase().includes(input)) {
        x[i].style.display = "none";
      } else {
        x[i].style.display = "";
      }
    }
  }
};

const searchBlood = (choose) => {
  if (choose) {
    let input = document.getElementById("searchBarBlood").value;
    input = input.toLowerCase();
    let x = document.getElementsByClassName("rowBlood");

    for (let i = 0; i < x.length; i++) {
      if (!x[i].innerHTML.toLowerCase().includes(input)) {
        x[i].style.display = "none";
      } else {
        x[i].style.display = "";
      }
    }
  }
};

const openBloodBank = (start) => {
  if (start) {
    document.getElementById("bloodBanks").style.display = "block";
    document.getElementById("donors").style.display = "none";
    document.getElementById("profile").style.display = "none";
  }
};

const closeBloodBank = (start) => {
  if (start) {
    document.getElementById("bloodBanks").style.display = "none";
    document.getElementById("profile").style.display = "none";
    document.getElementById("donors").style.display = "block";
  }
};
const profile = (start) => {
  if (start) {
    document.getElementById("bloodBanks").style.display = "none";
    document.getElementById("donors").style.display = "none";
    document.getElementById("profile").style.display = "block";
  }
};
const addBloodBankModel = () => {
  document.getElementById("addBloodBank").style.display = "flex";
};

const bloodForm = useForm({
  blood_group: "",
  blood_component: "",
  quantity: "",
  collection_date: "",
  expiry_date: "",
});

const submitBloodBank = (id) => {
  axios
    .post("/blood-bank/create/" + id, bloodForm)
    .then((success) => {
      if (success.data.status == 200) {
        toast.success("Updated status sucessfully");
        location.reload();
      } else {
        console.log(success);
        toast.error("Somthing went wrong");
      }
    })
    .catch((error) => {
      if (error.response && error.response.status === 422) {
        toast.error("Please fieald the form");
      }
    });
};

window.onclick = (e) => {
  let bloodBanks = document.getElementById("addBloodBank");
  let modalSave = document.getElementById("editModal");
  if (e.target === bloodBanks) {
    bloodBanks.style.display = "none";
  } else if (e.target === modalSave) {
    modalSave.style.display = "none";
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
        <div class="tabs" id="tabls" style="padding-bottom: 2rem">
          <div class="str">
            <div class="str-home">
              <i class="fa fa-home"></i>
              <div class="db">
                <h4>Dashboard / &nbsp;</h4>
                <p>Hospital profile</p>
              </div>
            </div>
            <div class="full-chart">
              <div class="chart-title flex-class">
                <div class="circle-success">
                  <i class="fa fa-check-circle"></i>
                </div>
                <div class="circle-text">
                  <p>Hi, {{ hospotals[0].hostpital_name }}, Welcome to your profile</p>
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
                      <h4>{{ hospotals[0].hostpital_name }}</h4>
                      <span>{{ hospotals[0].moto_name }}</span>
                    </div>
                  </div>
                  <div class="profile-menu">
                    <div v-if="$page.props.auth.user.role == '4'">
                      <Link href="/hostpitals/records"> Orther hospital </Link>
                    </div>
                    <div v-else-if="$page.props.auth.user.role == '1'">
                      <div
                        class="pyx status"
                        v-if="hospotals[0].is_active == 1"
                        @click="openModal(true)"
                      >
                        Pendding
                      </div>
                      <div
                        class="pyx status-approved"
                        v-else-if="hospotals[0].is_active == 2"
                        @click="openModal(true)"
                      >
                        Approved
                      </div>
                      <div
                        class="pyx status-reject"
                        v-else-if="hospotals[0].is_active == 3"
                        @click="openModal(true)"
                      >
                        Decline
                      </div>

                      <div class="modal d-none" id="editModal">
                        <div class="modal-dialog">
                          <div class="modal-head">
                            <p>Approve | Reject</p>
                          </div>
                          <form
                            class="modal-body"
                            @submit.prevent="submitStatus(hospotals[0].user_id_none)"
                          >
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
                          <input
                            type="hidden"
                            :value="hospotals[0].user_id_none"
                            id="select"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="profile-tabs-new">
                  <div class="profile-tab">
                    <li>
                      <span href="#!" @click="closeBloodBank(true)">Own donors</span>
                    </li>
                    <li>
                      <span href="#!" @click="openBloodBank(true)">My Blood banks</span>
                    </li>
                    <li>
                      <span
                        href="#!"
                        @click="profile(true)"
                        v-if="$page.props.auth.user.id == hospotals[0].user_id_none"
                        >Edit profile</span
                      >
                    </li>
                  </div>
                </div>
              </div>
            </div>

            <div class="table-st" id="donors">
              <div class="table-st-head">
                <h4>Donors Records</h4>
                <input
                  type="text"
                  placeholder="Search"
                  @keyup="search(true)"
                  id="searchBar"
                />
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
                    <th>Action</th>
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
                      <div class="status" v-if="donor.is_active == 1">Pendding</div>
                      <div class="status-approved" v-else-if="donor.is_active == 2">
                        Approved
                      </div>
                      <div class="status-reject" v-else-if="donor.is_active == 3">
                        Decline
                      </div>
                    </td>
                    <td>
                      <a href="">
                        <i class="fa fa-edit edit"></i>
                      </a>
                      <a href="">
                        <i class="fa fa-user view"></i>
                      </a>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="table-st d-none" id="bloodBanks">
              <div class="table-st-head">
                <h4>Blood Bank</h4>
                <div class="input-seach">
                  <input
                    type="text"
                    placeholder="Search"
                    @keyup="searchBlood(true)"
                    id="searchBarBlood"
                  />
                  <div class="button" v-if="$page.props.auth.user.id == hospotals[0].user_id_none" @click="addBloodBankModel">Add blood</div>
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
                    <th>App status</th>
                    <th>Action</th>
                  </tr>
                  <tr
                    class="searchtab rowBlood"
                    v-for="bloodInventory in bloodInventories"
                    :key="bloodInventory.id"
                  >
                    <td>{{ 1 }}</td>
                    <td>{{ bloodInventory.hospital_name }}</td>
                    <td>{{ bloodInventory.hospital_city }}</td>
                    <td>{{ bloodInventory.hospital_lga }}</td>
                    <td>{{ "BG/" + bloodInventory.id }}</td>
                    <td>{{ bloodInventory.blood_group }}</td>
                    <td>{{ bloodInventory.blood_component }}</td>
                    <td>{{ bloodInventory.quantity }}</td>
                    <td>{{ bloodInventory.collection_date }}</td>
                    <td>{{ bloodInventory.expiry_date }}</td>
                    <td>
                      <div class="status-approved" v-if="bloodInventory.is_active == 1">
                        Availabe
                      </div>
                    </td>
                    <td>
                      <a href="" v-if="$page.props.auth.user.role == 4">
                        <i class="fa fa-plus-circle view"></i>
                      </a>
                      <a
                        href=""
                        v-if="$page.props.auth.user.id == bloodInventory.user_id"
                      >
                        <i class="fa fa-trash edit"></i>
                      </a>
                    </td>
                  </tr>
                </table>

                <div class="modal d-none" id="addBloodBank">
                  <div class="modal-blood">
                    <div class="modal-head">
                      <p>Add Blood Banks</p>
                    </div>
                    <form
                      class="modal-body"
                      @submit.prevent="submitBloodBank(hospotals[0].hospital_id)"
                    >
                      <div class="form-body">
                        <div class="grid">
                          <div class="form-group">
                            <select v-model="bloodForm.blood_group">
                              <option :value="''" hidden>Blood group</option>
                              <option
                                v-for="bloodGroups in bloodGroup"
                                :key="bloodGroups.id"
                                :value="bloodGroups.id"
                              >
                                {{ bloodGroups.blood_name }}
                              </option>
                            </select>
                          </div>
                          <div class="form-group">
                            <select v-model="bloodForm.blood_component">
                              <option :value="''" hidden>Blood component</option>
                              <option value="plasma">plasma</option>
                              <option value="red blood cells">red blood cells</option>
                              <option value="white blood cells">white blood cells</option>
                              <option value="platelets">platelets</option>
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
                            <input
                              type="date"
                              placeholder=" "
                              v-model="bloodForm.collection_date"
                            />
                            <label for="">Collection date</label>
                          </div>
                          <div class="form-group">
                            <input
                              type="date"
                              placeholder=" "
                              v-model="bloodForm.expiry_date"
                            />
                            <label for="">Expiry date</label>
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

            <div class="table-st d-none" id="profile">
              <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdateProfileInformationForm
                  :must-verify-email="mustVerifyEmail"
                  :status="status"
                  class="max-w-xl"
                />
              </div>

              <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdatePasswordForm class="max-w-xl" />
              </div>

              <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <DeleteUserForm class="max-w-xl" />
              </div>
            </div>
          </div>
        </div>
        <!-- end design dashboard content  -->
      </div>
    </section>
  </div>
</template>
