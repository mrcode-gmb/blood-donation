<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
  password: "",
});

const submit = () => {
  form.post(route("password.confirm"), {
    onFinish: () => form.reset(),
  });
};
</script>

<template>
  <div>
    <Head title="Comfirm Password" />
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
                <p>
                  This is a secure area of the application. Please confirm your password
                  before continuing.
                </p>
              </div>
              <div class="form-body">
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                  {{ status }}
                </div>
                <div class="form-group">
                  <input
                    type="password"
                    placeholder=" "
                    id="password"
                    v-model="form.password"
                    required
                    autocomplete="password"
                  />
                  <label for="">password</label>
                </div>
                <InputError class="password-alert" :message="form.errors.password" />
                <div class="form-group mb-5">
                  <button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    Comfirm Password
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
