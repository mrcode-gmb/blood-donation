<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <div>
    <Head title="Reset Password" />
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
                <h4>Create New Password?</h4>
              </div>
              <div class="form-body">
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                  {{ status }}
                </div>
                <div>
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
                </div>
                <div>
                  <div class="form-group">
                    <input
                      type="password"
                      placeholder=" "
                      id="password"
                      v-model="form.password"
                      required
                      autocomplete="password"
                    />
                    <label for="">Password</label>
                  </div>
                  <InputError class="password-alert" :message="form.errors.password" />
                </div>
                <div>
                  <div class="form-group">
                    <input
                      type="password"
                      placeholder=" "
                      id="password_confirmation"
                      v-model="form.password_confirmation"
                      required
                      autocomplete="password_confirmation"
                    />
                    <label for="password_confirmation">Confirm Password</label>
                  </div>
                  <InputError
                    class="password-alert"
                    :message="form.errors.password_confirmation"
                  />
                </div>
                <div class="form-group mb-5">
                  <button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    Reset Password
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
