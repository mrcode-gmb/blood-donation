<script setup>
// import Checkbox from '@/Components/Checkbox.vue';
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import PrimaryButton from '@/Components/PrimaryButton.vue';
// import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import '../../../../public/asset/mystyle/form.css';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />
    <!-- <GuestLayout>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
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
                            <h4>Welcome Back! 👋🏻</h4>
                            <p>Please sign-in to your account and start the adventure</p>
                        </div>
                        <div class="form-body">
                            <div class="form-group">
                                <input type="email" placeholder=" " id="email" v-model="form.email" required
                                    autocomplete="username">
                                <label for="">Email</label>
                            </div>
                            <InputError class="password-alert" :message="form.errors.email" />
                            <div class="form-group mb-5">
                                <input type="password" placeholder=" " id="password" v-model="form.password" required
                                    autocomplete="current-password">
                                <label for="">Password</label>
                            </div>
                            <InputError class="password-alert text-danger" :message="form.errors.password" />
                            <div class="form-group mb-5">
                                <Link v-if="canResetPassword" :href="route('password.request')">Forgot your password?
                                </Link>
                            </div>
                            <div class="form-group  mb-5">
                                <button :disabled="form.processing">SIGN IN</button>
                            </div>
                            <div class="form-group text-center mb-5">
                                <p>New on our platform?<Link :href="route('register')"> Create an account</Link></p>
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
