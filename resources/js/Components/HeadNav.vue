<script setup>
import { Link } from '@inertiajs/vue3';
import '../../../public/asset/mystyle/style.css';

// Functionality for sidebar toggling
const toggleSidebar = (isOpen) => {
    const navbar = document.querySelector(".navbar");
    const header = document.querySelector("#header");
    const mainbody = document.querySelector(".main-body");
    const spanElements = document.getElementsByTagName("span");

    if (isOpen) {
        navbar.style.width = "240px";
        header.style.width = "82.5%";
        mainbody.style.width = "82.5%";
        document.querySelector("#opensidebar").style.display = "none";
        document.querySelector("#closesidebar").style.display = "flex";
        for (let span of spanElements) {
            span.style.display = "";
        }
    } else {
        navbar.style.width = "70px";
        header.style.width = "96%";
        mainbody.style.width = "96%";
        document.querySelector("#opensidebar").style.display = "flex";
        document.querySelector("#closesidebar").style.display = "none";
        for (let span of spanElements) {
            span.style.display = "none";
        }
    }
};


</script>

<template>
    <div>
        <section id="sidebarandheader">
            <div class="main">
                <div class="header-sidebar">
                    <header id="header">
                        <div class="header-flex">
                            <div class="header-left">
                                <h4>Blood Donation</h4>
                            </div>
                            <div class="header-right">
                                <h4>Blood Donation</h4>
                                <p>blooddonation.com.ng</p>
                            </div>
                        </div>
                    </header>

                    <!-- <div class="header-mobile">
                        <div class="header-with">
                            <div class="mobile-menu" id="openmobilebar" @click="openMobileMenu">
                                <i class="fa fa-angle-right"></i>
                            </div>
                            <div class="mobile-menu" id="closemobilebar" @click="closeMobileMenu">
                                <i class="fa fa-angle-left"></i>
                            </div>
                            <p>Online Learning</p>
                            <div class="mobile-menu">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div> -->

                    <div class="navbar">
                        <div class="nav-right">
                            <div class="nav-top">
                                <div class="nav-brand">
                                    <img src="../../../public/asset/photos/63a5ab75a44bfd09356d456f0fcccced-removebg-preview.png"
                                        alt="Logo">
                                </div>
                                <div class="nav-open" id="closesidebar" @click="toggleSidebar(false)">
                                    <i class="fa fa-angle-left"></i>
                                </div>
                                <div class="nav-open" id="opensidebar" @click="toggleSidebar(true)">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-nav">
                            <li>
                                <a href="../dashboard/">
                                    <div class="link-hover">
                                        <i class="fa fa-home"></i>
                                        <span>Dashboard</span>
                                    </div>
                                </a>
                            </li>
                            <div v-if="$page.props.auth.user.role == '1' || ($page.props.auth.user.role == '4' && $page.props.auth.user.is_active == '2')">
                                <li>
                                    <a href="/hostpitals/records">
                                        <div class="link-hover">
                                            <i class="fa fa-hospital-symbol"></i>
                                            <span>Hospitals</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <Link href="/donors">
                                        <div class="link-hover">
                                            <i class="fa fa-users"></i>
                                            <span>Donor Users</span>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/donor-givenb-lood">
                                        <div class="link-hover">
                                            <i class="fa fa-users"></i>
                                            <span>Donor Give Blood</span>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('bloodInvertory.index')">
                                        <div class="link-hover">
                                            <i class="fa fa-heart-broken"></i>
                                            <span>Blood bank</span>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/blood-bank/usage">
                                        <div class="link-hover">
                                            <i class="fa fa-history"></i>
                                            <span>Blood usage</span>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/blood-bank/expired">
                                        <div class="link-hover">
                                            <i class="fa fa-history"></i>
                                            <span>Blood expired</span>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('hospitals.profile')">
                                        <div class="link-hover">
                                            <i class="fa fa-user"></i>
                                            <span>My profile</span>
                                        </div>
                                    </Link>
                                </li>
                            </div>

                            <div v-else-if="$page.props.auth.user.role == '3' && $page.props.auth.user.is_active == '2'">
                                <li>
                                    <Link href="/donor/profile">
                                        <div class="link-hover">
                                            <i class="fa fa-user-circle"></i>
                                            <span>My profile</span>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <a href="/apply">
                                        <div class="link-hover">
                                            <i class="fa fa-user-circle"></i>
                                            <span>My Application</span>
                                        </div>
                                    </a>
                                </li>
                            </div>
                            <div v-else-if="$page.props.auth.user.role == '2'">
                                <li>
                                    <a href="myacount.html">
                                        <div class="link-hover">
                                            <i class="fa fa-user-circle"></i>
                                            <span>My profile</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/apply">
                                        <div class="link-hover">
                                            <i class="fa fa-user-circle"></i>
                                            <span>Apply</span>
                                        </div>
                                    </a>
                                </li>
                            </div>
                            <li>
                                <Link :href="route('logout')" method="post">
                                <div class="link-hover">
                                    <i class="fa fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </div>
                                </Link>
                            </li>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</template>
