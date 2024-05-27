<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import '../../../../public/asset/mystyle/form.css';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <Head title="Register" />
    <!-- <GuestLayout>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="password-alert" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="password-alert" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="password-alert" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="password-alert" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout> -->

    <section>
        <form @submit.prevent="submit">
            <div class="form">
                <div class="col-2 form-averter">
                    <div class="avater">
                        <img src="../../../../public/asset/photos/3d-male-character-jumping-out-from-smart-phone-screen-and-holding-a-megaphone-free-png.png"
                            alt="">
                    </div>
                </div>
                <div class="col-2 form-data">
                    <div class="form-label">
                        <div class="form-header">
                            <h4>Register starts here 🚀</h4>
                            <p>Make your app management easy and fun!</p>
                        </div>
                        <div class="form-body">
                            <div class="form-group">
                                <input type="text" placeholder=" " id="name" v-model="form.name" required autofocus
                                    autocomplete="name">
                                <label for="">Full Name</label>
                            </div>
                            <InputError class="password-alert" :message="form.errors.name" />
                            <div class="form-group">
                                <input type="email" placeholder=" " id="email" v-model="form.email" required
                                    autocomplete="username">
                                <label for="">Email</label>
                            </div>
                            <InputError class="password-alert" :message="form.errors.email" />
                            <div class="form-group flex-50">
                                <input type="Password" placeholder=" " id="password" v-model="form.password" required
                                    autocomplete="new-password">
                                <label for="">Password</label>
                            </div>
                            <InputError class="password-alert" :message="form.errors.password" />
                            <div class="form-group flex-50">
                                <input type="Password" placeholder=" " v-model="form.password_confirmation" required
                                    autocomplete="new-password">
                                <label for="">Comfirm Password</label>
                            </div>
                            <InputError class="password-alert" :message="form.errors.password_confirmation" />
                            <div class="form-group  mb-5">
                                <button :disabled="form.processing">SIGN UP</button>
                            </div>
                            <div class="form-group text-center mb-5">
                                <p>Already have an account? <Link :href="route('login')"> Create an account</Link></p>
                            </div>
                            <div class="form-group row-line mb-5">
                                <div class="col-3">
                                    <div class="line"></div>
                                </div>
                                <div class="col-3">
                                    Or
                                </div>
                                <div class="col-3">
                                    <div class="line"></div>
                                </div>
                            </div>
                            <div class="form-group row-line gap-20 mb-5">
                                <div class="col-icon">
                                    <i class="fa fa-brands fa-facebook text-facebook"></i>
                                </div>
                                <div class="col-icon">
                                    <i class="fa fa-brands fa-twitter text-twitter"></i>
                                </div>
                                <div class="col-icon">
                                    <i class="fa fa-brands fa-github text-github"></i>
                                </div>
                                <div class="col-icon">
                                    <i class="fa fa-brands fa-google text-google"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</template>
