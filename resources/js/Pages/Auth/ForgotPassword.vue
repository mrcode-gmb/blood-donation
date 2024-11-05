<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>
  <div>
    <Head title="Forgot Password" />
    <section>
      <form @submit.prevent="submit">
        <div class="form">
          <div class="col-2 form-averter">
            <div class="avater">
              <img
                src="../../../../public/asset/photos/3d-male-character-jumping-out-from-smart-phone-screen-and-holding-a-megaphone-free-png.png"
                alt=""
              />
            </div>
          </div>
          <div class="col-2 form-data">
            <div class="form-label">
              <div class="form-header">
                <h4>Forgot your password?</h4>
                <p>
                  No problem. Just let us know your email address and we will email you a
                  password reset link that will allow you to choose a new one.
                </p>
              </div>
              <div class="form-body">
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                  {{ status }}
                </div>
                <div class="form-group">
                  <input
                    type="email"
                    placeholder=" "
                    id="email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                  />
                  <label for="">Email</label>
                </div>
                <InputError class="password-alert" :message="form.errors.email" />
                <div class="form-group mb-5">
                  <button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    Email Password Reset Link
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
  </div>
</template>
