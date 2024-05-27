<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { Bar } from 'vue-chartjs'


const showingNavigationDropdown = ref(false);

// Event listeners for mobile menu toggling
const openMobileMenu = () => {
    document.querySelector(".navbar").style.width = "200px";
    document.querySelector("#openmobilebar").style.display = "none";
    document.querySelector("#closemobilebar").style.display = "flex";
};

const closeMobileMenu = () => {
    document.querySelector(".navbar").style.width = "0px";
    document.querySelector("#openmobilebar").style.display = "flex";
    document.querySelector("#closemobilebar").style.display = "none";
};

window.onload = () => {
    let loader = document.querySelector(".shows"),
        percent = document.querySelector("#percent");

    let loaderStart = 0, loaderEnd = 98, loaderTime = 60;

    let start = setInterval(() => {
        loaderStart++;

        percent.textContent = loaderStart + '+';
        loader.style.width = `${loaderStart}`;
        loader.style.background = `rgb(173, 216, 230)`;


        if (loaderStart == loaderEnd) {
            clearInterval(start);
        }
    }, loaderTime);


    let loader1 = document.querySelector("#shows1"),
        percent1 = document.querySelector("#percent1");

    let loaderStart1 = 0, loaderEnd1 = 36, loaderTime1 = 60;

    let start1 = setInterval(() => {
        loaderStart1++;

        percent1.textContent = loaderStart1 + '+';
        loader1.style.width = `${loaderStart1}`;
        loader1.style.background = `rgb(173, 216, 230)`;


        if (loaderStart1 == loaderEnd1) {
            clearInterval(start1);
        }
    }, loaderTime1);




    let loader2 = document.querySelector("#shows2"),
        percent2 = document.querySelector("#percent2");

    let loaderStart2 = 0, loaderEnd2 = 75, loaderTime2 = 60;

    let start2 = setInterval(() => {
        loaderStart2++;

        percent2.textContent = loaderStart2 + '+';
        loader2.style.width = `${loaderStart2}`;
        loader2.style.background = `rgb(173, 216, 230)`;


        if (loaderStart2 == loaderEnd2) {
            clearInterval(start2);
        }
    }, loaderTime2);


    let loader3 = document.querySelector("#shows3"),
        percent3 = document.querySelector("#percent3");

    let loaderStart3 = 0, loaderEnd3 = 55, loaderTime3 = 60;

    let start3 = setInterval(() => {
        loaderStart3++;

        percent3.textContent = loaderStart3 + '+';
        loader3.style.width = `${loaderStart3}`;
        loader3.style.background = `rgb(173, 216, 230)`;


        if (loaderStart3 == loaderEnd3) {
            clearInterval(start3);
        }
    }, loaderTime3);

}



</script>

<template>
    <div>
        <!-- <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">

                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>


                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">

                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

<template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
</Dropdown>
</div>
</div>


<div class="-me-2 flex items-center sm:hidden">
    <button @click="showingNavigationDropdown = !showingNavigationDropdown"
        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
</div>
</div>


<div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Dashboard
        </ResponsiveNavLink>
    </div>


    <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="px-4">
            <div class="font-medium text-base text-gray-800">
                {{ $page.props.auth.user.name }}
            </div>
            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
        </div>

        <div class="mt-3 space-y-1">
            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                Log Out
            </ResponsiveNavLink>
        </div>
    </div>
</div>
</nav>


<header class="bg-white shadow" v-if="$slots.header">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="header" />
    </div>
</header>


<main>
    <slot />
</main>
</div> -->


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
                <div
                    v-if="$page.props.auth.user.role == '1' || ($page.props.auth.user.role == '4' && $page.props.auth.user.is_active == '2')">
                    <div class="tabs" id="tabls">
                        <div class="container">
                            <div class="col-md-3">
                                <div class="icon-flex">
                                    <div class="left">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="right">
                                        <h4>Donors</h4>
                                        <p class="percent" id="percent">0</p>
                                    </div>
                                </div>
                                <div class="loader">
                                    <div class="shows" id="shows"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="icon-flex">
                                    <div class="left">
                                        <i class="fa fa-hospital-user"></i>
                                    </div>
                                    <div class="right">
                                        <h4>Hospitals</h4>
                                        <p class="percent" id="percent1">0</p>
                                    </div>
                                </div>
                                <div class="loader">
                                    <div class="shows" id="shows1"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="icon-flex">
                                    <div class="left">
                                        <i class="fa fa-money-check-alt"></i>
                                    </div>
                                    <div class="right">
                                        <h4>Visitors</h4>
                                        <p class="percent" id="percent2">0</p>
                                    </div>
                                </div>
                                <div class="loader">
                                    <div class="shows" id="shows2"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="icon-flex">
                                    <div class="left">
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <div class="right">
                                        <h4>Available Blood</h4>
                                        <p class="percent" id="percent3">0</p>
                                    </div>
                                </div>
                                <div class="loader">
                                    <div class="shows" id="shows3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="full-chart">
                            <div class="chart-title">
                                <h3>Top State That Blood Donation</h3>
                                <p>Top state in nigeria than have been problem donation</p>
                            </div>
                            <!-- <canvas id="myChart"></canvas> -->
                            <Bar id="my-chart-id" style="max-height: 400px;" :options="chartOptions"
                                :data="chartData" />
                        </div>
                        <br>
                    </div>
                </div>
                <div v-else-if="$page.props.auth.user.role == '3' && $page.props.auth.user.is_active == '2'">
                    <div class="tabs" id="tabls">
                        <div class="container">
                            <div class="col-md-3">
                                <div class="icon-flex">
                                    <div class="left">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="right">
                                        <h4>Users</h4>
                                        <p class="percent" id="percent">0%</p>
                                    </div>
                                </div>
                                <div class="loader">
                                    <div class="shows" id="shows"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="icon-flex">
                                    <div class="left">
                                        <i class="fa fa-hand-point-right"></i>
                                    </div>
                                    <div class="right">
                                        <h4>Visitors</h4>
                                        <p class="percent" id="percent1">0%</p>
                                    </div>
                                </div>
                                <div class="loader">
                                    <div class="shows" id="shows1"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="icon-flex">
                                    <div class="left">
                                        <i class="fa fa-money-check-alt"></i>
                                    </div>
                                    <div class="right">
                                        <h4>Payment</h4>
                                        <p class="percent" id="percent2">0%</p>
                                    </div>
                                </div>
                                <div class="loader">
                                    <div class="shows" id="shows2"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="icon-flex">
                                    <div class="left">
                                        <i class="fa fa-user-graduate"></i>
                                    </div>
                                    <div class="right">
                                        <h4>Total Number Of Students</h4>
                                        <p class="percent" id="percent3">0%</p>
                                    </div>
                                </div>
                                <div class="loader">
                                    <div class="shows" id="shows3"></div>
                                </div>
                            </div>
                        </div>
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
                        <br>
                    </div>
                </div>
                <div v-else>
                    <div class="tabs" id="tabls">
                        <div class="full-chart">
                            <div class="chart-title">
                                <h3>Hi {{ $page.props.auth.user.name }}</h3>
                                <p>Please click the apply button to apply as donar or hospital</p>
                            </div>
                            <div class="dont-have">
                                <img src="../../../public/asset/photos/3d-male-character-jumping-out-from-smart-phone-screen-and-holding-a-megaphone-free-png.png"
                                    alt="">
                            </div>
                            <div class="create-app">
                                <Link :href="route('applyIndex')">
                                Apply
                                </Link>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <!-- end design dashboard content  -->
            </div>
        </section>
    </div>
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    name: 'BarChart',
    components: { Bar },
    data() {
        return {
            chartData: {
                labels: ['Abia',
                    'Adamawa',
                    'Akwa Ibom',
                    'Anambra',
                    'Bauchi',
                    'Bayelsa',
                    'Benue',
                    'Borno',
                    'Cross River',
                    'Delta',
                    'Ebonyi',
                    'Edo',
                    'Ekiti',
                    'Enugu',
                    'Gombe',
                    'Imo',
                    'Jigawa',
                    'Kaduna',
                    'Kano',
                    'Katsina',
                    'Kebbi',
                    'Kogi',
                    'Kwara',
                    'Lagos',
                    'Nasarawa',
                    'Niger',
                    'Ogun',
                    'Ondo',
                    'Osun',
                    'Oyo',
                    'Plateau',
                    'Rivers',
                    'Sokoto',
                    'Taraba',
                    'Yobe',
                    'Zamfara',
                    'Federal Capital Territory'],
                datasets: [{ data: [12, 19, 3, 5, 10, 8, 4, 19, 12, 19, 3, 5, 10, 8, 4, 19,12, 19, 3, 5, 10, 8, 4, 19,12, 19, 3, 5, 10, 8, 4, 19,12, 19, 3, 5, 10, 8, 4] }]
            },
            chartOptions: {
                responsive: true
            }
        }
    }
}
</script>
